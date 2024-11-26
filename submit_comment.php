<?php
session_start();
include("config/dbcons.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_comment') {
    $product_id = $_POST['product_id'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_data']['id']; // Assuming user data is stored in session

    // Sanitize input
    $comment = mysqli_real_escape_string($con, $comment);

    // Insert comment into the database with user_id and is_active set to 0 (inactive)
    $query = "INSERT INTO product_comments (product_id, user_id, comment, is_active) VALUES (?, ?, ?, 0)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'iis', $product_id, $user_id, $comment);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($con)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
