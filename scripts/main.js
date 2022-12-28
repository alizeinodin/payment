let Name = document.getElementById("name");
let nationcode = document.getElementById("nationcode");
let stunumber = document.getElementById("stunumber");
let tell = document.getElementById("tell");
let inputs = document.getElementsByTagName("input");
let price = document.getElementById("price");
let form = document.getElementsByTagName("form");
const showNameError = () => {
  Name.style.display = "block";
};
inputs[3].addEventListener("keyup", () => {
  if (inputs[3].value.length == 10 || inputs[3].value.length == 11) {
    stunumber.style.display = "none";
    let data = { stn: inputs[3].value };

    $.ajax({
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
inputs[1].addEventListener("keyup", () => {
  inputs[1].value.length < 4
    ? (Name.style.display = "block") && (nationcode.style.display = "none") && (tell.style.display = "none") && (stunumber.style.display == "none")
    : (Name.style.display = "none");

});
inputs[2].addEventListener("keyup", () => {
  inputs[2].value.length < 10
    ? (Name.style.display = "none") && (nationcode.style.display = "block") && (tell.style.display = "none") && (stunumber.style.display == "none")
    : (nationcode.style.display = "none");
});
inputs[4].addEventListener("keyup", () => {
  const regex = new RegExp(
    /^09([0-1][0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/
  );
  regex.test(inputs[3].value)
    ? (tell.style.display = "none")
    : (Name.style.display = "none") && (nationcode.style.display = "none") && (tell.style.display = "block") && (stunumber.style.display == "none")
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
