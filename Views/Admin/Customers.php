<?php
    require_once './Shared/Links.php';
    require_once './Shared/Header.php';
    require_once './Shared/Sidebar.php';
    require_once __DIR__ . "../../../Models/DBManager.php";

?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Customers</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Primary Color Bordered Table -->
                    <table class="text-center table table-bordered border-colored shadow">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Joining Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $db = DBManager::getInstance();
                            # retreving customers data 
                            $custs = $db->select("Select userID, username, email, phone, DateOfCreation From Users where role = 'customer'");
                            ?>
                            <?php foreach ($custs as $cust) : ?>
                            <tr>
                                <th><?php echo $cust['userID']; ?></th>
                                <td><?php echo $cust['username']; ?></td>
                                <td><?php echo $cust['phone']; ?></td>
                                <td><?php echo $cust['email']; ?></td>
                                <td><?php echo $cust['DateOfCreation']; ?></td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
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