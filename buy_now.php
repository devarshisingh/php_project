<?php
session_start();
include('config/dbcons.php');

// Check if the user is logged in
if (!isset($_SESSION['user_data'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    
    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM p_details WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        // Set session variable for checkout
        $_SESSION['buyNow'] = [ 
            'id' => $product['id'],
            'name' => $product['pdname'],
            'price' => $product['p_price'],
            'poffprice' => $product['p_off_price'],
            'image' => $product['pd_image'],
            'color' => $product['p_color'],
            'size' => $product['p_size'],
            'delivery' => $product['p_delivery'],
            'deal' => $product['p_deal'],
            'discount' => $product['p_p_discount']
        ];

        // Redirect to checkout page
        header("Location: checkout.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Product not found.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>No product ID provided.</div>";
}
?>
