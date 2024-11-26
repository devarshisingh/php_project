<?php
session_start();
include('config/dbcons.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'] ?? null;

    if ($orderId) {
        // Use prepared statements to delete the order and its items
        $deleteItemsQuery = "DELETE FROM order_items WHERE order_id = ?";
        $deleteOrderQuery = "DELETE FROM orders WHERE id = ?";

        // Start transaction
        mysqli_begin_transaction($con);

        try {
            // Delete items from order_items
            $stmt = mysqli_prepare($con, $deleteItemsQuery);
            mysqli_stmt_bind_param($stmt, 'i', $orderId);
            mysqli_stmt_execute($stmt);

            // Delete order from orders
            $stmt = mysqli_prepare($con, $deleteOrderQuery);
            mysqli_stmt_bind_param($stmt, 'i', $orderId);
            mysqli_stmt_execute($stmt);

            // Commit transaction
            mysqli_commit($con);

            header("Location: our_order.php?message=Order deleted successfully.");
            exit();
        } catch (Exception $e) {
            // Rollback transaction on error
            mysqli_rollback($con);
            echo "Error deleting order: " . $e->getMessage();
        }
    } else {
        echo "Invalid order ID.";
    }
} else {
    echo "Invalid request method.";
}
?>
