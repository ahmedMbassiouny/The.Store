<?php
session_start();
require_once "Shared/top_code.php";
require_once "../../Models/cartManager.php";
require_once "../../Models/checkoutManager.php";


$_SESSION["checkSucsessMsg"] = "";

$product = new cartManager();

$num_of_out_stock_count = 0;

$products = $product->viewProducts($_SESSION["userId"]);

// if no product in cart go to index.php
if (!$products) {
  header("location:index.php");
}


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

if (isset($_GET["promodiscount"])) {
  $promo_discount = $_GET["promodiscount"];
} else {
  $promo_discount = 0;
}




$shop_discount = 0;

if ($total_price >= 200 and $num_of_out_stock_count >= 5) {
  $shop_discount_precentage = 20 / 100;
  $shop_discount = $shop_discount_precentage * $total_price;
} else if ($total_price >= 200 and $num_of_out_stock_count < 5) {
  $shop_discount_precentage = 10 / 100;
  $shop_discount = $shop_discount_precentage * $total_price;
} else {
  $shop_discount_precentage = 5 / 100;
  $shop_discount = $shop_discount_precentage * $total_price;
}

$checkout = new checkoutManager();
// l1= address1,l2= address2
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST["l1"]) and $_POST["l2"] and $_POST["l3"] and $_POST["l4"]) {
    $total_price = round($total_price - $promo_discount - $shop_discount, 2);
    $checkout_id = $checkout->makeOrder($_SESSION["userId"], $total_price, $_POST["l1"], $_POST["l2"], $_POST["l3"], $_POST["l4"]);

    if ($checkout_id) {
      foreach ($products as $prod) {
        $prod_sales = $prod["pronumSales"] + $prod["proQuantity"];

        $checkout->makeOrderDetails($checkout_id, $prod["prod_id"], $prod["proQuantity"], $prod["proQuantity"] * $prod["prodPrice"], $prod_sales, $prod["stockQ"]);
      }
      $checkout->deleteCart($_SESSION["userId"]);
      $_SESSION["checkSucsessMsg"] = "Checkout successfully, Thanks....!:)";
      header("location:index.php");
    }
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
    <section class="container mt-5">
      <div class="row">
        <div class="col-md-8 mb-4">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Biling details</h5>
            </div>


            <div class="card-body">






              <form action="" method="post">

                <!-- Text input -->
                <div class="form-outline mb-4">
                  <input name="l1" type="text" id="form6Example4" class="form-control" required>
                  <label class="form-label" for="form6Example4">Address 1</label>
                </div>

                <!-- Text input -->
                <div class="form-outline mb-4">
                  <input name="l2" type="text" id="form6Example4" class="form-control" />
                  <label class="form-label" for="form6Example4">Address 2</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input name="l3" type="email" id="form6Example5" class="form-control" />
                  <label class="form-label" for="form6Example5">Additional Email</label>
                </div>

                <!-- Number input -->
                <div class="form-outline mb-4">
                  <input name="l4" type="number" id="form6Example6" class="form-control" />
                  <label class="form-label" for="form6Example6"> Additional Phone</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                  checkout
                </button>
                <!-- <a href="checkout.html" class="btn btn-primary btn-lg btn-block">checkout</a> -->
              </form>
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
                  <span><?php echo $num_of_out_stock_count ?></span>
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