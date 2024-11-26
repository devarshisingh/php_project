<?php
session_start();
include('config/dbcons.php');
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");

$user_data = $_SESSION['user_data'] ?? null;

if (!$user_data) {
    header("Location: login.php");
    exit();
}
?>

<div class="container mt-5">
    <h2 class="text-center">Thank You for Your Order!</h2>
    
    <div class="alert alert-success text-center">
        <h4>Your order has been placed successfully!</h4>
        <p>A confirmation email has been sent to <strong><?php echo htmlspecialchars($user_data['email']); ?></strong>.</p>
        <p>We appreciate your business and look forward to serving you again!</p>
    </div>

    <h4>What’s Next?</h4>
    <ul>
        <li>You can view your order details <a href="our_order.php">here</a>.</li>
        <li>Feel free to browse more products <a href="shop.php">here</a>.</li>
        <li>If you have any questions, contact our support team.</li>
    </ul>
    
    <a href="shop.php" class="btn btn-primary">Continue Shopping</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
include("assets/e-commerce_includefile/footer.php");
?>
