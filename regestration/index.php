<?php

require 'function.php';

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $select = new Select();
    $row = $select->selectUserById($id);
    } else {
    header("Location: login.php");
    }
    ?>

    <!DOCTYPE html>
    <html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Index</title>
    </head>
    <body>
        <h1>Welcome <?php echo $row["Name"]; ?></h1>
        <a href="logout.php">Logout</a>
    </body>
</html>
