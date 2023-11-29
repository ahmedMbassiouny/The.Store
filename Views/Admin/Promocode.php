<?php
    require_once './Shared/Links.php';
    require_once './Shared/Header.php';
    require_once './Shared/Sidebar.php';
    require_once __DIR__ . "../../../Models/DBManager.php";
?>








<main id="main" class="main">

    <div class="pagetitle">
        <h1>Promocodes</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <?php 
        global $db;
        $db = DBManager::getInstance();
        $promos = $db->select("SELECT * FROM Promocode");
        function deletePromoCode($promoCode) {
            global $db;
            $db->delete("Promocode", $promoCode);
        }
        function CreatePromoCode($promoCode, float $discount){
            global $db;
            $promoCodeToCreate = array(
                "promocode" => $promoCode,
                "discount"  => $discount
            );
            $db->insert("Promocode", $promoCodeToCreate);   

        }
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        // Check for form submission for deletion
        if(isset($_POST["promoCode"])) {
            $promoCodeToDelete = $_POST['promoCode'];
            deletePromoCode($promoCodeToDelete);
            
            // Free up the $_POST array
            unset($_POST["promoCode"]);

            # refresh the page
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
        // Check for the Creation of promocode
        if(isset($_POST["promoCodeNew"]) && isset($_POST["promoCodeDiscount"])) {
            $codeToCreate = validate($_POST["promoCodeNew"]);
            $discountToCreate = validate($_POST["promoCodeDiscount"]);
            # if it exist once it would be true
            $isExist = $db->isUnique("Promocode", "promocode", $codeToCreate);
            if(!$isExist) {
                 # create 
                  CreatePromoCode($codeToCreate, $discountToCreate);
                  // Redirect to refresh the page
                header("Location: {$_SERVER['PHP_SELF']}");
                exit();

            } 
            else {    
                echo '<div class="alert alert-danger" role="alert">This promocode already exists' . '<span>  (' . $_POST["promoCodeNew"] . ')  try something new🤩</span>' . '</div>';

            }

            # free the POST 
            unset($_POST["promoCodeNew"], $_POST["promoCodeDiscount"]);

        }
        ?>
        <div class="row">
            <!-- Top Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">
                    <div class="card-body pb-0">

                        <h5 class="card-title">Promo Codes</span></h5>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Promocode</th>
                                    <th>State</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php if (!empty($promos)) { 
                                    foreach ($promos as $promo) : ?>
                                <tr>
                                    <td><span class="fw-bold"><?php echo $promo["promocode"]?></span></td>
                                    <td><?php echo $promo["discount"]?> %</td>
                                    <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="promoCode" value="<?php echo $promo["promocode"] ?>">
                                        <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                      
                                    </td>
                                </tr>
                                <?php endforeach; } 
                                else {
                                    echo '<h2 style="background-color: red; color: white; padding: 5px; border-radius: 5px;">No promocodes available</h2>';
                                }?>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Top Selling -->

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- <div class="col-lg-6 col-12">
                        <img src="./../assets/img/DISCOUNT_TACTICS_NEW_COLOURS_FOR_VANESSA.jpg" class="img-fluid" alt="">
                    </div> -->
                    <div class="col-lg-12">

                        <div class="card" style="background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)), url('./../../assets/img/img_ad/DISCOUNT_TACTICS_NEW_COLOURS_FOR_VANESSA.jpg'); background-size: cover; ">
                            <div class="card-body">
                                <h3 class="card-title" style="font-size: 60px;">Add a Promocode</h3>
                                <form class="row g-3"  method="post">
                                    <div class="col-12">
                                        <label for="cat_name" class="form-label" style="font-size: 40px;">Code</label>
                                        <input type="text" name = "promoCodeNew" class="form-control" id="cat_name" style="font-size: 50px;" minlength="6" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="promoCodeDiscount" class="form-label" >Discount percentage</label>
                                        <input type="range" min="1" max="100" value="1" name = "promoCodeDiscount" class="form-range"  id="discountRange">
                                        <center><span id="discountValue" style="font-size: 200px;">1</span><span style="font-size: 200px;">%</span><i class="fa-solid fa-tag fa-2xl" style="color: #cf3a50;"></i> </center>
                                        <script>
                                            var discountRange = document.getElementById("discountRange");
                                            var discountValueSpan = document.getElementById('discountValue');
                                            discountRange.addEventListener('input', function(){
                                                discountValueSpan.textContent = discountRange.value; 
                            
                                            });
                                        </script>

                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="col-12 btn btn-primary">Update</button>
                                    </div>
                                </form><!-- Vertical Form -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End Left side columns -->
        </div>
    </section>

</main><!-- End #main -->

















<script src="./../../assets/js/main.js"></script>


<?php

require_once './Shared/Footer.php';

?>