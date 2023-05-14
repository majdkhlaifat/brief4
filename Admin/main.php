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

	$query = "UPDATE users SET Name='$name1', Email='$Email1', Password='$Password1', Mobile='$Mobile1', City='$city1', Address='$Address1', rule=3 WHERE id={$_GET['id2']}";
	
			mysqli_query($conn,$query);
	}

	if (isset($_POST["submit"])) {
		$name = $_POST['Name'];
	
		$Email=$_POST['Email'];
		$Password=$_POST['Password'];
		$Mobile=$_POST['Mobile'];
		$Address=$_POST['Address'];
		$city = $_POST['city'];
	
		$sql = "INSERT INTO `users`(`Name`, `Email`, `Password`, `Mobile`, `City`, `Address`,  `rule`) VALUES ('$name','$Email','$Password','$Mobile','$city','$Address',3)";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			header("Location: main.php?msg=New record created successfully");
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


	<title>Dashbord</title>
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
				?>
					<i class='bx bx-user' class="black_icon" ></i>
					<span class="text">Admin</span>
				</a>
			</li>
			<li>
				<a href="Categories.php">
					<i class='bx bxs-message-dots black_icon'></i>
					<span class="text">Categories</span>
				</a>
			</li>
			<li>
				<a href="product.php">
					<i class="bx bxs-message-dots black_icon" ></i>
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
					<span class="text" >Profile</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="../regestration/logout.php" class="logout">
					<i class='bx bxs-log-out-circle black_icon"' ></i>
					<span class="text" class="black_icon">Logout</span>
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
			
		<h1 class="dash-head" >Welcome <span><?php echo $row["Name"]; ?></span> </h1>
        <h3 class="dash-head">Dashbord </h3>

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
			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>1020</h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3> <?php
                    $sql = "SELECT * FROM `users` where `rule`=3" ;
                    $results = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($results);
					echo mysqli_num_rows($results); 
                    ?></h3>
						<p>Total Users</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>$2543</h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>
        
	</section>
	<!-- CONTENT -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	
	<script src="js/script.js"></script>
</body>
</html>