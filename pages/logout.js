document.addEventListener("DOMContentLoaded", function () {
  const logoutButton = document.getElementById("logout-btn");

  logoutButton.addEventListener("click", function () {
    fetch("../controllers/logout.php", {
      method: "POST",
    })
      .then((response) => {
        if (response.ok) {
          window.location.href = "../pages/landingPage.php";
          console.log("User logged out");
        }
      })
      .catch((error) => {
        console.error("Error logging out a user", error);
      });
  });
});
