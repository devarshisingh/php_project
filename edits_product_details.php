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
                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $register_query = "SELECT * FROM p_details WHERE id='$id'";
                                    $register_query_run = mysqli_query($con, $register_query);

                                    if (mysqli_num_rows($register_query_run) > 0) {
                                        $row = mysqli_fetch_assoc($register_query_run);
                                ?>
                                <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form action="codes.php" method="POST" enctype="multipart/form-data">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <h4 class="sub-title">Product Details Registration</h4>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Id</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_name"
                                                                    value="<?php echo htmlspecialchars($row['p_name']); ?>"
                                                                    class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">category ID</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="cats_name"
                                                                    value="<?php echo htmlspecialchars($row['cats_name']); ?>"
                                                                    class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id"
                                                            value="<?php echo htmlspecialchars($row['id']); ?>">

                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Image</label>
                                                            <div class="col-sm-10">
                                                                <input type="hidden" name="files">
                                                                <input type="file" name="files" class="form-control">
                                                                <input type="hidden" name="files_old"
                                                                    value="<?php echo htmlspecialchars($row['pd_image']); ?>">
                                                                <img src="<?php echo htmlspecialchars($row['pd_image']); ?>"
                                                                    width="100px" height="100px" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="pdname"
                                                                    value="<?php echo htmlspecialchars($row['pdname']); ?>"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Color</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_color" class="form-control"
                                                                    value="<?php echo htmlspecialchars($row['p_color']); ?>"
                                                                    placeholder="Type your Product Color">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Price</label>
                                                            <div class="col-sm-10">
                                                                <input type="text"  id="offPrice" name="p_price"
                                                                    class="form-control"
                                                                    value="<?php echo htmlspecialchars($row['p_price']); ?>"
                                                                    placeholder="Type your Product price" readonly >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Off Price</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" id="originalPrice" name="p_off_price"
                                                                    value="<?php echo htmlspecialchars($row['p_off_price']); ?>"
                                                                    class="form-control"
                                                                    placeholder="Type your Product off price"  oninput="calculateDiscount()">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Discount Percentage (%)</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" id="discountPercentage" name="p_p_discount"
                                                                    value="<?php echo htmlspecialchars($row['p_p_discount']); ?>"
                                                                    class="form-control"
                                                                    placeholder="Type your Percentage discount" oninput="calculateDiscount()">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Size</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_size"
                                                                    value="<?php echo htmlspecialchars($row['p_size']); ?>"
                                                                    class="form-control" placeholder="Type your Category Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Delivery</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_delivery"
                                                                    value="<?php echo htmlspecialchars($row['p_delivery']); ?>"
                                                                    class="form-control" placeholder="Type your Product delivery">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Deal</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_deal"
                                                                    value="<?php echo htmlspecialchars($row['p_deal']); ?>"
                                                                    class="form-control" placeholder="Type your Product Deal">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-info" name="update_product_details">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    } else {
                                        echo "<script>alert('Invalid ID'); window.location.href='view_category.php';</script>";
                                    }
                                } else {
                                    echo "<script>alert('No ID provided'); window.location.href='view_category.php';</script>";
                                }
                                ?>
                                <!-- Page body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    function calculateDiscount() {
        const originalPrice = parseFloat(document.getElementById('originalPrice').value);
        const discountPercentage = parseFloat(document.getElementById('discountPercentage').value);
        
        if (!isNaN(originalPrice) && !isNaN(discountPercentage) && discountPercentage >= 0) {
            const discountAmount = Math.round((originalPrice * discountPercentage) / 100);
            const offPrice = Math.round(originalPrice - discountAmount);

            // Update the off price input field
            document.getElementById('offPrice').value = offPrice; // Show as a whole number
        } else {
            document.getElementById('offPrice').value = ''; // Clear the field if input is invalid
        }
    }
    </script>

    <?php
    include('includes/footer.php');
    ?>
