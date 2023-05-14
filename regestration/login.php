<?php
require 'function.php';


if (!empty($_SESSION["id"])) {
}

$login = new Login();
$passwordError = $emailError = "";

$email = $password = "";
$errors = array();

if (isset($_POST["submit"])) {
    $email = $_POST["Email"];
    $password = $_POST["Password"];

    // Validate username or email
    if (empty($_POST["Email"])) {
        $errors[] = "Enter your email.";
    } else {
        $email = $_POST["Email"];
    }
    
    if (empty($_POST["Password"])) {
        $errors[] = "Enter your password.";
    } else {
        $password = $_POST["Password"];
    }

    if (empty($errors)) {
        $result = $login->login($email, $password);
    
        if ($result == 1) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $login->idUser();
            $select = new Select(); 
            $user = $select->selectUserById($_SESSION["id"]); // Fetch user record
            $ruleId = $user['rule']; // Get the value of ruleId from the user record
            
            if($ruleId==1 || $ruleId==2){
                header("Location: ../Admin/main.php");
                exit;
                }else{
                    header("Location: ../index.php");
                    exit;
                }
            } elseif ($result == 10) {
            echo "<script> alert('Wrong Password'); </script>";
            } elseif ($result == 100) {
            echo "<script> alert('User Not Registered'); </script>";
            }
        }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link href="css/login.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="left">
            <h2>Welcome back</h2>
            <h2>Login</h2>
        <form class="" action="" method="post" autocomplete="off" onsubmit="return validateForm()">
        <label for="">Email:</label>
        <input type="text" name="Email" value="<?= htmlspecialchars($email) ?>"> <br>
        <?php if (in_array("Enter your email.", $errors)) echo "<span class='error'>Enter your email.</span>"; ?>
        <br>

        <label for="">Password:</label>
        <input type="password" name="Password" value=""> <br>
        <?php if (in_array("Enter your password.", $errors)) echo "<span class='error'>Enter your password.</span>"; ?>
        <br>

        <button type="submit" name="submit">Login</button>

        
        </form>
        <br>
        <p class="registration">Dont have account?<a href="registration.php">Sign Up</a></p>
            </div>
            <div class="right">

            </div>
        </div>

        <script src="js/login.js"></script>

    </body>
</html>
