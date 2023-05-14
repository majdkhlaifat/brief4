<?php
require 'connection.php';
session_start();
$id = $_GET['id'];

// Check if 'id' parameter is provided
if (isset($_GET['id'])) {
    $category = $_GET['id'];

    // Fetch category name from the database
    $categorySql = "SELECT name FROM `category` WHERE id = '$category'";
    $categoryResult = mysqli_query($conn, $categorySql);
    $categoryRow = mysqli_fetch_assoc($categoryResult);
    $categoryName = $categoryRow['name'];

    // Fetch products from the database based on the category ID
    $sql = "SELECT * FROM `products` WHERE category = $category";
    $result = mysqli_query($conn, $sql);

    // Check if the query returned any results
    if (mysqli_num_rows($result) > 0) {
        // Display the products
        ?>
        <!-- header section starts  -->
        <?php require 'header.php'; ?>
        <!-- header section ends -->

        <!-- product section starts  -->
        <section class="product" id="product">
            <h1 class="heading"><?php echo $categoryName; ?></h1>
            

            <div class="box-container">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="box">
                    <?php echo $row['id'];?>
                        <span class="discount">-<?php echo $row['discount']; ?>%</span>
                        <div class="icons">
                            <a href="#" class="fas fa-heart"></a>
                            <a href="singleproduct.php?id=<?php echo $row["id"] ?>" class="fas fa-share"></a>                            <a href="#" class="fas fa-eye"></a>
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
                        <a href="cart.php?value=<?php echo $row['id']; ?>" class="btn">Add to cart</a>

                    </div>
                <?php } ?>
            </div>
        </section>
        <!-- product section ends -->

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
