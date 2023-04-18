// 打开或创建一个名为 "myDatabase" 的数据库
export function openDatabase(name, version) {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open(name, version);

    request.onerror = () => {
      reject("Failed to open database");
    };

    request.onsuccess = () => {
      resolve(request.result);
    };

    request.onupgradeneeded = (event) => {
      const db = event.target.result;
      let objectStore = db.createObjectStore("myData", { keyPath: "id" });

      objectStore.createIndex("Lclass", "Lclass", { unique: false });
      objectStore.createIndex("title", "title", { unique: false });
      objectStore.createIndex("content", "content", { unique: false });
    };
  });
}

// 向对象存储中写入数据
export function addData(data) {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open('myDatabase', 1);
    request.onsuccess = (e) => {
      const db = e.target.result;
      const transaction = db.transaction("myData", "readwrite");
      const store = transaction.objectStore("myData");
      const request = store.add(data);

      request.onsuccess = () => {
        resolve();
      };

      request.onerror = () => {
        reject("Failed to add data");
      };
    };
  });
}

// 从对象存储中读取数据
export function getData() {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open("myDatabase", 1);

    request.onerror = () => {
      reject("Failed to open database");
    };

    request.onsuccess = () => {
      const db = request.result;
      const transaction = db.transaction("myData", "readonly");
      const store = transaction.objectStore("myData");

      const getData = store.getAll();

      getData.onsuccess = () => {
        resolve(getData.result);
      };

      getData.onerror = () => {
        reject("Failed to get data");
      };
    };

    request.onupgradeneeded = (event) => {
      const db = event.target.result;
      db.createObjectStore("myData", { keyPath: "id" });
    };
  });
}
