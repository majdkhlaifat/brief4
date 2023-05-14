<?php
require 'function.php';

if (!empty($_SESSION["id"])) {
    header("Location: index.php");
}

$register = new Register();
$nameError = $emailError = $passwordError = $confirmPasswordError = $mobileError =  "";

if (isset($_POST["submit"])) {
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $password = $_POST["Password"];
    $confirmpassword = $_POST["confirmpassword"];
    $mobile = $_POST["Mobile"];

    $isValid = true;

    // Validate name
    if (empty($name)) {
        $nameError = "Name is required.";
        $isValid = false;
    }

    // Validate email
    if (empty($email)) {
        $emailError = "Email is required.";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
        $isValid = false;
    }

    // Validate password
    if (empty($password)) {
        $passwordError = "Password is required.";
        $isValid = false;
    }elseif(!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/", $password)){
        $passwordError= "Invalid password";
    }

      // Validate confirm password
    if (empty($confirmpassword)) {
        $confirmPasswordError = "Confirm password is required.";
        $isValid = false;
    } elseif ($password !== $confirmpassword) {
        $confirmPasswordError = "Password does not match.";
        $isValid = false;
    }

    //Validate mobile number
    if (empty($mobile)) {
        $mobileError = "Mobile number is required.";
        $isValid = false;
    }else{
        $length = strlen ($mobile); 
        if($length != 10){
            $mobileError= "Mobile number should be equal 10 digits";
    }
    }
    if ($isValid) {
        $result = $register->registration($name, $email, $password, $confirmpassword, $mobile);
    
        if ($result == 1) {
            echo "<script> alert('Registration Successful'); </script>";
            } elseif ($result == 10) {
            echo "<script> alert('Username or Email Has Already Taken'); </script>";
            } elseif ($result == 100) {
            echo "<script> alert('Password Does Not Match'); </script>";
            }
        }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
        <!-- <link rel="stylesheet" href="registration.css"> -->
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    </head>
    <body>
        <h2>Registration</h2>
        <form class="" action="" method="post" autocomplete="off">
        <label for="name">Name:</label>
        <input type="text" id="name" name="Name" value="<?= isset($name) ? $name : '' ?>">
        <span class="error"><?= $nameError ?></span>
        <br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="Email" value="<?= isset($email) ? $email : '' ?>">
        <span class="error"><?= $emailError ?></span>
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="Password" value="<?= isset($password) ? $password : '' ?>">
        <span class="error"><?= $passwordError ?></span>
        <br>

        <label for="confirmpassword">Confirm Password:</label>
        <input type="password" id="confirmpassword" name="confirmpassword"value="<?= isset($confirmPasswordError) ? $confirmPasswordError : '' ?>">
        <span class="error"><?= $confirmPasswordError ?></span>
        <br>

        <label for="confirmpassword">Mobile:</label>
        <input type="number" id="mobile" name="Mobile" value="<?= isset($mobileError) ? $mobileError : '' ?>">
        <span class="error"><?= $mobileError ?></span>
        <br>

        <button type="submit" name="submit">Register</button>
        </form>
    <p class="que">Do you have account?<a href="login.php">Login</a></p>
    
    <script src="registration.js"></script>
    </body>
</html>