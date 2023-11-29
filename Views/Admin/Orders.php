<?php
    require_once './Shared/Links.php';
    require_once './Shared/Header.php';
    require_once './Shared/Sidebar.php';
    require_once __DIR__ . "../../../Models/DBManager.php";

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Orders Details</h1>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Primary Color Bordered Table -->
                    <table class="table table-bordered border-colored shadow text-center">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer ID</th>
                                <th>Total Amount</th>
                                <th>Address</th>
                                <th>Address 2</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = DBManager::getInstance();
                            $Orders_details = $db->select("SELECT * FROM Orders");

                            if ($Orders_details) {
                                foreach ($Orders_details as $data) {
                                    echo '<tr>';
                                    echo '<th>' . $data['orderID'] . '</th>';
                                    echo '<th>' . $data['userID'] . '</th>';
                                    echo '<th>' . $data['totalAmount'] .'$'. '</th>';
                                    echo '<th>' . $data['address1'] . '</th>';
                                    echo '<th>' . $data['address2'] . '</th>';
                                    echo '<th>' . $data['additionalPhone'] . '</th>';
                                    echo '<th>' . $data['additionalEmail'] . '</th>';
                                    echo '<th>' . $data['orderDate'] . '</th>';
                                    echo '</tr>';
                                }
                            } else {
                                
                                echo '<tr><td colspan="8" class="alert alert-info" >No orders found</td></tr>';
                            }
                            ?>
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
