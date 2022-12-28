let Name = document.getElementById("name");
let nationcode = document.getElementById("nationcode");
let stunumber = document.getElementById("stunumber");
let tell = document.getElementById("tell");
let inputs = document.getElementsByTagName("input");
let price = document.getElementById("price");
let form = document.getElementsByTagName("form");

let Namein = document.getElementById("namein");
let nationcodein = document.getElementById("nationcodein");
let stunumberin = document.getElementById("stunumberin");
let tellin = document.getElementById("tellin");

const showNameError = () => {
  Name.style.display = "block";
};
stunumberin.addEventListener("keyup", () => {
  if (stunumberin.value.length == 10 || stunumberin.value.length == 11) {
    stunumber.style.display = "none";
    let data = { stn: inputs[3].value };

    $.ajxax({
      type: "POST",
      url: "https://ssces.barfenow.ir/Controller/stnController.php",
      data,

      success: function (response) {
        var resp = JSON.parse(response);

        if (resp.success == "1") {
          price.innerHTML = "رایگان";
        } else {
          // alert(resp.message);
        }
      },
    });
  } else {
    stunumber.style.display = "block";
    Name.style.display = "none";
    nationcode.style.display = "none";
    tell.style.display = "none";
    price.innerHTML = "20,000 تومان";
  }
});
Namein.addEventListener("keyup", () => {
  Namein.value.length < 4
    ? (Name.style.display = "block") &&
      (nationcode.style.display = "none") &&
      (tell.style.display = "none") &&
      stunumber.style.display == "none"
    : (Name.style.display = "none");
});
nationcodein.addEventListener("keyup", () => {
  nationcodein.value.length < 10
    ? (Name.style.display = "none") &&
      (nationcode.style.display = "block") &&
      (tell.style.display = "none") &&
      stunumber.style.display == "none"
    : (nationcode.style.display = "none");
});
tellin.addEventListener("keyup", () => {
  console.log("op");
  // const regex = new RegExp("^(9|09)(12|19|35|36|37|38|39|32|21)d{7}$");
  let regex = new RegExp("^(\\+98|0)?9\\d{9}$");
  console.log(regex.test(tellin.value));
  regex.test(tellin.value)
    ? (tell.style.display = "none")
    : (Name.style.display = "none") &&
      (nationcode.style.display = "none") &&
      (tell.style.display = "block") &&
      stunumber.style.display == "none";
});
form[0].addEventListener("submit", () => {
  if (
    Name.style.display == "block" ||
    nationcode.style.display == "block" ||
    tell.style.display == "block" ||
    stunumber.style.display == "block"
  ) {
    return false;
  }
});
