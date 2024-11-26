<?php
session_start();
include('config/dbcons.php');
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$user_data = $_SESSION['user_data'] ?? null;

if (!$user_data) {
    header("Location: login.php");
    exit();
}

// Get the order ID from the query string
$orderId = $_GET['id'] ?? null;

if (!$orderId) {
    echo "<div class='alert alert-danger'>Invalid order ID.</div>";
    exit();
}

// Fetch order details
$query = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 'ii', $orderId, $user_data['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<div class='alert alert-danger'>Order not found or you do not have permission to view this order.</div>";
    exit();
}

$order = mysqli_fetch_assoc($result);

// Fetch order items
$itemQuery = "SELECT * FROM order_items WHERE order_id = ?";
$itemStmt = mysqli_prepare($con, $itemQuery);
mysqli_stmt_bind_param($itemStmt, 'i', $orderId);
mysqli_stmt_execute($itemStmt);
$itemResult = mysqli_stmt_get_result($itemStmt);
$orderItems = mysqli_fetch_all($itemResult, MYSQLI_ASSOC);

// Send confirmation email using PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'devarshisingh50@gmail.com'; // Your email
    $mail->Password = 'dyazovsxnyzxczhi'; // Your email password (consider using environment variables for security)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
    $mail->Port = 587; // TCP port to connect to

    // Recipients
    $mail->setFrom('devarshisingh50@gmail.com', 'Devarshi Singh'); // Change to your name
    $mail->addAddress($user_data['email']); // Add a recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = "Order Confirmation - Order ID " . htmlspecialchars($order['id']);

    // Build the email body
    $message = "
    <html>
    <head>
        <title>Order Confirmation</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f8f9fa;
            }
            .container {
                max-width: 600px;
                margin: auto;
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #007bff;
            }
            .item {
                display: flex;
                align-items: center;
                border-bottom: 1px solid #e9ecef;
                padding: 10px 0;
            }
            .item img {
                height: 100px;
                width: auto;
                margin-right: 15px;
                border-radius: 5px;
            }
            .item-details {
                flex-grow: 1;
            }
            .total {
                font-weight: bold;
                font-size: 1.2em;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Thank you for your purchase!</h2>
            <p>Your order has been placed successfully.</p>
            <p><strong>Order ID:</strong> " . htmlspecialchars($order['id']) . "</p>
            <p><strong>Order Date:</strong> " . htmlspecialchars($order['created_at']) . "</p>
            <h4>Your Order Items:</h4>";

    foreach ($orderItems as $item) {
        // Set the correct path for your images
        $imagePath = $item['image']; // Ensure this points to the correct directory
        
        // Add embedded image with a unique identifier
        $mail->addEmbeddedImage($imagePath, 'image' . $item['id']); 

        $message .= "
            <div class='item'>
                <img src='cid:image" . $item['id'] . "' alt='" . htmlspecialchars($item['name']) . "'>
                <div class='item-details'>
                    <h6>" . htmlspecialchars($item['name']) . "</h6>
                    <p>Price: ₹" . htmlspecialchars($item['price']) . " (Qty: " . htmlspecialchars($item['quantity']) . ")</p>
                </div>
            </div>";
    }

    $message .= "
            <div class='total'>
                <p><strong>Total Price:</strong> ₹" . htmlspecialchars($order['total_price']) . "</p>
            </div>
        </div>
    </body>
    </html>";

    $mail->Body = $message;

    // Send the email
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// HTML for displaying the order confirmation
?>

<div class="container mt-5">
    <h2 class="text-center">Order Confirmation</h2>

    <div class="alert alert-success">
        <h4>Thank you for your purchase!</h4>
        <p>Your order has been placed successfully.</p>
        <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['id']); ?></p>
        <p><strong>Total Price:</strong> ₹<?php echo htmlspecialchars($order['total_price']); ?></p>
        <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['created_at']); ?></p>
    </div>

    <h4>Your Order Items:</h4>
    <ul class="list-group mb-4">
        <?php foreach ($orderItems as $item): ?>
            <li class="list-group-item d-flex align-items-center">
                <div class="col-md-4">
                    <img src="<?php echo htmlspecialchars($item['image']); ?>" class="img-fluid rounded-start"
                    alt="<?php echo htmlspecialchars($item['name']); ?>" style="height: 200px; width: 150px;">
                </div>

                <div class="ml-3">
                    <h6><?php echo htmlspecialchars($item['name']); // Product name ?></h6>
                    <p>Price: ₹<?php echo htmlspecialchars($item['price']); ?> (Qty:
                        <?php echo htmlspecialchars($item['quantity']); ?>)</p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="our_order.php" class="btn btn-primary">View Your Orders</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
include("assets/e-commerce_includefile/footer.php");
?>
