<?php
session_start();
require_once "Shared/top_code.php";
require_once "./../../Models/ProductManager.php";

$ProductMNG = new ProductManager();

$Categy_Products = $ProductMNG->viewCategyProducts($_GET['id']);
$categoryName = $ProductMNG->viewCategyInfo($_GET['id'])[0]['categoryName'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once 'Shared/head-code.php' ?>
</head>


<body>
  <!-- ======= header ======= -->
  <?php
  include_once "Shared/header.php"
  ?>
  <!-- End header -->

  <div class="page-container container-fluid ">
    <div class="container">
      <div class="categoryCards row mt-5">
        <div class="sp-title">
          <h3>Our <?php echo $categoryName ?> Collection</h3>
        </div>
        <div id="categoryCards-box" class="categoryCards-box row">
          <?php
          if ($Categy_Products) {
            foreach ($Categy_Products as $product) {
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
          } else {
            ?>
            <!-- no product -->
            <div class="container my-5">
              <div class="row justify-content-center">
                <div class="col-md-6 ">
                  <div class="card ">
                    <div class="card-body text-center">
                      <h5 class="card-title">No Products Found</h5>
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