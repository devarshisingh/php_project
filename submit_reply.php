<?php
session_start();
include("config/dbcons.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_reply') {
    $comment_id = $_POST['comment_id'];
    $reply = $_POST['reply'];
    $user_id = $_SESSION['user_data']['id']; // Assuming user data is stored in session

    // Sanitize input
    $reply = mysqli_real_escape_string($con, $reply);

    // Insert reply into the database
    $query = "INSERT INTO comment_replies (comment_id, user_id, reply, is_active) VALUES (?, ?, ?, 0)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'iis', $comment_id, $user_id, $reply);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($con)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
