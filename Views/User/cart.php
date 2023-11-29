<?php
session_start();
require_once "Shared/top_code.php";
require_once "../../Models/cartManager.php";

$product = new cartManager();
$products = $product->viewProducts($_SESSION["userId"]);
$num_of_out_stock_count = 0;
$total_price = 0;
$promo_discount = 0;
$shop_discount = 0;

if ($products) {


  $num_of_out_stock_count = 0;


  foreach ($products as $prod) {
    if ($prod["stockQ"] > 0) {
      $num_of_out_stock_count += 1;
    }
  }


  $total_price = 0;
  for ($i = 0; $i < count($products); $i++) {
    if ($products[$i]["stockQ"] == 0) {
      continue;
    } else {
      $total_price += $products[$i]["proQuantity"] * $products[$i]["prodPrice"];
    }
  }



  $promo_discount = 0;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["promocode"])) {

      $promocode = $product->promoCode($_POST["promocode"]);


      if ($promocode and $total_price >= 200) {
        $promo_discount_precentage = $promocode[0]["discount"] / 100;

        $promo_discount = $total_price * $promo_discount_precentage;
      } else {
        $promo_discount = 0;
      }
    }
  }



  $shop_discount = 0;

  if ($total_price >= 200 and $num_of_out_stock_count > 5) {
    $shop_discount_precentage = 20 / 100;
    $shop_discount = $shop_discount_precentage * $total_price;
  } else if ($total_price >= 200 and $num_of_out_stock_count < 5) {
    $shop_discount_precentage = 10 / 100;
    $shop_discount = $shop_discount_precentage * $total_price;
  } else {
    $shop_discount_precentage = 5 / 100;
    $shop_discount = $shop_discount_precentage * $total_price;
  }
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST["product_deleted_id"])) {
    $product->deleteFromCart($_SESSION["userId"], $_POST["product_deleted_id"]);
    $products = $product->viewProducts($_SESSION["userId"]);
  }
}


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
    <section class="h-100 gradient-custom">
      <div class="container py-5">
        <div class="row d-flex justify-content-center my-4">
          <div class="col-md-8">
            <div class="card mb-4">
              <div class="card-header py-3">
                <h5 class="mb-0">Cart - <?php echo $num_of_out_stock_count ?> items</h5>
              </div>
              <div class="card-body">
                <!-- Single item -->


                <div class="row">

                  <?php
                  if ($products) {
                    foreach ($products as $prod) {
                  ?>
                      <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                        <!-- Image -->
                        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                          <img src=<?php echo $prod["img"] ?> class="w-100 alt=" Blue Jeans Jacket />
                        </div>
                        <!-- Image -->
                      </div>

                      <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                        <!-- Data -->
                        <p><strong><?php echo $prod["prod_name"] ?></strong></p>
                        <p>Delivery - next day</p>
                        <?php
                        if ($prod["stockQ"] > 0) {

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
                        <form action="" method="post">
                          <input type="hidden" name="product_deleted_id" value=<?php echo $prod["prod_id"]; ?>>
                          <button name="deleted" type="submit" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                            <i class="fas fa-trash"></i>
                          </button>
                        </form>

                        <!-- Data -->
                      </div>
                      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 d-flex flex-column justify-content-center align-items-center ">
                        <?php
                        if ($prod["stockQ"] > 0) {
                        ?>

                          <!-- Quantity -->


                          <div class="form-outline">
                            <!--  -->
                            <h6 class="text-center"><?php echo $prod["proQuantity"] ?></h6>
                            <label class="form-label" for="form1">Quantity</label>
                          </div>

                          <!-- Quantity -->
                        <?php
                        }
                        ?>
                        <!-- Price -->
                        <p class="text-start text-md-center">

                          <strong> amount: <?php echo $prod["prodPrice"] ?></strong>
                        </p>
                        <!-- Price -->
                      </div>





                      <hr class="my-4" />

                    <?php
                    }
                  } else {
                    ?>
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
                <!-- Single item -->



              </div>
            </div>
            <form action="" method="post">
              <div class="card mb-4 mb-lg-0">
                <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-md-6">

                      <label for="promoCode" class="form-label">Enter Promo Code</label>
                      <div class="input-group">
                        <input name="promocode" type="text" class="form-control" id="promoCode" placeholder="Enter your promo code">
                        <?php
                        if ($products) {
                        ?>
                          <button class="btn btn-primary" type="submit" id="applyPromoCode">Apply</button>
                        <?php
                        }
                        ?>

                      </div>
            </form>

          </div>
        </div>
        <hr>
        <p><strong>We accept</strong></p>
        <img width="50px" height="30px" src="./../../assets/img/img_us/Visa.webp" alt="">

        <img width="50px" height="30px" src="./../../assets/img/img_us/brand-mastercard_3x.webp" alt="">

        <img width="50px" height="30px" src="./../../assets/img/img_us/PayPal.webp" alt="">
            </div>
  </div>
  </div>
  <div class="col-md-4">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Summary</h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Products
            <span><?php echo $num_of_out_stock_count; ?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Total Price
            <span><?php echo $total_price; ?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Promo Code Discount
            <span> -$ <?php echo $promo_discount; ?> </span>

          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Shop Discount
            <span>- $ <?php echo $shop_discount; ?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            Shipping
            <span>Free</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
            <div>
              <strong>Total amount</strong>
              <strong>
                <p class="mb-0">(including VAT)</p>
              </strong>
            </div>
            <span><strong><?php echo round($total_price - $promo_discount - $shop_discount, 2) ?></strong></span>
          </li>
        </ul>

        <!-- <button type="button" class="btn btn-primary btn-lg btn-block">
                  Go to checkout
                </button> -->
        <?php

        if ($products) {
        ?>
          <a href="checkout.php?promodiscount=<?php echo $promo_discount; ?>&cartID=<?php echo $products[0]["cid"]; ?>" class="btn btn-primary btn-lg btn-block">Go to checkout</a>
        <?php
        }

        ?>

      </div>
    </div>
  </div>
  </div>
  </div>
  </section>
  </div>

  <!-- ======= footer ======= -->
  <?php
  include_once "Shared/footer.php"
  ?>
  <!-- End footer -->

  <script src="./../../assets/js/all.min.js"></script>
  <script src="./../../assets/js/bootstrap.bundle.min.js"> </script>
</body>

</html>