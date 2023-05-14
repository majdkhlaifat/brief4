<?php
session_start();

 require 'header.php'; 


$nameError = $emailError = $passwordError = $confirmPasswordError = $mobileError = "";

if (isset($_POST["submit"])) {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $img = $_POST['img'];

    $isValid = true;

    $_id = $_SESSION["id"];

    // Validate name
    if (empty(trim($name))) {
        $nameError = "Name can't be blank"; 
        $isValid = false;}

    // Validate email
    if (empty($email)) {
        $emailError = "email cant be blank";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
        $isValid = false;
    } 


    // Validate password
    if (empty($password)) {
        $passwordError = "password cant be blank";
        $isValid = false;
    } elseif (!preg_match("/^(?=.[0-9])(?=.[a-z])(?=.[A-Z])(?=.\W)(?!.* ).{8,16}$/", $password)) {
        $passwordError = "Invalid password";
    }

    // Validate confirm password
    if (empty($confirmpassword)) {
        $confirmPasswordError = "confirm password cant be blank";
        $isValid = false;
    } elseif ($password !== $confirmpassword) {
        $confirmPasswordError = 'Password does not match.';
        
        $isValid = false;
    }

    //Validate mobile number
    if (empty($phone)) {
        $mobileError = "mobile cant be blank";
        $isValid = false;
    }else if (!preg_match("/^\+9627\d{7}$/" , $phone)){
            $mobileError= "Mobile number should be equal 10 digits";
    }

    
    if ( filter_var($email, FILTER_VALIDATE_EMAIL)  &&
    preg_match("/^(?=.[0-9])(?=.[a-z])(?=.[A-Z])(?=.\W)(?!.* ).{8,16}$/", $password) &&
    $password === $confirmpassword 
      ) {
         $conn2 = mysqli_connect('localhost', 'root', '', 'organic');
         $sql = "UPDATE `users` SET `Name`='$name',`Email`='$email',
            `Password`='$password',`Mobile`='$phone',`City`='$city',`Address`='$address' , `image` = '$img'
         WHERE `id`= '$_id' ";
         $result = mysqli_query($conn2, $sql);
          

    }
}



 $_id =  $_SESSION["id"];

$conn = mysqli_connect('localhost', 'root', '', 'organic');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM `users` WHERE id= $_id ";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Error: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);


?>

<title> edit profile </title>


<body>
    <div class="container mt-5">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">

                    <div class="card-body">

                        <div class="account-settings">
                            <div class="user-profile">

                                <div class="user-avatar mt-2">
                                    <?php echo '<img src="image/jpeg;base64,' . base64_encode($row['image']) . ' alt= "' . $row['Name'] . '"   width="200" height="150">' ?>
                                    <h2 class="user-name mt-3">
                                        <?= $row['Name']; ?>
                                    </h2>

                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100 ">
                    <form method="POST" action="" enctype="multipart/form-data" >

                        <div class="card-body mt-2">

                            <div class="row gutters">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h2 class="m-2 tit">Personal Details</h2>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>" />

                                        <label for="fullName" class="col-form-label-lg">Full Name:</label>
                                        <input type="text" class="form-control form-control-lg" name="name" id="name"
                                            placeholder="Enter full name" value="<?= $row['Name']; ?>">
                                            <span id="nameError">
                                                <?= $nameError ?>
                                            </span>

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="eMail" class="col-form-label-lg">Email:</label>
                                        <input type="text" class="form-control form-control-lg" name="email" id="email"
                                            placeholder="Enter email ID" value="<?= $row['Email']; ?>">
                                        <span id="emailError">
                                            <?= $emailError ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone" class="col-form-label-lg">Phone:</label>
                                        <input type="text" class="form-control form-control-lg" name="phone" id="mobile"
                                            placeholder="Enter phone number" value="<?= $row['Mobile']; ?>">
                                        <span id="mobileError">
                                            <?= $mobileError ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="sTate" class="col-form-label-lg">Password:</label>
                                        <input type="text" class="form-control form-control-lg" name="password"
                                            id="password" placeholder="Enter State" value="<?= $row['Password']; ?>">
                                        <span id="passwordError">
                                            <?= $passwordError ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="sTate" class="col-form-label-lg">Confirm Password:</label>
                                        <input type="text" class="form-control form-control-lg" name="confirmpassword"
                                            id="confirmpassword" placeholder="Enter State"
                                            value="<?= $row['Password']; ?>">
                                        <span id="confirmpasswordError">
                                            <?= $confirmPasswordError ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label col-form-label-lg">Edit User
                                            img:</label>
                                        <input class="form-control form-control-lg" type="file" id="" name="img"
                                            value="<?php $row['image'] ?>">
                                        <span id=""></span>
                                    </div>

                                </div>


                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h2 class="mt-3 m-2 tit">Address</h2>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="Street" class="col-form-label-lg">Address:</label>
                                        <input type="name" class="form-control form-control-lg" name="address" id=""
                                            placeholder="Enter Street" value="<?= $row['Address']; ?>">
                                        <span id=""></span>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">

                                        <label for="ciTy" class="col-form-label-lg">City:</label>
                                        <input type="name" class="form-control form-control-lg" name="city" id=""
                                            placeholder="Enter City" value='<?= $row['City']; ?>'>
                                        <span id=""></span>
                                    </div>
                                </div>


                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">

                                        <button type="submit" name="submit"
                                            class="btn btn-secondary btn-lg">Update</button>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
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

            let passwordregex = /^(?=.[0-9])(?=.[a-z])(?=.[A-Z])(?=.\W)(?!.* ).{8,16}$/;
            let emailregex = /^([a-z0-9\+\-]+)(\.[a-z0-9\+\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;

            if (name.trim() === "") {
                nameError.textContent = "Please enter a username";
                nameError.style.color = "red";
                return false;
            }

            if (email.trim() === "") {
                emailError.textContent = "Please enter your email";
                emailError.style.color = "red";
                return false;
            } else if (!emailregex.test(email)) {
                emailError.textContent = "Invalid email format";
                emailError.style.color = "red";
                return false;
            }

            if (password.trim() === "") {
                passwordError.textContent = "Please enter your password";
                passwordError.style.color = "red";
                return false;
            } else if (!passwordregex.test(password)) {
                passwordError.textContent = "Please enter a valid password";
                passwordError.style.color = "red";
                return false;
            }

            if (confirmPassword.trim() === "") {
                confirmPasswordError.textContent = "Please confirm your password";
                confirmPasswordError.style.color = "red";
                return false;
            } else if (confirmPassword !== password) {
                confirmPasswordError.textContent = "Password does not match";
                confirmPasswordError.style.color = "red";
                return false;
            }

            if (mobile.trim() === "") {
                mobileError.textContent = "Please enter your phone number";
                mobileError.style.color = "red";
                return false;
            } else if (!/^\d{10}$/.test(mobile)) {
                mobileError.textContent = "Phone number should be 10 digits";
                mobileError.style.color = "red";
                return false;
            }


            return true;
        }

    </script>
<?php
require('footer.php');
?>

</body>

</html>