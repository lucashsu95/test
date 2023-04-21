// 打开或创建一个名为 "53web-student-manage" 的数据库
export function openDatabase() {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open("53web-student-manage", 1);

    request.onupgradeneeded = (event) => {
      const db = event.target.result;
      let objectStore = db.createObjectStore("student-manage", {
        keyPath: "id",
      });

      objectStore.createIndex("avatar", "avatar", { unique: false });
      objectStore.createIndex("last_name", "last_name", { unique: false });
      objectStore.createIndex("first_name", "first_name", { unique: false });
      objectStore.createIndex("email", "email", { unique: false });
      objectStore.createIndex("student_id", "student_id", { unique: false });
      objectStore.createIndex("phone", "phone", { unique: false });
      objectStore.createIndex("address", "address", { unique: false });
      objectStore.createIndex("class", "class", { unique: false });
      objectStore.createIndex("note", "note", { unique: false });
    };
  });
}

// 向对象存储中写入数据
export function addStudent(data) {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open("53web-student-manage", 1);
    request.onsuccess = (e) => {
      const db = e.target.result;
      data = JSON.parse(data);
      console.log(data);
      db
        .transaction(["student-manage"], "readwrite")
        .objectStore("student-manage")
        .add(data).onsuccess = () => {
        resolve();
      };

      request.onerror = () => {
        reject("Failed to add data");
      };
    };
  });
}

// 从对象存储中读取数据
export function getStudent() {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open("53web-student-manage", 1);
    request.onsuccess = () => {
      const db = request.result;
      db
        .transaction("student-manage")
        .objectStore("student-manage")
        .getAll().onsuccess = (e) => {
        const data = e.target.result;
        resolve(data);
      };
    };
  });
}

export function updateStudent(data) {
  return new Promise(() => {
    const request = indexedDB.open("53web-student-manage", 1);
    request.onsuccess = () => {
      data = JSON.parse(data);
      const db = request.result;
      db
        .transaction(["student-manage"], "readwrite")
        .objectStore("student-manage")
        .put(data).onsuccess = () => {
        console.log("Data 修改成功");
      };
    };
  });
}

export function deleteStudent(data) {
  return new Promise(() => {
    const request = indexedDB.open("53web-student-manage", 1);
    request.onsuccess = () => {
      data = JSON.parse(data);
      data.class = "trash";

      const db = request.result;
      db
        .transaction(["student-manage"], "readwrite")
        .objectStore("student-manage")
        .put(data).onsuccess = () => {
        console.log("Data 刪除成功");
      };
    };
  });
}

export function backDeleteStudent() {}

// export function deleteStudent(id) {
//   return new Promise(() => {
//     const request = indexedDB.open("53web-student-manage", 1);
//     request.onsuccess = () => {
//       const db = request.result;
//       const transaction = db.transaction(["student-manage"], "readwrite");
//       const objectStore = transaction.objectStore("student-manage");
//       const query = objectStore.delete(id);
//       query.onsuccess = () => {
//         console.log("Data 刪除成功");
//       };
//     };
//   });
// }
