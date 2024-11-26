<?php
session_start();
include('config/dbcons.php');
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");
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
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="text-center">User Profile</h5>
                                            <?php
                                            if (isset($_SESSION['status'])) {
                                                echo "<div class='alert alert-success'>" . $_SESSION['status'] . "</div>";
                                                unset($_SESSION['status']);
                                            }
                                            ?>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            $query = "SELECT * FROM registration";
                                            $query_run = mysqli_query($con, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Password</th>
                                                                <th>Address</th>
                                                                <th>Pincode</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($query_run as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                                                    <td><?php echo htmlspecialchars($row['password']); ?></td>
                                                                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                                                                    <td><?php echo htmlspecialchars($row['pincode']); ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="text-center mt-4">
                                                    <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
                                                   
                                                </div>
                                                <?php
                                            } else {
                                                echo "<p class='text-danger'>No user found.</p>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->
                        <div id="styleSelector"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("assets/e-commerce_includefile/footer.php");
?>
