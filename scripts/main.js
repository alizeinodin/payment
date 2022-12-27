let Name = document.getElementById("name");
let nationcode = document.getElementById("nationcode");
let stunumber = document.getElementById("stunumber");
let tell = document.getElementById("tell");
const showNameError = () => {
  Name.style.display = "block";
};
const showNationCodeError = () => {
  nationcode.style.display = "block";
};
const showStuNumberError = () => {
  stunumber.style.display = "block";
};
const showTellError = () => {
  tell.style.display = "block";
};

let result=await fetch("../Controller/stnController")