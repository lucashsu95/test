let request = indexedDB.open("myDatabase", 1);

request.onupgradeneeded = function (event) {
  const db = event.target.result;
  console.log("onupgradeneeded success", db);
  let objectStore = db.createObjectStore("todos", { keyPath: "id" });
  // 添加索引
  objectStore.createIndex("title", "title", { unique: false });
  objectStore.createIndex("content", "content", { unique: false });
};

function add() {
  let request = indexedDB.open("myDatabase", 1);
  request.onsuccess = function (event) {
    db = event.target.result;
    const transaction = db.transaction(["todos"], "readwrite");
    const objectStore = transaction.objectStore("todos");

    const title = document.querySelector('input[name="title"]');
    const content = document.querySelector('input[name="content"]');

    object = {
      id: 2,
      title: title.value,
      content: content.value,
    };

    console.log(object);

    let request = objectStore.add(object);
    request.onsuccess = (e) => {
      console.log("add success", e);
    };
  };
}

function readAll() {
  let request = indexedDB.open("myDatabase", 1);
  request.onsuccess = function (event) {
    db = event.target.result;
    const transaction = db.transaction(["todos"]);
    const objectStore = transaction.objectStore("todos");

    let query = objectStore.openCursor();

    query.onsuccess = (e) => {
      const data = e.target.result;
      if (data) {
        console.log("id:", data.key);
        console.log("title:", data.value.title);
        console.log("content:", data.value.content);
        data.continue();
      } else {
        console.log("沒有更多資料了");
      }
    };
  };
}

readAll();

function read(id) {
  let request = indexedDB.open("myDatabase", 1);
  request.onsuccess = function (event) {
    db = event.target.result;
    const transaction = db.transaction(["todos"]);
    const objectStore = transaction.objectStore("todos");
    let query = objectStore.get(id);

    query.onsuccess = (e) => {
      if (query.result) {
        console.log("id:", query.result.id);
        console.log("title:", query.result.title);
        console.log("content:", query.result.content);
      } else {
        console.log("未獲得data");
      }
      console.log("add success", e);
    };
  };
}
