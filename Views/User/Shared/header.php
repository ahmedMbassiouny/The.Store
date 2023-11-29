<?php

require_once "../../Models/ProductManager.php";

$ProductMNG = new ProductManager();

$categories = $ProductMNG->viewCategories();

?>

<div class="my-header container-fluid ">
  <nav class="navbar navbar-expand-md navbar-light bg-light my-3 " style=" position: sticky; top: 0rem; z-index: 10;  box-shadow: 0 0 20px #00000063; border-radius:1em;transition:.6s">
    <div class="container-fluid ">
      <a class="navbar-brand ms-3 d-flex align-items-center fw-bold fs-3" style="color: #1190c2;" href="../../Views/User/index.php">The<span style="color: #bbb3b3; font-weight: bold">.Store</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-md-flex justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav myPages mr-auto pe-5 me-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link page-ele active " href="../../Views/User/index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link page-ele " href="../../Views/User/products.php">Products</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle page-ele" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
              foreach ($categories as $cat) {
              ?>
                <li>
              <a class="dropdown-item page-ele" href="selected-category.php?id=<?php echo $cat['categoryID'] ?> "><?php echo $cat['categoryName'] ?></a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
              <?php } ?>
            </ul>
          </li>
        </ul>
        <div class="d-md-flex ">
          <a href="../../Views/User/cart.php" class="ms-auto my-2 me-5 d-flex align-items-center text-black ">
            <i class="fa fa-shopping-cart text-black"></i>
            <p class="d-blok d-md-none m-0 ms-1  "> My cart</p>
          </a>
          <a href="../../Views/User/profile.php" class="ms-auto me-5 d-flex align-items-center text-black ">
            <!-- profile page icon -->
            <i class="fa fa-user text-black"></i>
            <p class="d-blok d-md-none m-0 ms-1  mt-1 "> My Profile</p>
          </a>
          <!-- one for logout -->
          <a href="../../Views/Authentication/login.php?logout" class="ms-auto me-5 d-flex align-items-center text-black ">
            <i class="fa fa-sign-out text-black"></i>
            <p class="d-blok d-md-none m-0 ms-1  mt-1 "> Logout</p>
          </a>
        </div>
      </div>
    </div>
  </nav>

</div>