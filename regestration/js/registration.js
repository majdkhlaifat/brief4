function validateForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmpassword").value;
    var mobile = document.getElementById("mobile").value;

    var nameError = document.getElementById("nameError");
    var emailError = document.getElementById("emailError");
    var passwordError = document.getElementById("passwordError");
    var confirmPasswordError = document.getElementById("confirmpasswordError");
    var mobileError = document.getElementById("mobileError");

    let passwordregex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/;
    let emailregex = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;

    if (name.trim() === "") {
        nameError.textContent = "Please enter a username";
        return false;
    }

    if (email.trim() === "") {
        emailError.textContent = "Please enter your email";
        return false;
    } else if (!emailregex.test(email)) {
        emailError.textContent = "Invalid email format";
        return false;
    }

    if (password.trim() === "") {
        passwordError.textContent = "Please enter your password";
        return false;
    } else if (!passwordregex.test(password)) {
        passwordError.textContent = "Please enter a valid password";
        return false;
    }

    if (confirmPassword.trim() === "") {
        confirmPasswordError.textContent = "Please confirm your password";
        return false;
    } else if (confirmPassword !== password) {
        confirmPasswordError.textContent = "Password does not match";
        return false;
    }

    if (mobile.trim() === "") {
        mobileError.textContent = "Please enter your phone number";
        return false;
    } else if (!/^\d{10}$/.test(mobile)) {
        mobileError.textContent = "Phone number should be 10 digits";
        return false;
    }

    return true;
}
