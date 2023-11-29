<?php
session_start();
require_once "Shared/top_code.php";
require_once "./../../Models/AuthManager.php";
require_once "./../../Models/ProductManager.php";

$ProductMNG = new ProductManager();
$AuthMNG = new AuthManager();

$User = $AuthMNG->viewUserInfo($_SESSION["userId"])[0];
$all_orders = $ProductMNG->viewUserOrders($_SESSION["userId"]);
$orderNum = 1;
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
    <div class="container mt-5">
      <div class="row justify-content-between">
        <div class="col-12 my-3">
          <!-- User Information -->
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">User Information</h4>
              <p class="card-text"><strong>Username</strong>: <?php echo $User['username']; ?></p>
              <p class="card-text"><strong>Email</strong>: <?php echo $User['email']; ?></p>
              <p class="card-text"><strong>Phone</strong>: <?php echo $User['phone']; ?></p>
              <!-- Add more user information here -->
            </div>
          </div>
        </div>
        <div class="col-12 my-3">
          <!-- Last Orders Table -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Last Orders</h5>
              <table class="table">
                <?php
                if ($all_orders) {
                ?>
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Order Code</th>
                    <th>Order Date</th>
                    <th>Total Amount</th>
                  </tr>
                </thead>
                <?php 
                }
                ?>
                <tbody>
                  <?php
                  if ($all_orders) {
                  foreach ($all_orders as $order) {
                  ?>
                    <tr>
                      <td><?php echo $orderNum++; ?></td>
                      <td><?php echo $order['orderID']; ?></td>
                      <td><?php echo $order['orderDate']; ?></td>
                      <td>$<?php echo $order['totalAmount']; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                    <?php
                  } else {
                    ?>
                    <!-- no product -->
                    <div class="container my-5">
                      <div class="row justify-content-center">
                        <div class="col-md-6 ">
                          <div class="card ">
                            <div class="card-body text-center">
                              <h5 class="card-title">No Orders Yet</h5>
                              <a href="index.php" class="btn btn-primary">Back to Home</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  }

                  ?>
                </tbody>
              </table>
            </div>
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