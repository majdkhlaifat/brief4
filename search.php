<?php
require 'connection.php';
session_start();
?>

<!-- header section starts  -->

<?php
require 'header.php';
$search = isset($_POST['search']) ? $_POST['search'] : '';
?>

<section class="product" id="product">
    <h1 class="heading">latest <span>products</span></h1>

    <?php
    if (!empty($search)) {
        $sql = "SELECT * FROM `products` WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        ?>
        
        <div class="box-container">
            <?php 
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['name']; // Move this line inside the while loop
                ?>
                <div class="box">
                    <span class="discount">-<?=  $row['discount']; ?>%</span>
                    <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
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
                    <a href="index.php?=" class="btn" name="add-cart">add to cart</a>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

</section>

<?php
require 'footer.php';
?>
