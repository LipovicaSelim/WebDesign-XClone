document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM content loaded.");

  document
    .getElementById("nextButton4")
    .addEventListener("click", handleNextButtonClick);
});

function handleNextButtonClick() {
  console.log("Next button clicked***********************");

  let verificationCodeInput = document.getElementById("verificationCode");

  let verificationCode = verificationCodeInput.value;
  let email = userData.email;

  console.log("Verification code input value:", verificationCode);

  compareVerificationCode(verificationCode, email);
}

function compareVerificationCode(verificationCode, email) {
  const validationErrorMessage = document.getElementById(
    "validationErrorMessage"
  );
  console.log("Compare verification code function was called.");

  fetch("../controllers/validateVerificationCode.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "verificationCode=" + verificationCode + "&email=" + email,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.match === true) {
        console.log("Verification code matches.");
        handleClick();
      } else {
        console.error("Verification code does not match.");
        validationErrorMessage.textContent = "Wrong code!";
        validationErrorMessage.style.display = "flex";
        setTimeout(() => {
          validationErrorMessage.style.display = "none";
        }, 5000);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
