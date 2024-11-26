<?php
session_start();
include("config/dbcons.php");

if (isset($_POST['action']) && $_POST['action'] === 'vote_reply') {
    $reply_id = intval($_POST['reply_id']);
    $vote = $_POST['vote'];
    $user_id = $_SESSION['user_data']['id']; // Ensure user is logged in

    // Check if the user has already voted
    $checkVoteQuery = "SELECT * FROM reply_votes WHERE reply_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($con, $checkVoteQuery);
    mysqli_stmt_bind_param($stmt, 'ii', $reply_id, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Update vote if it already exists
        $updateVoteQuery = "UPDATE reply_votes SET vote = ? WHERE reply_id = ? AND user_id = ?";
        $stmt = mysqli_prepare($con, $updateVoteQuery);
        mysqli_stmt_bind_param($stmt, 'sii', $vote, $reply_id, $user_id);
    } else {
        // Insert new vote
        $insertVoteQuery = "INSERT INTO reply_votes (reply_id, user_id, vote) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $insertVoteQuery);
        mysqli_stmt_bind_param($stmt, 'iis', $reply_id, $user_id, $vote);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error.']);
    }
}
?>
