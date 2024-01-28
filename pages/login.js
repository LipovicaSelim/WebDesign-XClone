document.addEventListener("DOMContentLoaded", function () {
  const passwordErrorDiv = document.getElementById("passwordErrorMessage");

  document
    .getElementById("loginForm")
    .addEventListener("submit", function (event) {
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
          if (data.status === "success") {
            window.location.href = "../pages/homeView.php";
            console.log(data);
          } else {
            passwordErrorDiv.textContent = "Wrong password!";
            passwordErrorDiv.style.display = "flex";

            setTimeout(() => {
              passwordErrorDiv.style.display = "none";
              console.log("Error message hidden");
            }, 5000);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
});
