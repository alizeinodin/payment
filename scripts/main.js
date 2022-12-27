let Name = document.getElementById("name");
let nationcode = document.getElementById("nationcode");
let stunumber = document.getElementById("stunumber");
let tell = document.getElementById("tell");
let inputs = document.getElementsByTagName("input");
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

inputs[2].addEventListener("keydown", async () => {
  console.log(typeof inputs[2].value);
  if (inputs[2].value.length >= 9) {
    let data = { stn: inputs[2].value };
    const xhttp = new XMLHttpRequest();
    xhttp.open(
      "POST",
      "https://ssces.barfenow.ir/Controller/stnController.php",
    );
    xhttp.send(JSON.stringify(data));
  }
});
