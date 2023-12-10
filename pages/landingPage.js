function openSignUpModal() {
  let modal = document.getElementById("SignUpModal");
  modal.style.display = "flex";
  overlay.style.display = "block";
  console.log("Create button clicked");
}

function openSignInModal() {
  let signInModal = document.getElementById("SignInModal");
  signInModal.style.display = "flex";
  overlay.style.display = "block";
  console.log("Login button clicked");
}

function closeSignUpModal() {
  let modal = document.getElementById("SignUpModal");
  modal.style.display = "none";
  overlay.style.display = "none";
  console.log("Close button clicked");
}

function closeSignInModal() {
  let signInModal = document.getElementById("SignInModal");
  signInModal.style.display = "none";
  overlay.style.display = "none";
  console.log("Close button clicked");
}

// async function loadContent(file) {
//   const response = await fetch(file);
//   return response.text();
// }

// async function setModalContent(step) {
//   const modalContainer = document.getElementById("modalContainer");
//   const content = await loadContent(`step${step}.html`)
//   modalContainer.innerHTML = content;
// }

// setModalContent(1);

// document.addEventListener("click", function(event) {
//   if(event.target.id === "nextButton") {
//     const currentStep = 1

//     setModalContent(currentStep + 1);
//   }
// })

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
// console.log(nameError);

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
  // console.log(isEmpty);
  // console.log(hadContentBefore);

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
    const nextButton = document.getElementById("nextButton");
    const currentStepContainer = document.getElementById(`step${currentStep}`);
    const inputFields = currentStepContainer.querySelectorAll("input, select");

    const hasEmptyField = Array.from(inputFields).some(
      (input) => input.value.trim() === ""
    );
    if (!hasEmptyField) {
      nextButton.classList.remove("nextButtonDisabled");
      console.log("Next button clicked if");
      nextButton.classList.add("nextButtonEnabled");
      nextButton.removeAttribute("disabled");
      // console.log("Proceed to next step");
    } else {
      nextButton.classList.remove("nextButtonEnabled");
      console.log("Next button clicked else");

      nextButton.classList.add("nextButtonDisabled");
      nextButton.setAttribute("disabled", "true");
    }
  }

  function handleClick() {
    if (nextButton.classList.contains("nextButtonDisabled")) {
      return;
    }
    console.log("Proceed to next step");
    const currentStepContainer = document.getElementById(`step${currentStep}`);
    const nextStepContainer = document.getElementById(`step${currentStep + 1}`);

    if (currentStep && nextStepContainer) {
      currentStepContainer.style.display = "none";
      nextStepContainer.style.display = "block";
    }

    // const fullName = document.getElementById("username").value;
    // const email = document.getElementById("email").value;
    // const birthMonth = document.getElementById("month").value;
    // const birthDay = document.getElementById("day").value;
    // const birthYear = document.getElementById("year").value;

    // console.log("Full name: ", fullName);

    // function collectUserData() {
    //   userData = {
    //     fullName,
    //     email,
    //     birthdate: birthYear + "-" + birthMonth + "-" + birthDay,
    //   };
    //   // console.log("Userdata: ", userData);
    // }

    // collectUserData();

    if (currentStep < 5) {
      currentStep += 1;
    }
    console.log(currentStep);
    updateStepsCount();

    const userEmail = userData.email;

    const emailParagraph = document.querySelector(".emailParagraphStep4");

    emailParagraph.textContent = ` ${userEmail}`;
    console.log(emailParagraph.textContent);
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

const checkboxSignUp = document.getElementById("checkboxSignUp");
const toggleImage = document.getElementById("toggleImage");

function handleAgreeForTerms() {
  const checkboxSignUp = document.getElementById("checkboxSignUp");
  const toggleImage = document.getElementById("toggleImage");

  checkboxSignUp.classList.toggle("checkboxS2Active");

  if (checkboxSignUp.classList.contains("checkboxS2Active")) {
    toggleImage.src = "../images/checkCheckbox.svg";
    toggleImage.style.display = "flex";
  } else {
    toggleImage.src = "";
    toggleImage.style.display = "none";
    console.log("checkbox unclicked");
  }
}

const step2 = document.getElementById("step2");

document.body.addEventListener("click", function (event) {
  if (event.target === nextButton) {
    handleClickForNextButton();
  }
});

function handleClickForNextButton() {
  const nextButton2 = document.getElementById("nextButton2");
  console.log("handleClickForNextButton function executed");

  const checkboxSignUp = document.getElementById("checkboxSignUp");
  const step2 = document.getElementById("step2");

  const step2DisplayStyle = getComputedStyle(step2).display;

  console.log(
    "checkboxSignUp.classList.contains('checkboxS2Active'): ",
    checkboxSignUp.classList.contains("checkboxS2Active")
  );
  console.log("step2DisplayStyle === 'block': ", step2DisplayStyle === "block");

  if (
    checkboxSignUp.classList.contains("checkboxS2Active") &&
    step2DisplayStyle === "block"
  ) {
    nextButton2.classList.add("nextButtonEnabled");
    nextButton2.classList.remove("nextButtonDisabled");
    console.log("Next button 2 is enabled");
    console.log("Before else if");
  } else if (
    !checkboxSignUp.classList.contains("checkboxS2Active") &&
    step2DisplayStyle === "block"
  ) {
    console.log("Inside else block");
    console.log("step2.style.display:", step2DisplayStyle);
    nextButton2.classList.remove("nextButtonEnabled");
    nextButton2.classList.add("nextButtonDisabled");
    console.log("Next button should be disabled here");
  } else {
    console.log("After else if");
  }
}
let userData = {};

document.addEventListener("DOMContentLoaded", function () {
  function updateNextButtonVisibility() {
    console.log("updateNextButtonVisibility");
    const step3 = document.getElementById("step3");

    if (step3 && getComputedStyle(step3).display === "block") {
      console.log("Here below is handle step 3....");
      handleStep3();
    } else {
      console.log("Couldn't handle the step 3 data");
    }
  }

  function formatBirthdate(birthdate) {
    const options = { month: "short", day: "numeric", year: "numeric" };
    const formattedDate = new Date(birthdate).toLocaleDateString(
      undefined,
      options
    );
    return formattedDate;
  }

  function handleStep3() {
    console.log("userData from step3", userData);
    console.log("Fullname from step 3: ", userData.fullName);

    if (userData) {
      const formattedBirthdate = formatBirthdate(userData.birthdate);
      document.getElementById("confirmedUsername").value = userData.fullName;
      console.log("Userdata fullname: ", userData.fullName);
      document.getElementById("confirmedEmail").value = userData.email;

      const confirmedBirthdateInput =
        document.getElementById("confirmedBirthdate");
      confirmedBirthdateInput.value = formattedBirthdate;

      console.log(formattedBirthdate);
    } else {
      console.error("userData is not defined or has incorrect values");
    }
  }

  document.getElementById("nextButton2").addEventListener("click", function () {
    userData.fullName = document.getElementById("username").value;
    userData.email = document.getElementById("email").value;
    userData.birthdate =
      document.getElementById("year").value +
      "-" +
      document.getElementById("month").value +
      "-" +
      document.getElementById("day").value;

    console.log("Userdata: ", userData);
    console.log("Date of birth input: ", userData.birthdate);

    updateNextButtonVisibility();
  });

  updateNextButtonVisibility();
});

function togglePasswordVisibility() {
  const passwordInput = document.getElementById("password");

  passwordInput.type = passwordInput.type === "password" ? "text" : "password";
}

function validatePassword(password) {
  return /^(?=.*[A-Za-z])(?=.*\d).{8,}$/.test(password);
}

function submitPassword() {
  const passwordInput = document.getElementById("password");
  const passwordError = document.getElementById("passwordError");

  const password = passwordInput.value;

  if (!validatePassword(password)) {
    passwordError.textContent =
      "Minimum eight characters, at least one letter and one number required.";
  } else {
    passwordError.textContent = "";
    console.log("Password is valid:", password);
    userData.password = password;
    window.location.href = "http://127.0.0.1:5500/pages/home.html";
    console.log("userData from last step: ", userData);
  }
}
