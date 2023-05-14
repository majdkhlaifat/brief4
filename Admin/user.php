<?php   include "include/connection.php";
require '../regestration/function.php';
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $select = new Select();
    $row = $select->selectUserById($id);
    } else {
    header("Location: login.php");
    }
    ?>


<?php


if(isset($_GET['id1'])){

	$id1 = $_GET["id1"];
	$query = "DELETE FROM users WHERE id  = $id1";
    mysqli_query($conn,$query);
}


if(isset($_POST['submit1'])){

	$name1 = $_POST['Name'];

	$Email1=$_POST['Email'];
	$Password1=$_POST['Password'];
	$Mobile1=$_POST['Mobile'];
	$Address1=$_POST['Address'];
    $city1 = $_POST['city'];
	$image1 = $_POST['image'];

	$query = "UPDATE users SET Name='$name1', Email='$Email1', Password='$Password1', Mobile='$Mobile1', City='$city1', Address='$Address1' , image='$image1', rule=3 WHERE id={$_GET['id2']}";
	
			mysqli_query($conn,$query);

			header("Location: user.php?msg= Update successfully");

	}

	if (isset($_POST["submit"])) {
		$name = $_POST['Name'];
	
		$Email=$_POST['Email'];
		$Password=$_POST['Password'];
		$Mobile=$_POST['Mobile'];
		$Address=$_POST['Address'];
		$city = $_POST['city'];
		$image = $_POST['image'];

	
		$sql = "INSERT INTO `users`(`Name`, `Email`, `Password`, `Mobile`, `City`, `Address`,`image`,  `rule`) VALUES ('$name','$Email','$Password','$Mobile','$city','$Address' ,'$image',3)";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			header("Location: user.php?msg=New User added successfully");
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- bootstrap -->
	
	<!-- My CSS -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/content.css">

	<style>
<?php 
                            if(isset($_GET['id2'])){
                                echo 
                            ' #add{display:none;}';
							' #edit{display:block;}';
                            }
                                else 
                                echo 
								' #edit{display:none;}';
                                        
                            ?>
	</style>


	<title>User Dashbord</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="main.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="user.php">
					<i class='bx bx-user' class="black_icon" ></i>
					<span class="text">Users</span>
				</a>
			</li>
			<li>
			<?php
				   $user = $select->selectUserById($_SESSION["id"]); // Fetch user record
				   $ruleId = $user['rule']; // Get the value of ruleId from the user record
				   
			if($ruleId==1 ){

				echo '<a href="admin.php">';
			}else{
				echo '<a href="#">';
                }
				?>					<i class='bx bx-user' class="black_icon" ></i>
					<span class="text">Admin</span>
				</a>
			</li>
			<li>
				<a href="Categories.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Categories</span>
				</a>
			</li>
			<li>
				<a href="product.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Product</span>
				</a>
			</li>
			<li>
				<a href="order.php">
					<i class='bx bx-cart-alt' class="black_icon"  ></i>
					<span class="text">Order</span>
				</a>
			</li>
            <li>
				<a href="profile.php">
					<i class='bx bx-cart-alt' class="black_icon"  ></i>
					<span class="text">Profile</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="../regestration/logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text black_icon">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="profile.php" class="profile">
			<img class="shadow" src="img/<?php echo $row["image"] ?>" alt="">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-contanier">
                <div class="head-left">
                <h1>Users</h1>
                <h3>Dashbord / Users</h3>
                </div>
                <div class="head-right">
                <button class="add-btn"><a href="#add">Add User</a></button>
                </div>
            </div>
			

    <div class="user-container">
        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
        ?>
        <table class="table" >
            <thead style="background-color:black; color:white; ">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">City</th>
                    <th scope="col">Address</th>
					<th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `users` where rule = 3" ;
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                    <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row["Name"] ?></td>
                        <td><?php echo $row["Email"] ?></td>
                        <td><?php echo $row["Password"] ?></td>
                        <td><?php echo $row["Mobile"] ?></td>
                        <td><?php echo $row["City"] ?></td>
                        <td><?php echo $row["Address"] ?></td>
						<td> <img class="cat_img" src="img/<?php echo $row["image"] ?>" alt=""></td>

                        <td>
                            <a href="user.php?id2=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-file-pen  fs-5 me-3"></i></a>
                            <a href="user.php?id1=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
				<?php
				

?>
            </tbody>
        </table>
    </div>
   
                <div class="add-contanier">
                <form action="" method="POST" class=add-user id=add>
					<input  type="text" name="Name" placeholder="Name">
					<input type="text" name="Email" placeholder="Email">
					<input type="text" name="Password" placeholder="Password">
					<input type="text" name="Mobile" placeholder="Mobile">
					<input  type="text" name="Address" placeholder="Address">
					<select class="sel-city" name="city" id="">
					<option value="Amman">Amman</option>
					<option value="Salt">ASSalt</option>
					<option value="Irbid">Irbid</option>
					<option value="Madaba">Madaba</option>
					<option value="ajloun">Ajloun</option>
					<option value="jerash">Jerash</option>
					<option value="mafraq">Mafraq</option>
					<option value="aqapa">AL-Aqapa</option>
					<option value="Maan">Maan</option>
					<option value="kark">AL-Karak</option>
					<option value="tafila">Al-Tafila</option>
					<option value="Zarqa">AL_Zarqa</option>

					</select>
					<input  type="file" name="image" placeholder="image" >


                            
                                
                                <button class="add-update-btn" name="submit">ADD</button>
                                        
                            
				</form>
				<?php 
				                            if(isset($_GET['id2'])){

					$sql = "SELECT * FROM `users` WHERE id = '{$_GET['id2']}'";
					$result = mysqli_query($conn, $sql);
		 $row = mysqli_fetch_assoc($result);
		}
				?>

				<form action="" method="POST" class=add-user id=edit >
					<input  type="text" name="Name" placeholder="Name" value="<?php echo $row["Name"]; ?>">
					<input type="text" name="Email" placeholder="Email" value="<?php echo $row["Email"]; ?>">
					<input type="text" name="Password" placeholder="Password" value="<?php echo $row["Password"]; ?>">
					<input type="text" name="Mobile" placeholder="Mobile" value="<?php echo $row["Mobile"]; ?>">
					<input  type="text" name="Address" placeholder="Address" value="<?php echo $row["Address"]; ?>">
					<select class="sel-city" name="city" id="" value="<?php echo $row["city"]; ?>">
					<option value="Amman">Amman</option>
					<option value="Salt">ASSalt</option>
					<option value="Irbid">Irbid</option>
					<option value="Madaba">Madaba</option>
					<option value="ajloun">Ajloun</option>
					<option value="jerash">Jerash</option>
					<option value="mafraq">Mafraq</option>
					<option value="aqapa">AL-Aqapa</option>
					<option value="Maan">Maan</option>
					<option value="kark">AL-Karak</option>
					<option value="tafila">Al-Tafila</option>
					<option value="Zarqa">AL_Zarqa</option>

					</select>
					<input  type="file" name="image" placeholder="image">
					<button class="add-update-btn" name="submit1">Update</button>

				</form>

    </div>
	
	</section>
	<!-- CONTENT -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	
	<script src="js/script.js"></script>
</body>
</html>