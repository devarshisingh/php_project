<?php
session_start();
include('config/dbcons.php');

$user_data = $_SESSION['user_data'] ?? null;

// Check if the user is logged in
if (!$user_data) {
    header("Location: login.php");
    exit();
}

$userId = $user_data['id'];
$total_price = $_POST['total_price'] ?? 0;
$product_ids = $_POST['product_ids'] ?? [];
$product_images = $_POST['product_images'] ?? [];
$product_prices = $_POST['product_prices'] ?? [];
$quantities = $_POST['quantities'] ?? [];
$product_names = $_POST['product_names'] ?? []; // New variable for product names

// Retrieve the user's pincode from the registration table
$userQuery = "SELECT pincode FROM registration WHERE id = ?";
$userStmt = mysqli_prepare($con, $userQuery);
mysqli_stmt_bind_param($userStmt, 'i', $userId);
mysqli_stmt_execute($userStmt);
$userResult = mysqli_stmt_get_result($userStmt);
$userDetails = mysqli_fetch_assoc($userResult);

// Check if user details were retrieved
if (!$userDetails) {
    echo "<div class='alert alert-danger'>User details not found. Please contact support.</div>";
    exit();
}

// Retrieve the user's pincode
$userPincode = $userDetails['pincode'] ?? '';

// Now check if the user's pincode exists in the admin's pincode database and if it's active
$adminQuery = "SELECT is_active FROM admin_pincodes WHERE pincode = ?";
$adminStmt = mysqli_prepare($con, $adminQuery);
mysqli_stmt_bind_param($adminStmt, 's', $userPincode); // 's' for string (pincode)
mysqli_stmt_execute($adminStmt);
$adminResult = mysqli_stmt_get_result($adminStmt);

// Check if pincode exists in the admin's database and whether it's active
if (mysqli_num_rows($adminResult) === 0) {
    // If pincode not found in admin's pincode list, show alert and stop the process
    echo "<script>alert('Sorry, we do not deliver to your pincode. Please change your pincode.'); window.location.href = 'checkout.php';</script>";
    exit();
}

// Fetch the pincode status (is_active) from the admin's pincode database
$adminPincode = mysqli_fetch_assoc($adminResult);
$isActive = $adminPincode['is_active']; // 1 for active, 0 for inactive

// Show message based on the is_active status of the pincode
if ($isActive == 0) {
    // If the pincode is inactive (delivery not available)
    echo "<script>alert('Delivery is not available for your pincode. Please change your pincode.'); window.location.href = 'checkout.php';</script>";
    exit();
} else {
    // If the pincode is active (delivery available)
    echo "<script>alert('Delivery is available for your pincode.');</script>";
}

// Proceed with the order creation since the pincode is valid and active
// Insert order into the orders table
$orderQuery = "INSERT INTO orders (user_id, total_price) VALUES (?, ?)";
$orderStmt = mysqli_prepare($con, $orderQuery);
mysqli_stmt_bind_param($orderStmt, 'id', $userId, $total_price);
mysqli_stmt_execute($orderStmt);
$orderId = mysqli_insert_id($con); // Get the last inserted order ID

// Insert order items into the order_items table
foreach ($product_ids as $index => $product_id) {
    $price = $product_prices[$index];
    $quantity = $quantities[$index];
    $image = $product_images[$index];
    $name = $product_names[$index]; // Get the product name

    $itemQuery = "INSERT INTO order_items (order_id, product_id, quantity, price, image, name) VALUES (?, ?, ?, ?, ?, ?)";
    $itemStmt = mysqli_prepare($con, $itemQuery);
    mysqli_stmt_bind_param($itemStmt, 'iidsss', $orderId, $product_id, $quantity, $price, $image, $name);
    mysqli_stmt_execute($itemStmt);
}

// Clear the user's cart after checkout
$clearCartQuery = "DELETE FROM user_cart WHERE user_id = ?";
$clearCartStmt = mysqli_prepare($con, $clearCartQuery);
mysqli_stmt_bind_param($clearCartStmt, 'i', $userId);
mysqli_stmt_execute($clearCartStmt);

// Redirect to order confirmation page
header("Location: order_confirmation.php?id=" . $orderId);
exit();
?>
