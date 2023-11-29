<?php
session_start();
require_once "Shared/top_code.php";
require_once "../../Models/ProductManager.php";
require_once "../../Models/selectedproductManager.php";
require_once "../../Models/cartManager.php";

$sucsessmsg = "";

$ProductMNG = new ProductManager();

$Product = $ProductMNG->viewProductInfo($_GET['id'])[0];
$categoryName = $ProductMNG->viewCategyInfo($Product['categoryID'])[0]['categoryName'];
$Categy_Products = $ProductMNG->viewCategyProducts($Product['categoryID'], 4);



$Cartmgr = new selectedproductManager();

$product = new cartManager();


$products = $product->viewProducts($_SESSION["userId"]);
$flag = 0;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST["add"])) {
    if ($products) {
      foreach ($products as $prod) {
        if ($prod["prod_id"] == $_GET["id"]) {
          $Cartmgr->updateQuantity($prod["proQuantity"], $prod["prod_id"], $_SESSION["userId"]);
          $flag = 1;
        }
      }
    }
    if ($flag == 0) {
      $Cartmgr->addToCart($_SESSION["userId"], $_GET["id"]);
    }
    $sucsessmsg = "product added successfully";
  }
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once 'Shared/head-code.php' ?>
  <style>
    .product-btn:hover {
      color: var(--main-color);
      background: #fff;
      border: 2px solid var(--main-color);
    }

    .product-btn {
      color: #fff;
      background: #1190c2;
      padding: 8px 20px;
      border-radius: 10px;
      font-size: 22px;
      font-weight: bold;
      width: 100%;
      margin-top: 10px;
      text-align: center;
      border: 2px solid var(--main-color);
      transition: 0.8s;
    }
  </style>
</head>

<body>
  <!-- ======= header ======= -->
  <?php
  include_once "Shared/header.php"
  ?>
  <!-- End header -->
  <div class="page-container container-fluid ">

    <?php
    if ($sucsessmsg != "") {
    ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        <?php echo $sucsessmsg; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
    }

    ?>

    <div id="myProduct-box" class="myProduct pt-2 mt-5">
      <div class="row justify-content-center">
        <div class="py-3 prod-img col-12 col-md-4 col-lg-4 d-flex justify-content-center align-items-center">
          <img class="img-fluid w-100 " style="max-width: 300px;max-height: 350px;" src="<?php echo $Product['imgURL']; ?>" alt="">
        </div>
        <div class="py-3 prod-img col-12 col-sm-6 col-md-4 col-lg-4 d-flex flex-column justify-content-evenly">
          <h2 style="color:var(--main-color);font-weight: bold;"><?php echo $Product['productName']; ?>
          </h2>
          <h5 class="text-black-50 product-desc"><?php echo $Product['description']; ?></h5>
          <p class="text-black-50 pt-2"><span class="text-black fw-bold">Category: </span><a id="cate-link" href="selected-category.php?id=<?php echo $Product['categoryID']; ?>" class="text-warning "><?php echo $categoryName; ?></a></p>
        </div>
        <div class="py-3 prod-price  col-12 col-sm-6 col-md-4 col-lg-4 d-flex align-items-center">
          <div class="w-100 p-3 rounded-3 d-flex flex-column justify-content-center" style="background: #fff; border: 2px solid var(--main-color);  ">
            <div class="price d-flex flex-column justify-content-between align-items-center w-100 ">
              <h4 class="fw-bold">Add To Cart</h4>
              <h4 class="fw-bold">$<?php echo $Product['price']; ?></h4>
              <h5 class="text-danger "><del class="text-black-50 ">$<?php echo $Product['price'] + 40; ?></del> ( $40 off )</h5>
            </div>
            <?php
            if ($Product['stockQuantity'] > 0) {
            ?>
              <form action="" method="post">
                <button name="add" class="product-btn my-2" type="submit">Add to cart</button>
              </form>
            <?php
            }
            ?>
            <div class=" d-flex justify-content-between align-items-center w-100">
              <?php
              if ($Product['stockQuantity'] > 0) {
              ?>
                <p class="fw-bold" style="color: var(--main-color);">
                  <i class="fa fa-check"></i> In Stoke
                </p>
              <?php
              } else {
              ?>
                <p class="fw-bold text-danger">
                  <i class="fa fa-times "></i> out of Stoke
                </p>
              <?php
              }
              ?>
            </div>
            <div class="delvery text-black-50 text-start ">
              <p>Number of sales :<span class="text-black"> <?php echo $Product['numSales']; ?></span></p>
              <p>Number of stock :<span class="text-black"> <?php echo $Product['stockQuantity']; ?></span></p>
              <p>Delivery - next day</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="categoryCards row mt-5">
        <div class="sp-title">
          <h3> Related Products </h3>
        </div>
        <div id="categoryCards-box" class="categoryCards-box row">
          <?php
          if ($Categy_Products) {
            foreach ($Categy_Products as $product) {
              if ($Product['productID'] != $product['productID']) {
          ?>
                <div class="my-card p-3 col-12 col-sm-6 col-lg-4 col-xl-3">
                  <div class=" p-3 rounded-3 d-flex flex-column justify-content-center align-items-center " style="background: #fff; border: 1px solid #cbd4d7;  ">
                    <div class="img-box d-flex flex-column justify-content-center align-items-center " style="cursor: pointer; height:300px;">
                      <a href="selected-product.php?id=<?php echo $product['productID']; ?>">
                        <img class="img-fluid pb-3" width="200px" style="max-height:300px;" src="<?php echo $product['imgURL'] ?>" alt="">
                      </a>
                    </div>
                    <div class="product-name">
                      <a href="selected-product.php?id=<?php echo $product['productID']; ?>">
                        <h3 onmouseover="this.style.color='#0066ff'" onmouseout="this.style.color='#1190c2'" style="cursor: pointer; color: #1190c2;"> <?php echo $product['productName'] ?> </h3>
                      </a>
                      <p><?php echo $product['description'] ?>
                      </p>
                    </div>
                    <div class="price d-flex justify-content-between w-100">
                      <div class="pr">$<?php echo $product['price'] ?> <del class="text-black-50 ">$<?php echo $product['price'] + 40 ?></del> </div>
                      <?php
                      if ($product['stockQuantity'] > 0) {
                      ?>
                        <p class="fw-bold" style="color: var(--main-color);">
                          <i class="fa fa-check"></i> In Stoke
                        </p>
                      <?php
                      } else {
                      ?>
                        <p class="fw-bold text-danger">
                          <i class="fa fa-times "></i> out of Stoke
                        </p>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
            <?php
              }
            }
          }
          if (count($Categy_Products) == 1) {
            ?>
            <!-- no product -->
            <div class="container my-5">
              <div class="row justify-content-center">
                <div class="col-md-6 ">
                  <div class="card ">
                    <div class="card-body text-center">
                      <h5 class="card-title">No More Products for <strong> <?php echo $categoryName; ?></strong></h5>
                      <p class="card-text">Sorry, there are no products available at the moment.</p>
                      <a href="index.php" class="btn btn-primary">Back to Home</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          <?php
          }

          ?>
        </div>
      </div>
    </div>
  </div>

  <!-- ======= footer ======= -->
  <?php
  include_once "Shared/footer.php"
  ?>
  <!-- End footer -->

  <script src="./../../assets/js/all.min.js"></script>
  <script src="./../../assets/js/bootstrap.bundle.min.js"> </script>
  <!-- <script src="js/main.js"> </script> -->
</body>


</html>