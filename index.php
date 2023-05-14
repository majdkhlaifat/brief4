<?php
require 'connection.php';
session_start();
?>
<!-- header section starts  -->

<?php

require 'header.php';
?>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="image">
        <img src="images/home-img.png" alt="">
    </div>

    <div class="content">
        <span>fresh and organic</span>
        <h3>your daily need products</h3>
        <a href="#" class="btn">get started</a>
    </div>

</section>

<!-- home section ends -->

<!-- banner section starts  -->
<?php 

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();}

    if (isset($_POST['add-cart'])) {
        $amount=$_POST['amount'];
        array_push($_SESSION['cart'],$_GET['id'],$amount);
      
    }
?>
<section class="banner-container">

    <div class="banner">
        <img src="images/banner-1.jpg" alt="">
        <div class="content">
            <h3>special offer</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">check out</a>
        </div>
    </div>

    <div class="banner">
        <img src="images/banner-2.jpg" alt="">
        <div class="content">
            <h3>limited offer</h3>
            <p>upto 50% off</p>
            <a href="#" class="btn">check out</a>
        </div>
    </div>

</section>

<!-- banner section ends -->

<!-- category section starts  -->

<section class="category" id="category">

    <h1 class="heading">shop by <span>category</span></h1>

    <div class="box-container">
    <?php
            $sql = "SELECT * FROM `category`" ;
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)){
                ?>
        <div class="box">
            <h3><?= $row['name']; ?></h3>
            <!-- <p>upto % off</p> -->
            
            <?php echo '<img src="data:img/jpeg;base64,' . base64_encode($row['img']) . '" alt="User Image" width="200" height="150">' ?>
            <a href="category.php?id=<?php echo $row["id"] ?>" class="btn">shop now</a>
        </div>
        <?php
                ?>
                <?php
            }
            ?>
      

    </div>

</section>

<!-- category section ends -->

<!-- product section starts  -->

<section class="product" id="product">

    <h1 class="heading">latest <span>products</span></h1>

    <div class="box-container">
    <?php 
      
      $sql = "SELECT * FROM `products`";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)){
          ?>
        <div class="box">
        
            <span class="discount">-<?=  $row['discount']; ?>%</span>
            <div class="icons">
                <a href="#" class="fas fa-heart"></a>
                <a href="singleproduct.php?id=<?php echo $row["id"] ?>" class="fas fa-share"></a>                <a href="#" class="fas fa-eye"></a>
            </div>

            

            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" alt="User Image" width="200" height="150">' ?>
            <h3><?=  $row['name']; ?></h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="price"> JD<?=  $row['price']-($row['price']*$row['discount']/100); ?> <span> JD<?=  $row['price']; ?></span> </div>
            <div class="quantity">
                <span>quantity : </span>
                <input type="number" min="1" max="1000" value="1">
                <span> /kg </span>
            </div>
            <a href="index.php?value=<?php echo $row['id']; ?>" class="btn">Add to cart</a>
            
         </div>
<?php
                ?>
                <?php
            }
            ?>
       

    </div>

</section>

<!-- product section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

    <h1 class="heading"> <span>contact</span> us </h1>

    <form action="">

        <div class="inputBox">
            <input type="text" placeholder="name">
            <input type="email" placeholder="email">
        </div>

        <div class="inputBox">
            <input type="number" placeholder="number">
            <input type="text" placeholder="subject">
        </div>

        <textarea placeholder="message" name="" id="" cols="30" rows="10"></textarea>

        <input type="submit" value="send message" class="btn">

    </form>

</section>

<!-- contact section ends -->

<!-- newsletter section starts  -->

<section class="newsletter">

    <h3>subscribe us for latest updates</h3>

    <form action="">
        <input class="box" type="email" placeholder="enter your email">
        <input type="submit" value="subscribe" class="btn">
    </form>

</section>

<!-- newsletter section ends -->
<?php
require('footer.php');
?>



