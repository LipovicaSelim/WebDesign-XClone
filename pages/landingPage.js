function openSignUpModal() {
  var modal = document.getElementById("SignUpModal");
  modal.style.display = "flex";
  overlay.style.display = "block";
  console.log("Create button clicked");
}

function closeSignUpModal() {
  var modal = document.getElementById("SignUpModal");
  modal.style.display = "none";
  overlay.style.display = "none";
  console.log("Close button clicked");
}

window.onclick = function (event) {
  var modal = document.getElementById("SignUpModal");
  var createAccountButton = document.getElementById("CreateAccountButton");

  if (event.target === modal) {
    closeSignUpModal();
  } else if (event.target === createAccountButton) {
    openSignUpModal();
  }
};
