<?php
session_start();
include('config/dbcons.php');
include('includes/headers.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');

if (!isset($_SESSION['user_id'])) {
    echo '<script type="text/javascript">
            window.location.href = "admin_login.php";
          </script>';
    exit;
}
?>
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">

                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page body start -->
                                <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form action="codes.php" method="POST" enctype="multipart/form-data">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <h4 class="sub-title">Category Registration</h4>
                                                        
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Category Image</label>
                                                            <div class="col-sm-10">
                                                                <input type="file" name="file" id="fileInput" class="form-control" accept="image/*" placeholder="Category Image">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Category Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="c_h_name" class="form-control" placeholder="Type your Category Name">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-info" data-container="body" data-toggle="popover" title="Info color states" name="addcategory_head" data-placement="bottom" data-content="">Register</button>
                                                    
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/footer.php');
    ?>
