const wrapper = document.querySelector(".wrapper");
const loginLink = document.querySelector(".login-link"); // Assuming you only have one .login-link element

// Select all register links
const registerLinks = document.querySelectorAll(".register-link");

// Login Form Elements
const loginForms = document.querySelectorAll(".form-box.login");

// Function to show a specific login form
function showLoginForm(formId) {
  loginForms.forEach((form) => {
    form.classList.remove("active");
  });

  document.getElementById(formId).classList.add("active");
}

// Initial State: Show User Login Form
showLoginForm("userLoginForm"); // Default to user login

// Event Listeners for Login/Register Toggle
registerLinks.forEach((link) => {
  // Add event listeners to all register links
  link.addEventListener("click", () => {
    wrapper.classList.add("active");

    // When switching to register, hide all login forms
    loginForms.forEach((form) => {
      form.classList.remove("active");
    });
  });
});

loginLink.addEventListener("click", () => {
  wrapper.classList.remove("active");

  // When switching back to login, show the default (user) login form
  showLoginForm("userLoginForm");
});
