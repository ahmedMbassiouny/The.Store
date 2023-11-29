`<?php
    require_once './Shared/Links.php';
    require_once './Shared/Header.php';
    require_once './Shared/Sidebar.php';
    require_once __DIR__ . "../../../Models/DBManager.php";
    ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Categories</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <?php
        global $db;
        $db = DBManager::getInstance();
        $cats = $db->select("SELECT * FROM Categories");

        // function to create new category
        function createNewCategory($catName, $imgURL) {  
            global $db;
            $catToCreate = array("CategoryName"=> $catName,"imgURL"=> $imgURL);
            $db->insert("Categories", $catToCreate);
        }
        // create newcategory
        if(isset($_POST["catName"]) && isset($_POST["catURL"])) {
            $catName = $_POST["catName"];
            $imgURL = $_POST["catURL"];
            # if it exist once it would be true
            $isExist = $db->isUnique("Categories", "categoryName", $catName);

            # check that it doesn't exist yet
            if(!$isExist) {
                # create 
                createNewCategory($catName, $imgURL);
                # Redirect to refresh the page
                header("Location: {$_SERVER['PHP_SELF']}");
                exit();
            }
            else {  
                echo '<div class="alert alert-danger" role="alert">This Category name already exists' . '<span>  (' . $_POST["catName"] . ')  try something new🤩</span>' . '</div>';
            }
        }

        ?>
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-lg-6 col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Categories</span></h5>

                                <table class="table table-border text-center">
                                    <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th>Preview</th>
                                            <th>Category Name</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($cats as $cat) : ?>
                                        <tbody>
                                            <tr>
                                                <td><span><?php echo $cat['categoryID']; ?></span></td>
                                                <th><span><img width ="70" height="70" src="<?php echo $cat['imgURL']; ?>" alt=""></span></th>
                                                <td class="text-center"><span class=" text-center fw-bold"><?php echo $cat['categoryName'] ?></span></td>
                                            </tr>

                                        </tbody>
                                    <?php endforeach; ?>
                                </table>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add a new category</h5>
                                <form class="row g-3" method="post">
                                    <div class="col-12">
                                        <label for="cat_name" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="cat_name" name="catName">
                                    </div>
                                    <div class="col-12">
                                        <label for="img_url" class="form-label">Image Url</label>
                                        <input type="url" class="form-control" id="img_url"  name="catURL">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="col-12 btn btn-warning">Add</button>
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