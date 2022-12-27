let Name = document.getElementById("name");
let nationcode = document.getElementById("nationcode");
let stunumber = document.getElementById("stunumber");
let tell = document.getElementById("tell");
let inputs = document.getElementsByTagName("input");
let price=document.getElementById('price')
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

inputs[2].addEventListener("keyup", async () => {
  if (inputs[2].value.length >= 10) {
    let data = { stn: inputs[2].value };

    $.ajax({
      type: "POST",
      url: "https://ssces.barfenow.ir/Controller/stnController.php",
      data,

      success: function (response) {
        var resp = JSON.parse(response);

        if (resp.success == "1") {
          price.innerHTML="رایگان"
        } else {
          // alert(resp.message);
        }
      },
    });
  }
});
