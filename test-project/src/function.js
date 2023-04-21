export function openDatabase_class() {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open("53web-test", 1);

    request.onupgradeneeded = (e) => {
      const db = e.target.result;
      let objectStore = db.createObjectStore("test", {
        keyPath: "id",
      });

      objectStore.createIndex("class_name", "class_name", { unique: false });
      objectStore.createIndex("keyword", "keyword", { unique: false });
    };
  });
}

export function addClass(data) {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open("53web-test", 1);
    request.onsuccess = (e) => {
      data = JSON.parse(data);
      const db = e.target.result;
      db
        .transaction(["test"], "readwrite")
        .objectStore("test")
        .add(data).onsuccess = () => {
        resolve("data 新增成功");
      };
    };
  });
}

export function getClass() {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open("53web-test", 1);
    request.onsuccess = () => {
      const db = request.result;
      const transaction = db.transaction("test");
      const objectStore = transaction.objectStore("test");

      objectStore.getAll().onsuccess = (e) => {
        const data = e.target.result;
        resolve(data);
      };
    };
  });
}
