<?php

// requires

require_once "./../../Models/user.php";
require_once "./../../Models/AuthManager.php";
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION["userId"]) && isset($_SESSION["userRole"])) {
  if ($_SESSION["userRole"] == "customer") {
    header("location: ./../User/index.php");
  } else if ($_SESSION["userRole"] == "admin") {
    header("location: ./../Admin/Dashboard.php");
  }
}
// logOut
if (isset($_GET["logout"])) {
  if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}

  session_unset();
  $_SESSION = array();
  session_destroy();
}


// make object
$auth = new AuthManager;
$user = new user;


// global variable
$errMsg = "";


// coding
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    // $user->set_name($_POST["name"]);
    $user->set_email($_POST["email"]);
    $user->set_password($_POST["password"]);

    $auth = new AuthManager;
    if ($auth->login($user)) {
      if (!isset($_SESSION["userId"])) {
        session_start();
      }
      if ($_SESSION["userRole"] == "admin") {
        header("location: ./../Admin/Dashboard.php");
      } else if ($_SESSION["userRole"] == "customer") {
        header("location: ./../User/index.php");
      }
    } else {
      $errMsg = "You have entered wrong email or password";
    }
  } else {
    $errMsg = "Please fill all fields";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- ======= head-code ======= -->
  <?php
  include_once "Shared/head-code.php"
  ?>
  <!-- head-code -->
  <title>Login</title>
</head>

<body style="background:#f6f9ff ;">

  <main>
    <div class="container text-black">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center ">

              <div class="d-flex justify-content-center py-4 logo d-flex align-items-center w-auto text-black">
                <a class="ms-3 d-flex align-items-center fw-bold fs-3" style="color: #1190c2; scale:1.5; " href="#">The<span style="color: #bbb3b3; font-weight: bold">.Store</span></a>
              </div>
              <!-- End Logo -->

              <div class="card mb-3 rounded-4 border-0 shadow-lg bg-light">

                <div class="card-body ">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-2 fw-bolder ">Login to Your Account</h5>
                    <p class="text-center small text-black-50">Enter your username & password to Sign In</p>
                  </div>

                  <?php
                  if ($errMsg != "") {
                  ?>
                    <div class="alert alert-danger" role="alert"><?php echo $errMsg ?></div>
                  <?php
                  }
                  ?>

                  <form method="post" action="login.php" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend" style="background:#bbecff ;">@</span>
                        <input type="email" name="email" class="form-control bg-light" id="Email" required>
                        <div class="invalid-feedback">Please enter your Email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control bg-light" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password! and must be at least 10 characters</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100 mt-2" style="background: #1190c2;" type="submit">Sign In</button>
                    </div>

                    <div class="col-12 ">
                      <p class="  mb-0">Don't have account ?
                        <a class="fs-6" href="register.php" style="color: #1190c2;">Sign Up</a>
                      </p>
                    </div>

                  </form>

                </div>
              </div>

              <div class="credits d-flex align-items-center justify-content-center">
                Designed by <span class=" fw-bold fs-5" style="color: #1190c2;" href="#">The<span style="color: #bbb3b3; font-weight: bold">.Store</span></span>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>


  <script src="./../../assets/js/all.min.js"></script>
  <script src="./../../assets/js/bootstrap.bundle.min.js"> </script>

</body>

</html>