<?php
session_start();
require_once "Shared/top_code.php";
require_once "./../../Models/ProductManager.php";

$ProductMNG = new ProductManager();

// Default values for sorting
$sortOption = $sortOption ?? 'name';
$sortType = 'productName';
$sortOrder = 'ASC';

// Check if sorting parameters are provided in the URL
if (isset($_GET['sortSelect'])) {
  $sortOption = $_GET['sortSelect'];

  // Map the sort options to corresponding sorting parameters
  switch ($sortOption) {
    case 'name':
      $sortType = 'productName';
      break;
    case 'price-asc':
      $sortType = 'price';
      $sortOrder = 'ASC';
      break;
    case 'price-desc':
      $sortType = 'price';
      $sortOrder = 'DESC';
      break;
    case 'sales':
      $sortType = 'numSales';
      $sortOrder = 'ASC';
      break;
    default:
      $sortType = 'productName';
      break;
  }
}

$all_Products = $ProductMNG->viewProducts($sortType, $sortOrder);

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
      <div class="allCards row mt-5">
        <div class="row mb-3">
          <div class="col-md-6">
            <form action="" method="get">
              <label for="sortSelect" class="form-label">Sort By:</label>
              <select class="form-select" name="sortSelect" id="sortSelect">
                <option value="name" <?php echo ($sortOption === 'name') ? 'selected' : ''; ?>>Name</option>
                <option value="price-asc" <?php echo ($sortOption === 'price-asc') ? 'selected' : ''; ?>>Cheapest : Lowest Price</option>
                <option value="price-desc" <?php echo ($sortOption === 'price-desc') ? 'selected' : ''; ?>>Expensive : Highest Price</option>
                <option value="sales" <?php echo ($sortOption === 'sales') ? 'selected' : ''; ?>>Best Selling</option>
              </select>
              <button type="submit" class="btn btn-primary mt-3">Sort</button>
            </form>
          </div>
        </div>
        <div class="sp-title">
          <h3>Our Products</h3>
        </div>
        <div id="allCards-box" class="newCards-box row">
          <?php
          foreach ($all_Products as $product) {
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