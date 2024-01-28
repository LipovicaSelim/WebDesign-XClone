document.addEventListener("DOMContentLoaded", function () {
  let verificationCodeInput = document.getElementById("verificationCode");

  verificationCodeInput.addEventListener("change", function () {
    let verificationCode = this.value;
    let email = userData.email;

    fetch("../controllers/compareVerificationCode.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "verificationCode=" + verificationCode + "&email=" + email,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.match === true) {
          handleClick();
        } else {
          console.error("Verification code does not  match");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
