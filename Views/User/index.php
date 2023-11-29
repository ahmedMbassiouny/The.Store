<?php
session_start();
require_once "Shared/top_code.php";
require_once "./../../Models/ProductManager.php";

$ProductMNG = new ProductManager();

$best_Products = $ProductMNG->viewProducts('numSales', 'ASC', 10);
$categories = $ProductMNG->viewCategories();

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
    <div id="page-container" class="">


      <?php
      if ($_SESSION["checkSucsessMsg"] != "") {
      ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle me-1"></i>
          <?php echo $_SESSION["checkSucsessMsg"]; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php
      }
      $_SESSION["checkSucsessMsg"] = "";
      ?>

      <div id="carouselExampleControls" class="carousel slide rounded my-4 mx-3" data-bs-ride="carousel">
        <div class="carousel-inner rounded-4">
          <div class="carousel-item active">
            <a href="selected-category.php?id=1">
              <img src="./../../assets/img/img_us/1.png" class="d-block w-100" alt=" ...">
            </a>
          </div>
          <div class="carousel-item">
            <a href="selected-category.php?id=4">
              <img src="./../../assets/img/img_us/4.png" class="d-block w-100" alt=" ...">
            </a>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <div class="category-card container-fluid pb-4 ">
        <div class="cards row">
          <?php
          foreach ($categories as $category) {
          ?>
            <div class="p-0 p-3 col-6 col-lg-3">
              <div class="card rounded-3 overflow-hidden ">

                <div class="cate-img">
                  <a href="selected-category.php?id=<?php echo $category['categoryID']; ?>">
                    <img src="<?php echo $category['imgURL'] ?>" alt="...">
                  </a>
                </div>
                <div class="card-text">
                  <a href="selected-category.php?id=<?php echo $category['categoryID']; ?>">
                    <h5 class="card-title fw-bold "><?php echo $category['categoryName'] ?></h5>
                  </a>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>

      <div class="container">
        <div class="bestCards row mt-5">
          <div class="sp-title">
            <h3>Best Selling </h3>
          </div>
          <div id="BestCards-box" class="newCards-box row">
            <?php
            foreach ($best_Products as $product) {
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
            ?>
          </div>
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