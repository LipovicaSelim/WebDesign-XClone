document.addEventListener("DOMContentLoaded", function () {
  const passwordErrorDiv = document.getElementById("passwordErrorMessage");

  document
    .getElementById("loginForm")
    .addEventListener("submit", async function (event) {
      event.preventDefault();
      var formData = new FormData(document.getElementById("loginForm"));
      console.log(formData);
      fetch("../controllers/login.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          console.log("Response received:", response);
          return response.json();
        })
        .then((data) => {
          console.log("Data received:", data);
          console.log("data status: ", data.status);
          if (data.status === "success") {
            window.location.href = data.redirect;
            console.log(data);
          } else {
            console.log("password error div: ", passwordErrorDiv);
            passwordErrorDiv.style.display = "flex";
            passwordErrorDiv.textContent = "Wrong password!";

            setTimeout(() => {
              passwordErrorDiv.style.display = "none";
              console.log("Error message hidden");
            }, 5000);
          }
        })
        .catch((error) => {
          console.error("Error from .catch", error);
        });
    });

  document
    .getElementById("toggleSignInWithSignUp")
    .addEventListener("click", function (e) {
      e.preventDefault();
      console.log("Togglinggggg");

      closeSignInModal();
      openSignUpModal();
    });
});

function toggleSignInPasswordVisibility() {
  const passwordInputSignIn = document.getElementById("signin-password-input");
  passwordInputSignIn.type =
    passwordInputSignIn.type === "password" ? "text" : "password";
  console.log("Signin password icon clicked:");
  console.log("password input type**: ", passwordInputSignIn.type);
}
