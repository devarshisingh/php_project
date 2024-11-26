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
                                                        <h4 class="sub-title">Product Details Registeration</h4>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product
                                                                Details</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control" name="p_name" id="p_name"
                                                                    onchange="updateCategory()">
                                                                    <option value="">Select Product</option>
                                                                    <?php
                                                                    // Fetch products with their corresponding categories
                                                                    $categories = mysqli_query($con, "SELECT id, p_name, cat_name FROM c_product");
                                                                    $products = [];
                                                                    while ($c = mysqli_fetch_array($categories)) {
                                                                        $products[$c['id']] = $c['cat_name']; // Store category name by product ID
                                                                        ?>
                                                                        <option value="<?php echo $c['id']; ?>"
                                                                            data-category="<?php echo $c['cat_name']; ?>">
                                                                            <?php echo $c['p_name']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Category Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="cats_name" id="cats_name"
                                                                    class="form-control" placeholder="Category Name"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product
                                                                Image</label>
                                                            <div class="col-sm-10">
                                                                <input type="file" name="files" id="fileInput"
                                                                    class="form-control" accept="pd_image/*"
                                                                    placeholder="Category Image">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="pdname" class="form-control"
                                                                    placeholder="Type your Product Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Color
                                                            </label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_color" class="form-control"
                                                                    placeholder="Type your Product Color">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Price</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_price" id="offPrice"
                                                                    class="form-control"
                                                                    placeholder="Type your Product Price"
                                                                    placeholder="Calculated Off Price" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Off
                                                                Price</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_off_price" id="originalPrice"
                                                                    class="form-control" oninput="calculateDiscount()">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Discount Percentage
                                                                (%)</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_p_discount"
                                                                    id="discountPercentage" class="form-control"
                                                                    placeholder="Type your Discount Percentage"
                                                                    oninput="calculateDiscount()">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product size</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_size" class="form-control"
                                                                    placeholder="Type your Product Size">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product
                                                                delivery</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_delivery"
                                                                    class="form-control"
                                                                    placeholder="Type your Product delivery">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Product Deal</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="p_deal" class="form-control"
                                                                    placeholder="Type your Product Deal">
                                                            </div>
                                                        </div>



                                                        <button type="submit" class="btn btn-info" data-container="body"
                                                            data-toggle="popover" title="Info color states"
                                                            name="addproduct_details" data-placement="bottom"
                                                            data-content="">Register</button>

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

        function updateCategory() {
            var productSelect = document.getElementById("p_name");
            var selectedOption = productSelect.options[productSelect.selectedIndex];
            var categoryInput = document.getElementById("cats_name");

            // Update category input based on selected product
            if (selectedOption.value) {
                categoryInput.value = selectedOption.getAttribute("data-category");
            } else {
                categoryInput.value = ""; // Clear if no product is selected
            }
        }
    </script>




    <?php
    include('includes/footer.php');
    ?>