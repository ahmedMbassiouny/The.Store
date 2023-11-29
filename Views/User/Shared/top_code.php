<?php
// $_SESSION["userId"] = 4;
// $_SESSION["roleId"] = 1;

  //dont enter untill login
  if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}
  if (!isset($_SESSION["userId"])) {
    header("location:../Authentication/login.php ");
  } else {
    if ($_SESSION["userRole"] != "customer") {
      header("location:../Authentication/login.php ");
    }
  }
?>