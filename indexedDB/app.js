let db;

const request = indexedDB.open("myDatabase", 1);

request.onupgradeneeded = function (event) {
  db = event.target.result;
  console.log("onupgradeneeded success", db);
  let objectStore = db.createObjectStore("todos", { keyPath: "id" });
  // 添加索引
  objectStore.createIndex("Lclass", "Lclass", { unique: false });
  objectStore.createIndex("title", "title", { unique: false });
  objectStore.createIndex("content", "content", { unique: false });
};

request.onsuccess = function (event) {
  db = event.target.result;
  console.log("Database opened successfully");
};

function render() {
  let request = indexedDB.open("myDatabase", 1);
  const ul = document.querySelector(".todoList > ul");
  const h = document.querySelector(".todoList > ul > li:first-child");
  ul.innerHTML = "";
  ul.appendChild(h);
  request.onsuccess = function (event) {
    db = event.target.result;
    const transaction = db.transaction(["todos"]);
    const objectStore = transaction.objectStore("todos");

    const query = objectStore.openCursor();

    query.onsuccess = function (event) {
      const cursor = event.target.result;
      if (cursor) {
        const li = document.createElement("li");
        const checkbox = document.createElement("input");
        const titleDiv = document.createElement("div");
        const contentDiv = document.createElement("div");
        const LclassDiv = document.createElement("div");
        const controlDiv = document.createElement("div");
        const modifyBtn = document.createElement("div");
        const deleteBtn = document.createElement("div");

        li.dataset.id = cursor.key;
        checkbox.type = "checkbox";
        titleDiv.textContent = cursor.value.title;
        titleDiv.className = "todo_title";
        contentDiv.textContent = cursor.value.content;
        contentDiv.className = "todo_content";
        LclassDiv.textContent = cursor.value.Lclass;
        LclassDiv.className = "todo_Lclass";
        controlDiv.className = "todo_control";
        modifyBtn.innerHTML = `<button onclick='modifyData(${cursor.key})'>修改</button>`;
        deleteBtn.innerHTML = `<button onclick='deleteData(${cursor.key})'>刪除</button>`;
        controlDiv.append(modifyBtn, deleteBtn);

        li.append(checkbox, titleDiv, contentDiv, LclassDiv, controlDiv);
        ul.appendChild(li);

        // console.log("id:", cursor.key);
        // console.log("title:", cursor.value.title);
        // console.log("content:", cursor.value.content);
        // console.log("Lclass:", cursor.value.Lclass);
        cursor.continue();
      } else {
        console.log("No more data");
      }
    };
  };
}

function addData() {
  const transaction = db.transaction(["todos"], "readwrite");
  const objectStore = transaction.objectStore("todos");
  const title = document.getElementById("title");
  const content = document.getElementById("content");
  const Lclass = document.getElementById("Lclass");

  const data = {
    id: Date.now(),
    title: title.value,
    content: content.value,
    Lclass: Lclass.value,
  };

  title.value = "";
  content.value = "";

  const request = objectStore.add(data);

  request.onsuccess = function () {
    console.log("Data added successfully");
  };
  render();
}

let title_modify = document.getElementById("title_modify");
let content_modify = document.getElementById("content_modify");
let Lclass_modify = document.getElementById("Lclass_modify");
const editTodo = document.querySelector(".editTodo");
let modify_id;

function modifyData(id) {
  modify_id = id;
  const transaction = db.transaction(["todos"]);
  const objectStore = transaction.objectStore("todos");
  const query = objectStore.get(id);

  query.onsuccess = function (event) {
    const data = event.target.result;
    if (data) {
      editTodo.classList.add("active");
      title_modify.value = data.title;
      content_modify.value = data.content;
      Lclass_modify.value = data.Lclass;
      // console.log("id:", data.id);
      // console.log("title:", data.title);
      // console.log("content:", data.content);
    } else {
      console.log("Data not found");
    }
  };
}

function modifyDataprocess() {
  console.log("modifyDataprocess");
  const data = {
    id: modify_id,
    title: title_modify.value,
    content: content_modify.value,
    Lclass: Lclass_modify.value,
  };

  const transaction = db.transaction(["todos"], "readwrite");
  const objectStore = transaction.objectStore("todos");
  const request = objectStore.put(data);

  close_editTodo();
  request.onsuccess = () => {
    console.log("Data puted successfully");
  };
}

function close_editTodo() {
  editTodo.classList.remove("active");
}

function deleteData(id) {
  console.log("deleteData", id);
  const transaction = db.transaction(["todos"], "readwrite");
  const objectStore = transaction.objectStore("todos");
  const request = objectStore.delete(id);
  request.onsuccess = () => {
    console.log("Data 刪除成功");
  };
  request.onerror = (e) => {
    console.log("Data 刪除失敗:", e);
  };
  render();
}

function getDataById(id) {
  const transaction = db.transaction(["todos"]);
  const objectStore = transaction.objectStore("todos");
  const query = objectStore.get(id);

  query.onsuccess = function (event) {
    const data = event.target.result;
    if (data) {
      console.log("id:", data.id);
      console.log("title:", data.title);
      console.log("content:", data.content);
    } else {
      console.log("Data not found");
    }
  };
}

render();
