<?php

// requires
require_once   "./../../Models/user.php";
require_once  "./../../Models/AuthManager.php";


// make object
$auth = new AuthManager;
$user = new user;


// global variable
$errMsg = "";
$adduser = false;



// coding
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    if ($auth->check_email($_POST["email"])) {
      $user->set_name($_POST["name"]);
      $user->set_email($_POST["email"]);
      $user->set_phone($_POST["phone"]);
      $user->set_password($_POST["password"]);

      $auth = new AuthManager;
      if ($auth->register($user)) {
        $adduser = true;
    header("Location: ../Authentication/login.php");
      } else {
        $errMsg = "Somthing went wrong... try again later";
      }
    } else {
      $errMsg = "Please enter another EMAIL";
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
  <title>Register User</title>

</head>

<body style="background:#f6f9ff ;">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4 logo d-flex align-items-center w-auto text-black">
                <a class="ms-3 d-flex align-items-center fw-bold fs-3" style="color: #1190c2; scale:1.5; " href="#">The<span style="color: #bbb3b3; font-weight: bold">.Store</span></a>
              </div>
              <!-- End Logo -->

              <div class="card mb-3 rounded-4 border-0 shadow-lg  bg-light">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-2 fw-bolder ">Create an Account</h5>
                    <p class="text-center small text-black-50">Enter your personal details to create account</p>
                  </div>

                  <?php
                  if ($errMsg != "") {
                  ?>
                    <div class="alert alert-danger" role="alert"><?php echo $errMsg ?></div>
                  <?php
                  }
                  ?>

                  <form class="row g-3 needs-validation" action="register.php" method="POST" novalidate>

                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control bg-light" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPhone" class="form-label">Your Phone</label>
                      <input type="tel" name="phone" class="form-control bg-light" id="yourphone" required>
                      <div class="invalid-feedback">Please, enter your phone!</div>
                    </div>

                    <div class="col-12">
                      <label for="Email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend" style="background: #bbecff;">@</span>
                        <input type="email" name="email" class="form-control bg-light" id="Email" required>
                        <div class="invalid-feedback">Please choose a Email.</div>
                      </div>

                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control bg-light" id="yourPassword" minlength="10" required>
                      <div class="invalid-feedback">Please enter your password! and must be at least 10 characters</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the terms and conditions</label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">Already have an account ? <a class="fs-6" href="login.php" style="color: #1190c2;"> Sign In</a>
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
  <!-- End #main -->

  <script src="./../../assets/js/all.min.js"></script>
  <script src="./../../assets/js/bootstrap.bundle.min.js"> </script>


</body>

</html>