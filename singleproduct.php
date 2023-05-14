<?php
require 'connection.php';







session_start();
$id = $_GET['id'];

// Check if 'id' parameter is provided
if (isset($_GET['id'])) {
    $prodact1 = $_GET['id'];

 
    // Fetch products from the database based on the category ID
    $sql = "SELECT * FROM `products` WHERE id = $prodact1";
    $result = mysqli_query($conn, $sql);

    // Check if the query returned any results
    if (mysqli_num_rows($result) > 0) {
        // Display the products
        ?>
        <!-- header section starts  -->
        <?php require 'header.php'; ?>
        <!-- header section ends -->

        <!-- product section starts  -->
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <section class="product" id="product">
            <h1 class="heading"><?php echo $row['name']; ?></h1>

            <div class="box-container">
                    <div class="box">
                        <span class="discount">-<?php echo $row['discount']; ?>%</span>
                        <div class="icons">
                            <a href="#" class="fas fa-heart"></a>
                            <a href="#" class="fas fa-share"></a>
                            <a href="#" class="fas fa-eye"></a>
                        </div>
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" alt="User Image" width="200" height="150">' ?>
                        <h3><?php echo $row['name']; ?></h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <div class="price">
                            JD<?php $after_dis = $row['price'] - ($row['price'] * $row['discount'] / 100); ?>
                            <span>JD<?php echo $row['price']; ?></span>
                        </div>
                        <div class="quantity">
                            <span>quantity : </span>
                            <input type="number" min="1" max="1000" value="1">
                            <span>/kg</span>
                        </div>
                        <a href="cart.php" class="btn">add to cart</a>
                    </div>
                <?php } ?>
            </div>
        </section>
        <!-- product section ends -->

       
<!-- COMMENT SECTION -->
<?php
$sql = "SELECT * FROM `comment` where product_id = $id ";
$result = mysqli_query($conn, $sql);


    ?>
    <div class="comments" style="height:100px width:100%">

        <form action="" method="POST">
            <label for="">name</label>
            <input type="text" name="name">
            <label for="">email</label>
            <input type="text" name="email">
            <label for="">comment text</label>
            <input type="text" name="comment_text">
        <button type="submit" name="submit" >comment</button>
        </form>
    </div>


<!-- comment end -->
<?php
        require('footer.php');
    } else {
        // No products found in the category
        echo "No products found in the category.";
    }
} else {
    // 'id' parameter not provided
    echo "No category ID specified.";
}
?>