const addButton = document.querySelector(".add");
const editButton = document.querySelector(".edit");
const removeButton = document.querySelector(".remove");
const main = document.querySelector(".main-calendar");
const add = document.querySelector(".add-calendar");
const edit = document.querySelector(".edit-calendar");
const remove = document.querySelector(".remove-calendar");
const baddButton = document.querySelector(".add-calendar-button");
const beditButton = document.querySelector(".edit-calendar-button");
const bremoveButton = document.querySelector(".remove-calendar-button");

addButton.addEventListener("click", function () {
  main.classList.add("none");
  add.classList.remove("none");
});

editButton.addEventListener("click", function () {
  main.classList.add("none");
  edit.classList.remove("none");
});

removeButton.addEventListener("click", function () {
  main.classList.add("none");
  remove.classList.remove("none");
});

bremoveButton.addEventListener("click", function () {
  main.classList.remove("none");
  remove.classList.add("none");
});

beditButton.addEventListener("click", function () {
  main.classList.remove("none");
  edit.classList.add("none");
});

baddButton.addEventListener("click", function () {
  main.classList.remove("none");
  add.classList.add("none");
});
