<?php
session_start();
include('config/dbcons.php');
include('includes/headers.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
?>


 
    <!-- Pre-loader end -->
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
                                   
                                <!-- Page-body start -->
                                <div class="page-body">
                                    <!-- Basic table card start -->
                                    <div class="card">
                                        <div class="card-header">
                                        <?php
            if (isset($_SESSION['status'])) {
                echo "<div class='alert alert-success'>" . $_SESSION['status'] . "</div>";
                unset($_SESSION['status']);
            }
            ?>

            <?php
            $query = "SELECT * FROM p_details";
            $query_run = mysqli_query($con, $query);
            if (mysqli_num_rows($query_run) > 0) {
                ?>
                                            <h5>Registered Product</h5>
                                            <div class="card-header-right">    <ul class="list-unstyled card-option">        
                                                <li><i class="icofont icofont-simple-left "></i></li>        
                                                <li><i class="icofont icofont-maximize full-card"></i></li>       
                                                 <li><i class="icofont icofont-minus minimize-card"></i></li>       
                                                  <li><i class="icofont icofont-refresh reload-card"></i></li>       
                                                   <li><i class="icofont icofont-error close-card"></i></li>    </ul></div>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Product Name</th>
                                                            <th>Product Details</th>
                                                            <th>Product Color</th>
                                                            <th>Product Price</th>
                                                            <th>Product Size</th>
                                                            <th>Product off price</th>
                                                            <th>Product Percentage
                                                                discount</th>
                                                                <th>Product Delivery</th>
                                                                <th>Product Deal</th>
                                                                <th>Product Image</th>
                                                       </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                foreach ($query_run as $row) {
                                    ?>
                                                        <tr>
                                                            <th ><?php echo htmlspecialchars($row['id']); ?></th>
                                                            <th ><?php echo htmlspecialchars($row['p_name']); ?></th>
                                                            <th ><?php echo htmlspecialchars($row['pdname']); ?></th>
                                                            <th ><?php echo htmlspecialchars($row['p_color']); ?></th>
                                                            <th ><?php echo htmlspecialchars($row['p_price']); ?></th>
                                                            <th ><?php echo htmlspecialchars($row['p_size']); ?></th>
                                                            <th ><?php echo htmlspecialchars($row['p_off_price']); ?></th>
                                                            <th ><?php echo htmlspecialchars($row['p_p_discount']); ?></th>
                                                            <th ><?php echo htmlspecialchars($row['p_delivery']); ?></th>
                                                            <th ><?php echo htmlspecialchars($row['p_deal']); ?></th>
                                                            
                                                            <td> <img 
                                                src="<?php echo htmlspecialchars($row['pd_image']); ?>" 
                                                alt="<?php echo htmlspecialchars($row['p_name']); ?>" 
                                                style="width: 100px; height: 100px;"></td>
                                                          
                                                            
                                                        </tr>
                                                        <?php
                                                         }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                ?>
                <div class="col-12">
                    <div class="alert alert-warning">No Records Found</div>
                </div>
                <?php
            }
            ?>
                                    </div>
                                   
                                </div>
                                <!-- Page-body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->

                        <div id="styleSelector">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>