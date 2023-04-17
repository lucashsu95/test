const items = document.querySelectorAll(".item");
items.forEach((item) => {
  item.addEventListener("click", (e) => {
    items.forEach((item2) => {
      item2.classList.remove("current");
    });
    e.target.classList.add("current");
  });
});

const students = [...document.querySelectorAll(".student")].filter((e,i) => i != 0);

console.log(students);
students.forEach((student) => {
  student.addEventListener("mouseenter", (e) => {
    console.log(e.target.dataset.id);
  });
});
// students.forEach((student) => {
//   student.addEventListener("mouseleave", (e) => {
//     console.log(e.target.dataset.id);
//   });
// });
