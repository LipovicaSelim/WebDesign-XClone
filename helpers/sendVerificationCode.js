document
  .getElementById("sendVerificationCode")
  .addEventListener("click", function () {
    var verificationCode = Math.floor(100000 + Math.random() * 900000);
    var email = userData.email;
    console.log("Email from send verification code.js: ", email);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/sendVerificationEmail.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          console.log("Verification code sent successfully");
        } else {
          console.error("Failed to send verification code");
        }
      }
    };
    xhr.send("code=" + verificationCode + "&email=" + email);
  });
