document
  .getElementById("sendVerificationCode")
  .addEventListener("click", function () {
    var verificationCode = Math.floor(100000 + Math.random() * 900000);
    var email = "lipovicaselim@gmail.com"; // Replace with the actual email address

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
    xhr.send("code=" + verificationCode + "&email=" + email); // Pass verification code and email as parameters
  });
