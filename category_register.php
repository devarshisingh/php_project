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
                                                    <div class="card-header">
                                                        <h4 class="sub-title">Category Head Registration</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Category Head
                                                                    Name</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-control" name="c_h_names"
                                                                        required>
                                                                        <option value="">Select a Category Head</option>
                                                                        <?php
                                                                        $categories = mysqli_query($con, "SELECT * FROM category_head");
                                                                        while ($ch = mysqli_fetch_array($categories)) {
                                                                            ?>
                                                                            <option value="<?php echo $ch['id'] ?>">
                                                                                <?php echo htmlspecialchars($ch['c_h_name']); ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Category
                                                                    Image</label>
                                                                <div class="col-sm-10">
                                                                    <input type="file" name="file" id="fileInput"
                                                                        class="form-control" accept="image/*" >
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Category
                                                                    Name</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="c_name"
                                                                        class="form-control"
                                                                        placeholder="Type your Category Name" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-sm-10 offset-sm-2">
                                                                    <button type="submit" class="btn btn-info"
                                                                        name="addcategory">Register</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
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