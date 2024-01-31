<!-- <?php
      require_once '../vendor/PHPMailer-6.9.1/src/PHPMailer.php';
      ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>XClone</title>
  <link rel="stylesheet" href="../style/landingPage.css" />
  <link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0.16/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0.16/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0.16/favicon-16x16.png" />
  <link rel="manifest" href="favicon_package_v0.16/site.webmanifest" />
  <link rel="mask-icon" href="favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5" />
</head>

<body>
  <div id="overlay"></div>
  <container class="content">
    <div class="LeftPannel">
      <div class="left-pannel-logo">
        <img src="images/dXsLogo.svg" alt="x-logo" fill="white" class="Xlogo" />
      </div>
    </div>
    <div class="RightPannel">
      <div class="RightContent">
        <img src="images/dXsLogo.svg" id="logo-small-screens" alt="x-logo2" fill="white" style="display: none" />
        <div>
          <h1 class="happening">Happening now</h1>
        </div>
        <p class="joinToday">Join today.</p>
        <div id="SignUpModalGoogle" class="SignUp Google button">
          <div>
            <img src="images/icons8-google.svg" alt="google icon" height="26" />
          </div>
          <p>Sign Up With Google</p>
        </div>
        <div class="SignUp Apple button">
          <div><img src="images/apple-icon.svg" alt="apple-icon" /></div>
          <p>Sign Up With Apple</p>
        </div>
        <div class="or">
          <div class="border-line"></div>
          <p style="color: white">or</p>
          <div class="border-line"></div>
        </div>
        <div id="CreateAccountButton" class="SignUp CreateAccount button" onclick="openSignUpModal()">
          Create account
        </div>

        <!--CREATE ACCOUNT MODAL-->

        <form action="../controllers/register.php" method="POST">
          <div id="SignUpModal" class="modal">
            <div class="modal-content" style="filter: blur(0.1px)">
              <div class="modal-header">
                <span></span>
                <div class="x-button" onclick="closeSignUpModal()">
                  <img src="images/closeButton.svg" alt="close" />
                </div>
                <div id="stepsCount" class="steps">Step 1 of 5</div>
              </div>
              <div class="modal-field-container">
                <div id="step1" class="modal-field-content">
                  <div class="h2-modal">
                    <span>Create your account</span>
                  </div>
                  <div id="NameInputBox" class="inputBox">
                    <div id="nameRegex" class="NameRegex"></div>
                    <input type="text" id="username" name="emri" required="required" maxlength="50" />
                    <span>Name</span>
                    <div id="name-regex-error"></div>
                  </div>

                  <div class="inputBox emailInputBox" id="NameInputBox">
                    <input type="email" id="email" name="email" required="required" oninput="delayedEmailValidation(this.value)" />
                    <span>Email</span>
                    <div id="email-regex-error"></div>
                  </div>
                  <div class="birthday"><span>Date of birth</span></div>
                  <div class="confirm-age">
                    <span>This will not be shown publicly. Confirm your own age,
                      even if this account is for a business, a pet, or
                      something else.</span>
                  </div>
                  <div class="birthday-forms">
                    <div class="inputBox">
                      <span>Month</span>
                      <select type="date" id="month" aria-invalid="false" class="birthday-month" name="month">
                        <option selected disabled value=""></option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                      <img id="arrowDown" class="arrowDown" src="images/svgexport-2-arrowDown.svg" alt="" />
                    </div>
                    <div class="birdthday-day-box">
                      <div class="inputBox dayInput">
                        <span>Day</span>
                        <select type="date" id="day" aria-invalid="false" class="birthday-day" name="day">
                          <option selected disabled></option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                        <img id="arrowDown" class="arrowDown" src="images/svgexport-2-arrowDown.svg" alt="" />
                      </div>
                    </div>
                    <div class="birdthday-year-box">
                      <div class="inputBox yearInput">
                        <span>Year</span>
                        <select type="date" id="year" aria-invalid="false" class="birthday-year" name="year">
                          <option selected disabled value=""></option>
                          <option value="2023">2023</option>
                          <option value="2022">2022</option>
                          <option value="2021">2021</option>
                          <option value="2020">2020</option>
                          <option value="2019">2019</option>
                          <option value="2018">2018</option>
                          <option value="2017">2017</option>
                          <option value="2016">2016</option>
                          <option value="2015">2015</option>
                          <option value="2014">2014</option>
                          <option value="2013">2013</option>
                          <option value="2012">2012</option>
                          <option value="2011">2011</option>
                          <option value="2010">2010</option>
                          <option value="2009">2009</option>
                          <option value="2008">2008</option>
                          <option value="2007">2007</option>
                          <option value="2006">2006</option>
                          <option value="2005">2005</option>
                          <option value="2004">2004</option>
                          <option value="2003">2003</option>
                          <option value="2002">2002</option>
                          <option value="2001">2001</option>
                          <option value="2000">2000</option>
                          <option value="1999">1999</option>
                          <option value="1998">1998</option>
                          <option value="1997">1997</option>
                          <option value="1996">1996</option>
                          <option value="1995">1995</option>
                          <option value="1994">1994</option>
                          <option value="1993">1993</option>
                          <option value="1992">1992</option>
                          <option value="1991">1991</option>
                          <option value="1990">1990</option>
                          <option value="1989">1989</option>
                          <option value="1988">1988</option>
                          <option value="1987">1987</option>
                          <option value="1986">1986</option>
                          <option value="1985">1985</option>
                          <option value="1984">1984</option>
                          <option value="1983">1983</option>
                          <option value="1982">1982</option>
                          <option value="1981">1981</option>
                          <option value="1980">1980</option>
                          <option value="1979">1979</option>
                          <option value="1978">1978</option>
                          <option value="1977">1977</option>
                          <option value="1976">1976</option>
                          <option value="1975">1975</option>
                          <option value="1974">1974</option>
                          <option value="1973">1973</option>
                          <option value="1972">1972</option>
                          <option value="1971">1971</option>
                          <option value="1970">1970</option>
                          <option value="1969">1969</option>
                          <option value="1968">1968</option>
                          <option value="1967">1967</option>
                          <option value="1966">1966</option>
                          <option value="1965">1965</option>
                          <option value="1964">1964</option>
                          <option value="1963">1963</option>
                          <option value="1962">1962</option>
                          <option value="1961">1961</option>
                          <option value="1960">1960</option>
                          <option value="1959">1959</option>
                          <option value="1958">1958</option>
                          <option value="1957">1957</option>
                          <option value="1956">1956</option>
                          <option value="1955">1955</option>
                          <option value="1954">1954</option>
                          <option value="1953">1953</option>
                          <option value="1952">1952</option>
                          <option value="1951">1951</option>
                          <option value="1950">1950</option>
                          <option value="1949">1949</option>
                          <option value="1948">1948</option>
                          <option value="1947">1947</option>
                          <option value="1946">1946</option>
                          <option value="1945">1945</option>
                          <option value="1944">1944</option>
                          <option value="1943">1943</option>
                          <option value="1942">1942</option>
                          <option value="1941">1941</option>
                          <option value="1940">1940</option>
                          <option value="1939">1939</option>
                          <option value="1938">1938</option>
                          <option value="1937">1937</option>
                          <option value="1936">1936</option>
                          <option value="1935">1935</option>
                          <option value="1934">1934</option>
                          <option value="1933">1933</option>
                          <option value="1932">1932</option>
                          <option value="1931">1931</option>
                          <option value="1930">1930</option>
                          <option value="1929">1929</option>
                          <option value="1928">1928</option>
                          <option value="1927">1927</option>
                          <option value="1926">1926</option>
                          <option value="1925">1925</option>
                          <option value="1924">1924</option>
                          <option value="1923">1923</option>
                          <option value="1922">1922</option>
                          <option value="1921">1921</option>
                          <option value="1920">1920</option>
                          <option value="1919">1919</option>
                          <option value="1918">1918</option>
                          <option value="1917">1917</option>
                          <option value="1916">1916</option>
                          <option value="1915">1915</option>
                          <option value="1914">1914</option>
                          <option value="1913">1913</option>
                          <option value="1912">1912</option>
                          <option value="1911">1911</option>
                          <option value="1910">1910</option>
                          <option value="1909">1909</option>
                          <option value="1908">1908</option>
                          <option value="1907">1907</option>
                          <option value="1906">1906</option>
                          <option value="1905">1905</option>
                          <option value="1904">1904</option>
                          <option value="1903">1903</option>
                        </select>
                        <img id="arrowDown" class="arrowDown" src="images/svgexport-2-arrowDown.svg" alt="" />
                      </div>
                    </div>
                  </div>
                  <div id="Step1NextButtonDiv">
                    <button id="nextButton" class="nextButtonDisabled" onclick="handleClick()">
                      Next
                    </button>
                  </div>
                </div>
              </div>
              <!-- </div> -->
              <div id="step2" class="modal-content" style="height: 600px">
                <div class="modal-field-container" style="
                      display: flex;
                      flex-direction: column;
                      align-items: center;
                    ">
                  <div class="modal-field-content">
                    <div class="h2-modal">
                      <h1 style="width: 100%; text-align: center; color: white">
                        Customize your experience
                      </h1>
                    </div>
                    <div style="
                          display: flex;
                          align-self: start;
                          font-size: 20px;
                          color: #e7e9ef;
                          font-weight: 700;
                          margin-bottom: 15px;
                        ">
                      <span>Track where you see X content across the web</span>
                    </div>
                    <div style="
                          display: flex;
                          align-items: start;
                          font-size: 15px;
                          font-weight: 400;
                          margin-bottom: 20px;
                        ">
                      <span>X uses this data to personalize your experience. This
                        web browsing history will never be stored with your
                        name, email, or phone number.</span>
                      <div>
                        <div id="checkboxSignUp" class="checkboxS2 checkboxS2Active" onclick="handleAgreeForTerms()">
                          <img id="toggleImage" src="images/checkCheckbox.svg" alt="checked" width="16px" />
                        </div>
                      </div>
                    </div>
                    <div>
                      <span>By signing up, you agree to our Terms, Privacy
                        Policy, and Cookie Use. X may use your contact
                        information, including your email address and phone
                        number for purposes outlined in our Privacy Policy.
                        Learn more</span>
                    </div>
                    <div id="Step2NextButtonDiv">
                      <button id="nextButton2" class="nextButtonDisabled" onclick="handleClick()">
                        Next
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="step3" class="modal-content" style="height: 600px">
                <div class="modal-field-container" style="
                      display: flex;
                      flex-direction: column;
                      align-items: center;
                    ">
                  <div class="modal-field-content">
                    <div class="h2-modal">
                      <span>Create your account</span>
                    </div>
                    <div id="confirmedNameInputBox" class="inputBox">
                      <div id="confirmedNameRegex" class="NameRegex"></div>
                      <input type="text" id="confirmedUsername" name="confirmedUserName" maxlength="50" />
                      <span>Name</span>
                      <!-- <div id="name-regex-error"></div> -->
                      <img src="images/confirmedInputsCheck.svg" alt="checked" width="18px" style="padding-right: 6px; padding-top: 13px" />
                    </div>
                    <div class="inputBox confirmedEmailInputBox" id="confirmedEmailInputBox">
                      <input type="confirmedEmail" id="confirmedEmail" name="confirmedEmail" />
                      <span>Email</span>
                      <!-- <div id="email-regex-error"></div> -->
                      <img src="images/confirmedInputsCheck.svg" alt="checked" width="18px" style="padding-right: 6px; padding-top: 13px" />
                    </div>
                    <div id="confirmedBirthdateInputBox" class="inputBox">
                      <!-- <div id="birthdate" class="NameRegex"></div> -->
                      <input type="text" id="confirmedBirthdate" name="confirmedBirthdate" />
                      <span>Date of birth</span>
                      <!-- <div id="name-regex-error"></div> -->
                      <img src="images/confirmedInputsCheck.svg" alt="checked" width="18px" style="padding-right: 6px; padding-top: 13px" />
                    </div>
                    <div class="step3SpanButton">
                      <p class="step3AgreeTerms">
                        By signing up, you agree to the
                        <em>Terms of Service</em> and <em>Privacy Policy</em>,
                        including <em>Cookie Use</em>. X may use your contact
                        information, including your email address and phone
                        number for purposes outlined in our Privacy Policy,
                        like keeping your account secure and personalizing our
                        services, including ads.<em> Learn more</em>. Others
                        will be able to find you by email or phone number,
                        when provided, unless you choose otherwise
                        <em>here</em>.
                      </p>
                      <div>
                        <button id="sendVerificationCode" class="nextStepToSignUp" onclick="handleClick()">
                          Sign Up
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div
                id="step-3-authenticate"
                class="modal-content"
                style="height: 600px"
              >
                <div
                  class="modal-field-container"
                  style="
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    background-color: white;
                    border-radius: 30px;
                  "
                >
                  <div
                    class="modal-field-content"
                    style="
                      display: flex;
                      align-items: center;
                      justify-content: center;
                      border-radius: 30px;
                    "
                  >
                    <div>
                      <h1 style="color: black">reCAPTCHA authentication</h1>
                       <form action="?" method="POST">
                        <div
                          class="g-recaptcha"
                          data-sitekey="your_site_key"
                        ></div>
                        <br />
                        <input type="submit" value="Submit" />
                      </form>
                      <div id="nextStepToSignUpDiv">
                        <button
                          id="nextButton4"
                          class="nextButtonEnabled"
                          onclick="handleClick()"
                        >
                          Submit
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <div id="step4" class="modal-content" style="height: 600px">
                <div class="modal-field-container">
                  <div class="modal-field-content" style="
                        display: flex;
                        align-items: center;
                        border-radius: 30px;
                      ">
                    <div>
                      <h1 style="margin-bottom: 0">We sent you a code</h1>
                      <div class="emailForVerification">
                        <p>Enter it below to verify:</p>
                        <p class="emailParagraphStep4"></p>
                      </div>
                      <div class="verificationCodeInput">
                        <div id="verificationCodeInput" class="inputBox" style="margin-bottom: 7px; margin-top: 7px">
                          <div id="verificationCodeDisplay" class="verificationCode"></div>
                          <input type="number" id="verificationCode" name="verificationCode" required="required" maxlength="6" />
                          <span>Verification code</span>
                        </div>
                        <div>
                          <span style="
                                color: #1d9bf0;
                                font-size: 13px;
                                cursor: pointer;
                              ">Didn't receive an email?</span>
                        </div>
                      </div>
                      <div id="nextStepToSignUpDiv">
                        <button id="nextButton4" class="nextButtonEnabled">
                          Submit
                        </button>
                      </div>
                      <div id="validationErrorMessage" style="
                            position: absolute;
                            bottom: -100px;
                            left: calc(50% - 110px);
                            height: 50px;
                            width: 220px;
                            background-color: #1d9bf0;
                            border-radius: 5px;
                            color: white;
                            font-size: 18px;
                            display: none;
                            justify-content: center;
                            align-items: center;
                            font-weight: 600;
                            transition: all 5s ease-out;
                          "></div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="step5" class="modal-content" style="height: 600px">
                <div class="modal-field-container">
                  <div class="modal-field-content" style="
                        display: flex;
                        align-items: center;
                        border-radius: 30px;
                      ">
                    <div>
                      <h1 style="margin-bottom: 0">You'll need a password</h1>
                      <div class="emailForVerification">
                        <p>Make sure it's 8 characters or more.</p>
                      </div>
                      <div class="verificationCodeInput">
                        <div id="passwordInputBox" class="inputBox" style="margin-bottom: 7px; margin-top: 7px">
                          <div id="passwordInput" class="passwodInput"></div>
                          <input class="password" type="password" id="password" name="password" required="required" maxlength="50" />
                          <span>Password</span>
                          <img src="images/displayPassword.svg" alt="display" width="22px" style="padding-right: 10px; padding-top: 25px" id="displayPassword" onclick="togglePasswordVisibility()" />
                        </div>
                        <p id="passwordError" style="
                              color: #bd1919;
                              font-size: 13px;
                              margin-top: 2px;
                              font-weight: 700;
                            "></p>
                      </div>
                      <div id="nextStepToSignUpDiv">
                        <button id="submitPassword" class="nextButtonEnabled" onclick="handleSubmit()">
                          Submit
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>

        <form id="loginForm" action="../controllers/login.php" method="post">
          <div id="SignInModal" class="modal">
            <div class="modal-content" style="filter: blur(0.1px)">
              <div class="modal-header">
                <span></span>
                <div class="x-button" onclick="closeSignInModal()">
                  <img src="images/closeButton.svg" alt="close" />
                </div>
                <div id="dXsLogo-signin" class="dXsLogoSignin">
                  <img src="images/dXsLogo.svg" alt="logo" />
                </div>
              </div>
              <div class="signIn-ctn">
                <div class="modal-field-container-signin">
                  <h1 class="SignIn-h1">Sign in to dXs</h1>

                  <div id="SignUpModalGoogle" class="SignUp Google button" style="margin-bottom: 25px">
                    <div>
                      <img src="images/icons8-google.svg" alt="google icon" height="26" />
                    </div>
                    <p>Sign In With Google</p>
                  </div>
                  <div class="SignUp Apple button">
                    <div>
                      <img src="images/apple-icon.svg" alt="apple-icon" />
                    </div>
                    <p>Sign Up With Apple</p>
                  </div>
                  <div class="or">
                    <div class="border-line"></div>
                    <p style="color: white">or</p>
                    <div class="border-line"></div>
                  </div>
                  <div id="signin-name-input" class="inputBox" style="margin-top: 0; margin-bottom: 22px">
                    <div id="nameRegex" class="NameRegex"></div>
                    <input type="email" id="signIn-username" required="required" maxlength="50" name="usernameOrEmail" />
                    <span>Email or username</span>
                    <!-- <div id="name-regex-error"></div> -->
                  </div>
                  <div id="signin-password" class="inputBox" style="margin-top: 2px; margin-bottom: 12px">
                    <input type="password" id="signin-password-input" name="password" required="required" maxlength="60" placeholder="Password" />
                    <span></span>
                    <img src="images/displayPassword.svg" alt="display" width="22px" style="padding-right: 10px; padding-top: 25px" id="displayPassword" onclick="toggleSignInPasswordVisibility()" />
                  </div>
                  <div id="signInNextButton">
                    <button id="signInnextButton" class="signInBtn">
                      Next
                    </button>
                  </div>
                  <div id="forgotPassword">
                    <button id="forgotPassword" class="forgotPasswordBtn">
                      ForgotPassword?
                    </button>
                  </div>
                  <div style="margin-top: 50px">
                    <p style="color: rgb(113, 118, 123)">
                      Don't have an account?
                      <em id="toggleSignInWithSignUp" style="
                            color: #1d9bf0;
                            cursor: pointer;
                            font-style: normal;
                          ">Sign up</em>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div id=" passwordErrorMessage" style="
                  position: absolute;
                  bottom: -100px;
                  left: calc(50% - 110px);
                  height: 50px;
                  width: 220px;
                  background-color: #1d9bf0;
                  border-radius: 5px;
                  color: white;
                  font-size: 18px;
                  display: none;
                  justify-content: center;
                  align-items: center;
                  font-weight: 600;
                  transition: all 5s ease-out;
                "></div>
          </div>
        </form>

        <!-- Footer of landing page********************************** -->

        <div class="TermsPolicies">
          <p>
            By signing up, you agree to the
            <em>Terms of Service</em> and <em>Privacy Policy</em>, including
            <em>Cookie Use.</em>
          </p>
        </div>
        <div class="SignIn">Already have an account?</div>
        <div class="SignUp SignIn-Button button" onclick="openSignInModal()">
          Sign in
        </div>
      </div>
    </div>
  </container>
  <nav class="navbar">
    <div class="nav-links">
      <a href="localhost:3000/about">
        <navlink>About</navlink>
      </a>
      <a href="localhost:3000">
        <navlink>Download the X app</navlink>
      </a>
      <a href="localhost:3000/helpcenter">
        <navlink> Help Center</navlink>
      </a>
      <a href="localhost:3000/terms">
        <navlink>Terms of Service</navlink>
      </a>
      <a href="localhost:3000/privacyPolicies">
        <navlink>Privacy Policy</navlink>
      </a>
      <a href="localhost:3000/cookiepolicies">
        <navlink>Cookie Policy</navlink>
      </a>
      <a href="localhost:3000/Accessibility">
        <navlink>Accessibility</navlink>
      </a>
      <a href="localhost:3000/AdsInfo">
        <navlink>Ads Info</navlink>
      </a>
      <a href="localhost:3000/blog">
        <navlink>Blog</navlink>
      </a>
      <a href="localhost:3000/status">
        <navlink>Status</navlink>
      </a>
      <a href="localhost:3000/careers">
        <navlink>Careers</navlink>
      </a>
      <a href="localhost:3000/brandResources">
        <navlink>Brand Resources</navlink>
      </a>
      <a href="localhost:3000/advertising">
        <navlink>Advertising</navlink>
      </a>
      <a href="localhost:3000/marketing">
        <navlink>Marketing</navlink>
      </a>
      <a href="localhost:3000/xForBusiness">
        <navlink>X for Business</navlink>
      </a>
      <a href="localhost:3000/devs">
        <navlink>Developers</navlink>
      </a>
      <a href="localhost:3000/directory">
        <navlink>Directory</navlink>
      </a>
      <a href="localhost:3000/setting">
        <navlink>Settings</navlink>
      </a>
      <div class="copyright">
        &copy; 2023 XClone (this is a clone website)
      </div>
    </div>
  </nav>

  <!--CREATE ACCOUNT MODAL-->
</body>
<script src="./landingPage.js"></script>
<script type="text/javascript" src="./login.js"></script>
<script type="text/javascript" src="../helpers/sendVerificationCode.js"></script>
<script type="text/javascript" src="../helpers/compareVerificationCode.js"></script>

<!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

</html>