<?php
session_start();
include("config/dbcons.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['product_id']);
    $userId = $_SESSION['user_data']['id'] ?? null;
    $quantity = 1; // Default quantity for new additions

    if ($userId) {
        // User is logged in
        $query = "SELECT quantity FROM user_cart WHERE user_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'ii', $userId, $productId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $cartItem = mysqli_fetch_assoc($result);

        if ($cartItem) {
            // Update quantity
            $newQuantity = $cartItem['quantity'] + $quantity;
            $updateQuery = "UPDATE user_cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
            $updateStmt = mysqli_prepare($con, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, 'iii', $newQuantity, $userId, $productId);
            mysqli_stmt_execute($updateStmt);
        } else {
            // Insert new item
            $insertQuery = "INSERT INTO user_cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
            $insertStmt = mysqli_prepare($con, $insertQuery);
            mysqli_stmt_bind_param($insertStmt, 'iii', $userId, $productId, $quantity);
            mysqli_stmt_execute($insertStmt);
        }
    } else {
        // User is not logged in, handle temporary cart
        if (!isset($_SESSION['temp_cart'])) {
            $_SESSION['temp_cart'] = [];
        }

        // Check if product already exists in temp cart
        $exists = false;
        foreach ($_SESSION['temp_cart'] as &$item) {
            if ($item['id'] == $productId) {
                $item['quantity'] += $quantity;
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            // Add new item to temp cart
            $_SESSION['temp_cart'][] = ['id' => $productId, 'quantity' => $quantity];
        }
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

?>
