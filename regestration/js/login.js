function validateForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var emailError = document.getElementById("emailError");
    var passwordError = document.getElementById("passwordError");

    if (email.trim() === "") {
        emailError.textContent ="Enter your email.";
        return false;
    }

    if (password.trim() === "") {
        passwordError.textContent ="Enter your password.";
        return false;
    }

    // Submit the form if all validations pass
    return true;
}