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
      const db = e.target.result;
      const transaction = db.transaction(["class-manage"], "readwrite");
      const objectStore = transaction.objectStore("class-manage");

      data = JSON.parse(data);
      const request = objectStore.add(data);
      request.onsuccess = () => {
        resolve('data 新增成功');
      };
    };
  });
}


export function getClass() {
    return new Promise((resolve, reject) => {
      const request = indexedDB.open("53web-class-manage", 1);
      request.onsuccess = () => {
        const db = request.result;
        const transaction = db.transaction("class-manage");
        const objectStore = transaction.objectStore("class-manage");
  
        objectStore.getAll().onsuccess = (e) => {
          const data = e.target.result;
          resolve(data);
        };
      };
    });
  }