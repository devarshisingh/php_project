<?php
session_start();
include("config/dbcons.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if product_id and quantity are set
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $productId = intval($_POST['product_id']);
        $quantity = intval($_POST['quantity']);
        $userId = $_SESSION['user_data']['id'] ?? null;

        if ($userId) {
            // Check if the product is in the cart
            $query = "SELECT quantity FROM user_cart WHERE user_id = ? AND product_id = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'ii', $userId, $productId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                // Product exists, update the quantity
                if ($quantity > 0) {
                    $updateQuery = "UPDATE user_cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
                    $updateStmt = mysqli_prepare($con, $updateQuery);
                    mysqli_stmt_bind_param($updateStmt, 'iii', $quantity, $userId, $productId);
                    mysqli_stmt_execute($updateStmt);
                    
                    if (mysqli_stmt_affected_rows($updateStmt) === 0) {
                        $_SESSION['message'] = "No changes made to the cart.";
                    } else {
                        $_SESSION['message'] = "Cart updated successfully!";
                    }
                } else {
                    // If quantity is 0, remove item from cart
                    $deleteQuery = "DELETE FROM user_cart WHERE user_id = ? AND product_id = ?";
                    $deleteStmt = mysqli_prepare($con, $deleteQuery);
                    mysqli_stmt_bind_param($deleteStmt, 'ii', $userId, $productId);
                    mysqli_stmt_execute($deleteStmt);

                    if (mysqli_stmt_affected_rows($deleteStmt) > 0) {
                        $_SESSION['message'] = "Item removed from the cart.";
                    } else {
                        $_SESSION['message'] = "Failed to remove the item.";
                    }
                }
            } else {
                // If the item is not in the cart and quantity is greater than 0, add it
                if ($quantity > 0) {
                    $insertQuery = "INSERT INTO user_cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
                    $insertStmt = mysqli_prepare($con, $insertQuery);
                    mysqli_stmt_bind_param($insertStmt, 'iii', $userId, $productId, $quantity);
                    mysqli_stmt_execute($insertStmt);

                    if (mysqli_stmt_affected_rows($insertStmt) > 0) {
                        $_SESSION['message'] = "Item added to the cart!";
                    } else {
                        $_SESSION['message'] = "Failed to add the item.";
                    }
                }
            }
        } else {
            // Handle temp cart logic if user is not logged in
            if (isset($_SESSION['temp_cart'])) {
                foreach ($_SESSION['temp_cart'] as $index => $item) {
                    if ($item['id'] == $productId) {
                        if ($quantity > 0) {
                            $_SESSION['temp_cart'][$index]['quantity'] = $quantity;
                        } else {
                            unset($_SESSION['temp_cart'][$index]);
                        }
                        break;
                    }
                }
            }
        }
    }
}

// Redirect back to the cart
header('Location: cart.php');
exit;
