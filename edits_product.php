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
                                    <?php
       
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $register_query = "SELECT * FROM c_product WHERE id='$id'";
            $register_query_run = mysqli_query($con, $register_query);
        
            if (mysqli_num_rows($register_query_run) > 0) {
                $row = mysqli_fetch_assoc($register_query_run); 
        ?>
        
                                        <div class="col-sm-12">
                                            <!-- Basic Form Inputs card start -->
                                            <div class="card">

                                                <div class="card-block">
                                                    <h4 class="sub-title">Edit Product Details</h4>

                                                    <form action="codes.php" method="POST"
                                                        enctype="multipart/form-data">
                                                        <input type="hidden" name="id"
                                                            value="<?php echo htmlspecialchars($row['id']); ?>">
                                                            
                                                        <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Product Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="p_name" value="<?php echo htmlspecialchars($row['p_name']); ?>"
                                                                    placeholder="Type your Category New Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Article Number</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="article_number" value="<?php echo htmlspecialchars($row['article_number']); ?>"
                                                                    placeholder="Type your Category New Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Product Size</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="p_size" value="<?php echo htmlspecialchars($row['p_size']); ?>"
                                                                    placeholder="Type your Category New Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Image</label>
                                                            <div class="col-sm-10">
                                                                <input type="hidden" name="file"><br>
                                                                <input type="file" name="file_old"
                                                                    value="<?php echo htmlspecialchars($row["p_image"]); ?>">
                                                                <img src="<?php echo htmlspecialchars($row['p_image']); ?>"
                                                                    width="100px" height="100px" alt="">
                                                            </div>
                                                        </div>
                                                       
                                                        <button type="submit" class="btn btn-info" data-container="body"
                                                            name="update_product" data-toggle="popover"
                                                            title="Info color states" data-placement="bottom"
                                                            data-content="">Update</button>
                                                    </form>
                                                    <?php
            } else {
                echo "<script>alert('Invalid ID'); window.location.href='view_category.php';</script>";
            }
        } else {
            echo "<script>alert('No ID provided'); window.location.href='view_category.php';</script>";
        }
        ?>
                                                </div>

                                            </div>
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