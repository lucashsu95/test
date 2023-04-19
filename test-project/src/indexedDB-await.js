// 打开或创建一个名为 "myDatabase" 的数据库
export async function openDatabase(name, version) {
    return new Promise(() => {
      const request = indexedDB.open(name, version);
  
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
  export async function addData(data) {
    const db = await openDatabase("myDatabase", 1);
    return new Promise((resolve, reject) => {
      const transaction = db.transaction("myData", "readwrite");
      const store = transaction.objectStore("myData");
      const request = store.add(data);
  
      request.onsuccess = () => {
        resolve();
      };
  
      request.onerror = () => {
        reject("Failed to add data");
      };
    });
  }
  
  // 从对象存储中读取数据
  export async function getData() {
    const db = await openDatabase("myDatabase", 1);
    return new Promise((resolve, reject) => {
      const transaction = db.transaction("myData", "readonly");
      const store = transaction.objectStore("myData");
  
      const getData = store.getAll();
  
      getData.onsuccess = () => {
        resolve(getData.result);
      };
  
      getData.onerror = () => {
        reject("Failed to get data");
      };
    });
  }
  