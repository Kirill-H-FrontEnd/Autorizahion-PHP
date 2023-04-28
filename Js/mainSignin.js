const inpPass1 = document.querySelector("#inp-pass1");
const chekbox1 = document.querySelector("#pill1");
const viewPass1 = document.querySelector("#viewPass1");

chekbox1.addEventListener("click", () => {
  if (inpPass1.getAttribute("type") === "password") {
    inpPass1.setAttribute("type", "text");
    viewPass1.textContent = "Hide password";
  } else {
    inpPass1.setAttribute("type", "password");
    viewPass1.textContent = "View password";
  }
});
const validateSecond = new window.JustValidate("#form-signin");
validateSecond
  .addField("#inp-email", [
    {
      rule: "required",
      errorMessage: "Email is required",
    },
    {
      rule: "email",
    },
    {
      validator: (value) => () => {
        return fetch(
          "validate-email-SignIn.php?email=" + encodeURIComponent(value)
        )
          .then(function (response) {
            return response.json();
          })
          .then(function (json) {
            return json.available;
          });
      },
      errorMessage: "Email does not exist",
    },
  ])
  .addField("#inp-pass1", [
    {
      rule: "required",
      errorMessage: "Password is required",
    },
    {
      rule: "password",
    },
  ])
  .onSuccess((event) => {
    document.getElementById("form-signin").submit();
  });
