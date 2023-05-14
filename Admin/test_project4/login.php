<?php
require 'function.php';

if (!empty($_SESSION["id"])) {
    header("Location: index.php");
}

$login = new Login();
$passwordError = $emailError = "";

$email = $password = "";
$errors = array();

if (isset($_POST["submit"])) {
    $email = $_POST["Email"];
    $password = $_POST["Password"];

    // Validate username or email
    if (empty($email)) {
        $errors[] = "Enter your email.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Enter your password.";
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
                header("Location: admin.php");
                exit;
                }else{
                    header("Location: index.php");
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
        <link href="login.css" rel="stylesheet">
        <style>
        .error {
            color: red;
        }
        </style>
    </head>
    <body>
        <h2>Login</h2>
        <form class="" action="" method="post" autocomplete="off">
        <label for="">Email:</label>
        <input type="text" name="Email" value="<?= htmlspecialchars($email) ?>"> <br>
        <span class="error"><?= $emailError ?></span>
        <?php if (in_array("Enter your email.", $errors)) echo "<span class='Enter your email.</span>"; ?>
        <br>

        <label for="">Password:</label>
        <input type="password" name="Password" value=""> <br>
        <span class="error"><?= $passwordError ?></span>
        <?php if (in_array("Enter your password.", $errors)) echo "<span class='error'>Enter your password.</span>"; ?>
        <br>

        <button type="submit" name="submit">Login</button>

        
        </form>
        <br>
        <a href="registration.php">Registration</a>

        <script src="login.js"></script>

    </body>
</html>
