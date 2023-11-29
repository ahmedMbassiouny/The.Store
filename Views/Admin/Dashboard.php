<?php
    require_once './Shared/Links.php';
    require_once './Shared/Header.php';
    require_once './Shared/Sidebar.php';
    require_once __DIR__ . "../../../Models/DBManager.php";
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>
    <!-- End Page Title -->
    <?php
    $db = DBManager::getInstance();
    $countOfProducts = $db->apply_function_to_column("COUNT", "Products", "productID");
    $sales = $db->apply_function_to_column("SUM","Orders", "totalAmount");
    $custs = $db->apply_function_to_column('COUNT','Users', "userName", "role", "customer");
    $limitTopSales = 5;
    $prods= $db->select("SELECT p.productID, p.productName, p.price, p.stockQuantity, p.numSales, p.categoryID, p.imgURL, c.categoryName FROM Products p JOIN Categories c ON p.categoryID = c.categoryID ORDER BY p.numSales DESC LIMIT ". $limitTopSales);

    ?>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Number Of Prouducts</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $countOfProducts ?></h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Sales Card -->

                    <!-- Total  Money Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">


                            <div class="card-body">
                                <h5 class="card-title">Total Sales</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-dollar-sign"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>$ <?php echo isset($sales)? $sales:0; ?></h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">



                            <div class="card-body">
                                <h5 class="card-title">Customers</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $custs ?></h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- End Customers Card -->



                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Top Selling</h5>

                                <table class="table table-border text-center">
                                <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Preview</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Sales</th>
                                            <th>Category</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    # helper function to chooce unique color for each category
                                    function getCategoryColor($categoryName)
                                    {
                                        $hash = md5($categoryName);
                                        return '#' . substr($hash, 0, 6);
                                    }
                                    ?>
                                    <?php foreach ($prods as $row) : ?>

                                        <tbody>
                                            <tr>
                                                <td><span class="fw-bold"><?php echo $row['productID']; ?></span></td>
                                                <th><span><img width="60" height="60" src="<?php echo $row['imgURL']; ?>" alt=""></span></th>
                                                <td><span class="fw-bold"><?php echo $row['productName']; ?></span></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td><?php echo $row['stockQuantity']; ?></td>
                                                <td class="fw-bold"><?php echo $row['numSales']; ?></td>
                                                <td>

                                                    <div class="text-center" style="background-color: <?php echo getCategoryColor($row['categoryName']); ?>; padding: 5px; border-radius: 5px;"><?php echo $row['categoryName']; ?></div>
                                                </td>
                                                <td>
                                                    <button class=" text-center btn btn-info"><i class="fa-solid fa-pen-to-square"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php endforeach; ?>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- End Top Selling -->

                </div>
            </div>

        </div>
    </section>

</main>

<!-- <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<script src="./../../assets/js/main.js"></script>


<?php

require_once './Shared/Footer.php';

?>