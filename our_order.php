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

$userId = $user_data['id'];

// Retrieve the orders for the logged-in user
$orderQuery = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($con, $orderQuery);
mysqli_stmt_bind_param($stmt, 'i', $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo "<div class='alert alert-danger'>There was an issue retrieving your orders. Please try again later.</div>";
    exit();
}

$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="container mt-5">
    <h2 class="text-center">Your Orders</h2>

    <?php if (!empty($orders)): ?>
        <div class="list-group">
            <?php foreach ($orders as $order): ?>
                <div class="list-group-item">
                    <h5>Order ID: <?php echo htmlspecialchars($order['id']); ?></h5>
                    <p>Total Price: ₹<?php echo htmlspecialchars($order['total_price']); ?></p>
                    <p>Order Date: <?php echo htmlspecialchars($order['created_at']); ?></p>
                    
                    <!-- Delete Order Button -->
                    <form action="process_delete_order.php" method="post" class="d-inline">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['id']); ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?');">Delete Order</button>
                    </form>

                    <button class="btn btn-info" data-toggle="collapse" data-target="#order-details-<?php echo htmlspecialchars($order['id']); ?>">View Items</button>

                    <div id="order-details-<?php echo htmlspecialchars($order['id']); ?>" class="collapse">
                        <ul class="list-group mt-3">
                            <?php
                            // Retrieve order items for this order
                            $orderId = $order['id'];
                            $itemQuery = "SELECT * FROM order_items WHERE order_id = ?";
                            $itemStmt = mysqli_prepare($con, $itemQuery);
                            mysqli_stmt_bind_param($itemStmt, 'i', $orderId);
                            mysqli_stmt_execute($itemStmt);
                            $itemResult = mysqli_stmt_get_result($itemStmt);
                            $orderItems = mysqli_fetch_all($itemResult, MYSQLI_ASSOC);

                            foreach ($orderItems as $item): ?>
                                <li class="list-group-item d-flex align-items-center">
                                    <div class="col-md-4">
                                        <img src="<?php echo htmlspecialchars($item['image']); ?>" class="img-fluid rounded-start" alt="Product Image">
                                    </div>
                                    <div class="ml-3">
                                        <h6><?php echo htmlspecialchars($item['name']); // Product name ?></h6>
                                        <p>Price: ₹<?php echo htmlspecialchars($item['price']); ?> (Qty: <?php echo htmlspecialchars($item['quantity']); ?>)</p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">You have not placed any orders yet.</div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include("assets/e-commerce_includefile/footer.php");
?>


