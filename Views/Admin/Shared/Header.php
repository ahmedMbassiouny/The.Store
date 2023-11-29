
    <?php
      if (session_status() == PHP_SESSION_NONE) {
        // Start the session
        session_start();
    }
      if (!isset($_SESSION["userId"])) {
        header("location:../Authentication/login.php ");
      } else {
        if ($_SESSION["userRole"] != "admin") {
          header("location:../Authentication/login.php ");
        }
      }
    
    
    
    
    
    
    
    ?>
  
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <span class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">The.Store</span>
      </span>
      <i class="fa-solid fa-bars toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">


        <li class="nav-item dropdown pe-3">

          <span class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="./../../assets/img/img_ad/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span style="color: #00adb5;" class="d-none d-md-block  ps-2">Admin Name</span>
          </span>
        </li>
      </ul>
    </nav>
    <!-- End Icons Navigation -->

  </header>
  <!-- End Header -->