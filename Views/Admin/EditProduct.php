<?php
    require_once './Shared/Links.php';
    require_once './Shared/Header.php';
    require_once './Shared/Sidebar.php';
    require_once __DIR__ . "../../../Models/DBManager.php";
?>
<?php


global $db;
$db = DBManager::getInstance();
$product = $db->select(
    "
    SELECT p.*, c.categoryName
    FROM Products p
    JOIN Categories c ON p.categoryID = c.categoryID
    WHERE p.productID = " . $_GET["productID"]
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPrice = $_POST['price_'];
    $newStock = $_POST['stock_'];
    $columnsValues = [
        "price" => $newPrice,
        "stockQuantity" => $newStock
    ];
    $productId = $_GET["productID"];

    $db->update("Products", $productId, $columnsValues);
    header("Location: {$_SERVER['PHP_SELF']}?productID=" . $productId);
    exit();
}


?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Product</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card shadow p-2">
                            <div class="row">
                                <div class="col-lg-3 col-12">
                                    <img src="<?php echo $product[0]["imgURL"]; ?>" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-5 col-12 m-2">
                                    <p>Product ID : <?php echo $product[0]["productID"]; ?><span></span></p>
                                    <p>Product Name : <?php echo $product[0]["productName"]; ?> <span></span></p>
                                    <p>Product Describtion : <?php echo $product[0]["description"]; ?> <span></span></p>
                                    <p>Product Price :<?php echo $product[0]["price"]; ?> <span></span></p>
                                    <p>Product Stock :<?php echo $product[0]["stockQuantity"]; ?> <span></span></p>
                                    <p>Product Category :<?php echo $product[0]["categoryName"]; ?> <span></span></p>
                                    <p>Product Sales :<?php echo $product[0]["numSales"]; ?> <span></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Edit</h5>
                                <form class="row g-3" method="post">
                                    <div class="col-12">
                                        <label for="price_" class="form-label">Price </label>
                                        <input type="number" class="form-control" id="price_" name="price_">
                                    </div>
                                    <div class="col-12">
                                        <label for="stock_" class="form-label">Stock</label>
                                        <input type="number" class="form-control" id="stock_" name="stock_">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="col-12 btn btn-primary">Update</button>
                                    </div>
                                </form>
                                <!-- Vertical Form -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End Left side columns -->
        </div>
    </section>

</main><!-- End #main -->


















<script src="./../../assets/js/main.js"></script>


<?php

require_once './Shared/Footer.php';

?>