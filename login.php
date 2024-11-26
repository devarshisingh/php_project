<?php
session_start();
include('config/dbcons.php');
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");
?>

<!-- Login HTML Form -->
<div class="container mt-4 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <h2 class="text-center mb-4">Login</h2>
        <form action="user_code.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="login_btn">Login</button>
        </form>
        <div class="mt-3 text-center">
            <a href="user_signup.php">Don't have an account? Register here</a>
        </div>
    </div>
</div>

<?php
include("assets/e-commerce_includefile/footer.php");
?>
