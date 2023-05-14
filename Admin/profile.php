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





if(isset($_POST['submit'])){
	$name1 = $_POST['Name'];
    $id1 = $_SESSION["id"];
     $image = $_POST['image'];
	$Email1=$_POST['Email'];
	$Mobile1=$_POST['Mobile'];
	$Address1=$_POST['Address'];
    $city1 = $_POST['city'];

	$query = "UPDATE users SET Name='$name1', Email='$Email1', Mobile='$Mobile1', City='$city1', Address='$Address1' , image='$image' WHERE id=$id1";
			mysqli_query($conn,$query);
			header("Location: profile.php?msg= Update successfully");
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
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="css/style.css">

	<link rel="stylesheet" href="css/Profile.css">
	<link rel="stylesheet" href="css/content.css">


	<title>Admin Profile</title>
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
		<?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
        ?>
		<section class="py-5 my-5">
		<div class="container">
			<h1 class="mb-5">Account Settings</h1>
			<div class="bg-white shadow rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
						<img class="shadow" src="img/<?php echo $row["image"] ?>" alt="">
						</div>
						<h4 class="text-center"><span><?php echo $row["Name"]; ?></span></h4>
					</div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i> 
							Account
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Password
						</a>
					
						<a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab" aria-controls="notification" aria-selected="false">
							<i class="fa fa-bell text-center mr-1"></i> 
							Notification
						</a>
					</div>
				</div>
				<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
						<h3 class="mb-4">Account Settings</h3>
					
						<form action="" method="POST" >


						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label> Name</label>
								  	<input type="text" class="form-control" name="Name" value="<?php echo $row["Name"]; ?>">
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Email</label>
								  	<input type="text" class="form-control" name="Email" value="kiranacharya287@gmail.com">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Mobile</label>
								  	<input type="text" class="form-control" name="Mobile" value="+91 9876543215">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Address</label>
								  	<input type="text" class="form-control" name="Address"value="Kiran Workspace">
								</div>
							
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>City</label>
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
						</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
								  	<label>Upload Image</label>
					<input  type="file" name="image" placeholder="image" >
								</div>
							
							</div>
							
						</div>
						<div>
							<button class="btn btn-primary" name="submit">Update</button>
							<button class="btn btn-light">Cancel</button>
						</div>
					</div>
	</form>
					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<h3 class="mb-4">Password Settings</h3>

						<form action="" method="POST" >

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Old password</label>
								  	<input type="password" class="form-control">
								</div>
							</div>
						</div>

						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>New password</label>
								  	<input type="password" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Confirm new password</label>
								  	<input type="password" class="form-control">
								</div>
							</div>
						</div>
						<div>
							<button class="btn btn-primary">Update</button>
							<button class="btn btn-light">Cancel</button>
						</div>
					</div>
					</form>

					<div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
						<h3 class="mb-4">Notification Settings</h3>
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="notification1">
								<label class="form-check-label" for="notification1">
									Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum accusantium accusamus, neque cupiditate quis
								</label>
							</div>
						</div>
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="notification2" >
								<label class="form-check-label" for="notification2">
									hic nesciunt repellat perferendis voluptatum totam porro eligendi.
								</label>
							</div>
						</div>
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="notification3" >
								<label class="form-check-label" for="notification3">
									commodi fugiat molestiae tempora corporis. Sed dignissimos suscipit
								</label>
							</div>
						</div>
						<div>
							<button class="btn btn-primary">Update</button>
							<button class="btn btn-light">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
	</section>
	<!-- CONTENT -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>