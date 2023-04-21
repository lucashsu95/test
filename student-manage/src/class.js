export function openDatabase_class() {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open("53web-class-manage", 1);

    request.onupgradeneeded = (e) => {
      const db = e.target.result;
      let objectStore = db.createObjectStore("class-manage", {
        keyPath: "id",
      });

      objectStore.createIndex("class_name", "class_name", { unique: false });
    };
  });
}

export function addClass(data) {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open("53web-class-manage", 1);
    request.onsuccess = (e) => {
      data = JSON.parse(data);
      const db = e.target.result;
      db
        .transaction(["class-manage"], "readwrite")
        .objectStore("class-manage")
        .add(data).onsuccess = () => {
        resolve("data 新增成功");
      };
    };
  });
}

export function getClass() {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open("53web-class-manage", 1);
    request.onsuccess = () => {
      const db = request.result;
      db
        .transaction("class-manage")
        .objectStore("class-manage")
        .getAll().onsuccess = (e) => {
        const data = e.target.result;
        resolve(data);
      };
    };
  });
}
