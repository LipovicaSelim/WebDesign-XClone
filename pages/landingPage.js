function openSignUpModal() {
  let modal = document.getElementById("SignUpModal");
  modal.style.display = "flex";
  overlay.style.display = "block";
  console.log("Create button clicked");
}

function closeSignUpModal() {
  let modal = document.getElementById("SignUpModal");
  modal.style.display = "none";
  overlay.style.display = "none";
  console.log("Close button clicked");
}

window.onclick = function (event) {
  let modal = document.getElementById("SignUpModal");
  let createAccountButton = document.getElementById("CreateAccountButton");

  if (event.target === modal) {
    closeSignUpModal();
  } else if (event.target === createAccountButton) {
    openSignUpModal();
  }
};

const nameInput = document.getElementById("username");
const countNameChar = document.getElementById("nameRegex");
const nameError = document.getElementById("nameError");
const nameInputBox = document.getElementById("NameInputBox");
const nameWhatSpan = document.getElementById("name-regex-error");
const emailValidSpan = document.getElementById("email-regex-error");
// console.log(nameInput);
console.log(nameError);

nameInput.addEventListener("focus", showCharCount);
nameInput.addEventListener("input", updateCharCount);
nameInput.addEventListener("blur", hideCharCount);
nameInput.addEventListener("input", validateNameInput());

function showCharCount() {
  countNameChar.style.display = "block";
  // console.log("Name input clicked");
}

function updateCharCount() {
  const maxLength = 50;
  const currentLength = nameInput ? nameInput.value.length : 0;
  countNameChar.textContent = `${currentLength} / ${maxLength}`;
}

function hideCharCount() {
  countNameChar.style.display = "none";
}

function validateNameInput() {
  let isEmpty = nameInput.value.trim() === "";
  let hadContentBefore = nameInput.dataset.hasContent === "true";
  console.log(isEmpty);
  console.log(hadContentBefore);

  let timeoutId;

  nameInput.addEventListener("input", () => {
    clearTimeout(timeoutId);

    timeoutId = setTimeout(() => {
      const isEmpty = nameInput.value.trim() === "";
      const hadContentBefore = nameInput.dataset.hasContent === "true";
      // console.log("isE, had", isEmpty, hadContentBefore);

      if (isEmpty && hadContentBefore) {
        nameInputBox.style.borderColor = "red";
        nameWhatSpan.style.display = "block";
        nameWhatSpan.textContent = "What is your name?";

        // console.log(nameInputBox);
        // console.log("Border color changed");
        // nameError.textContent = "What is your name";

        console.log(nameWhatSpan);
      } else {
        nameInputBox.style.border = "1px solid rgb(51, 54, 57)";
        nameWhatSpan.style.display = "none";

        // console.log("nameInputBox: ", nameInputBox);
        // nameError.style.display = "none";
      }

      nameInput.dataset.hasContent = isEmpty ? "false" : "true";
    }, 100);
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const inputBox = document.getElementById("NameInputBox");
  const input = document.getElementById("username");

  input.addEventListener("focus", function () {
    inputBox.classList.add("inputFocus");
  });

  input.addEventListener("blur", function () {
    inputBox.classList.remove("inputFocus");
  });

  input.addEventListener("input", function () {
    if (input.validity.valid) {
      inputBox.classList.add("inputFocus");
    } else {
      inputBox.classList.remove("inputFocus");
    }
  });
});

let emailValidationTimeout;

function validateEmail(email) {
  return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
}

function delayedEmailValidation(email) {
  emailValidSpan.style.display = "none";

  clearTimeout(emailValidationTimeout);

  emailValidationTimeout = setTimeout(() => {
    const isValid = validateEmail(email);
    if (!isValid) {
      emailValidSpan.style.display = "block";
      emailValidSpan.textContent = "Please enter a valid email.";
      console.log("Invalid email:", email);
    }
  }, 2000);
}

if (!window.scriptLoaded) {
  window.scriptLoaded = true;

  const inputFields = document.querySelectorAll("input, select");
  const stepsCount = document.getElementById("stepsCount");

  let currentStep = 1;

  function updateNextButton() {
    const hasEmptyField = Array.from(inputFields).some(
      (input) => input.value.trim() === ""
    );
    if (!hasEmptyField) {
      nextButton.classList.remove("nextButtonDisabled");
      nextButton.classList.add("nextButtonEnabled");
      nextButton.removeAttribute("disabled");
      // console.log("Proceed to next step");
    } else {
      nextButton.classList.remove("nextButtonEnabled");
      nextButton.classList.add("nextButtonDisabled");
      nextButton.setAttribute("disabled", "true");
    }
  }

  function handleClick() {
    if (nextButton.classList.contains("nextButtonDisabled")) {
      return;
    }
    console.log("Proceed to next step");
    document.getElementById("step1").style.display = "none";
    document.getElementById("step2").style.display = "block";

    const fullName = document.getElementById("username").value;
    const email = document.getElementById("email").value;
    const birthMonth = document.getElementById("month").value;
    const birthDay = document.getElementById("day").value;
    const birthYear = document.getElementById("year").value;

    console.log("Full name: ", fullName);

    const userData = {
      fullName,
      email,
      birthdate: birthYear + "-" + birthMonth + "-" + birthDay,
    };
    console.log("Userdata: ", userData);

    if (currentStep < 5) {
      currentStep += 1;
    }
    console.log(currentStep);
    updateStepsCount();
  }

  function updateStepsCount() {
    const maxLength = 5;
    stepsCount.textContent = `Step ${currentStep} of ${maxLength}`;
    console.log(currentStep);
  }

  inputFields.forEach((input) => {
    input.addEventListener("input", updateNextButton);
    input.addEventListener("change", updateNextButton);
  });
}
