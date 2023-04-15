const inpPass2 = document.querySelector("#inp-pass2");
const inpPassConfirm = document.querySelector("#pass_confirm");
const viewPass2 = document.querySelector("#viewPass2");
const chekbox2 = document.querySelector("#pill2");

// View pass
chekbox2.addEventListener("click", () => {
  if (inpPass2.getAttribute("type") === "password") {
    inpPass2.setAttribute("type", "text");
    viewPass2.textContent = "Hide password";
  } else {
    inpPass2.setAttribute("type", "password");
    viewPass2.textContent = "View password";
  }
});
chekbox2.addEventListener("click", () => {
  if (inpPassConfirm.getAttribute("type") === "password") {
    inpPassConfirm.setAttribute("type", "text");
  } else {
    inpPassConfirm.setAttribute("type", "password");
  }
});
// Validation inputs
const validate = new window.JustValidate("#form-signup");

validate.addField("#inp-login", [
  {
    rule: "required",
    errorMessage: "Login is required",
  },
  {
    rule: "minLength",
    value: 5,
  },
  {
    rule: "maxLength",
    value: 30,
  },
  {
    validator: (value) => () => {
      return fetch("validate-login.php?login=" + encodeURIComponent(value))
        .then(function (response) {
          return response.json();
        })
        .then(function (json) {
          return json.available;
        });
    },
    errorMessage: "Login alredy taken.",
  },
]);
validate.addField("#inp-email", [
  {
    rule: "required",
    errorMessage: "Email is required",
  },
  {
    rule: "email",
  },
  {
    validator: (value) => () => {
      return fetch("validate-email.php?email=" + encodeURIComponent(value))
        .then(function (response) {
          return response.json();
        })
        .then(function (json) {
          return json.available;
        });
    },
    errorMessage: "Email alredy taken.",
  },
]);

validate.addField("#inp-pass2", [
  {
    rule: "required",
    errorMessage: "Password is required",
  },
  {
    rule: "password",
  },
]);
validate
  .addField("#pass_confirm", [
    {
      validator: (value, fields) => {
        return value === fields["#inp-pass2"].elem.value;
      },
      errorMessage: "Passwords should be the same",
    },
  ])
  .onSuccess((event) => {
    document.getElementById("form-signup").submit();
  });
