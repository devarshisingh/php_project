<?php
session_start();
include('config/dbcons.php'); // Database connection

if (isset($_GET['token']) && isset($_GET['email'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];

    // Prepare to check the token and email in the database
    $query = "SELECT * FROM registration WHERE email = ? AND verification_token = ?";
    $stmt = mysqli_prepare($con, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $email, $token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Update user status to verified
            $updateQuery = "UPDATE registration SET is_verified = 1, verification_token = NULL WHERE email = ?";
            $updateStmt = mysqli_prepare($con, $updateQuery);
            
            if ($updateStmt) {
                mysqli_stmt_bind_param($updateStmt, 's', $email);
                mysqli_stmt_execute($updateStmt);
                mysqli_stmt_close($updateStmt);
                
                // Output JavaScript alert and redirection
                echo "<script type='text/javascript'>
                        alert('Email verified successfully! You can now log in.');
                        window.location.href = 'login.php';
                      </script>";
                exit();
            } else {
                echo "<div class='alert alert-danger'>Error updating verification status.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Invalid verification link or token. Please check your email for the correct link.</div>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<div class='alert alert-danger'>Error preparing the SQL statement.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Missing token or email.</div>";
}
?>
