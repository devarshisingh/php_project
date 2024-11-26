<?php

include('config/dbcons.php');
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");

if (isset($_GET['user_data'])) {
    $id = $_GET['user_data'];
    $register_query = "SELECT * FROM registration WHERE id='$id'";
    $register_query_run = mysqli_query($con, $register_query);

    if (mysqli_num_rows($register_query_run) > 0) {
        $user_data = mysqli_fetch_assoc($register_query_run);

        ?>

        <div class="container mt-5">
            <h3 class="text-center">Edit Profile</h3>
            <div class="card shadow">
                <div class="card-body">
                    <form action="user_code.php" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_data['id']); ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="<?php echo htmlspecialchars($user_data['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" name="password" id="password"
                            value="<?php echo htmlspecialchars($user_data['password']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address"
                                value="<?php echo htmlspecialchars($user_data['address']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Mobile No.">Mobile No.</label>
                            <input type="text" class="form-control" name="mobile_no" id="mobile_no"
                                value="<?php echo htmlspecialchars($user_data['mobile_no']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pincode</label>
                            <input type="text" class="form-control" name="pincode" id="pincode"
                                value="<?php echo htmlspecialchars($user_data['pincode']); ?>" required>
                        </div>
                        <button type="submit" name="update_btns" class="btn btn-primary btn-block">Update Profile</button>
                    </form>
                    <?php
    } else {
        echo "<script>alert('Invalid ID'); window.location.href='user_profile.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('No ID provided'); window.location.href='user_profile.php';</script>";
    exit();
}
?>
        </div>
    </div>
</div>

<?php
include("assets/e-commerce_includefile/footer.php");
?>