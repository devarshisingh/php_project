<?php
session_start();
include("config/dbcons.php");  // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];  // The entered password

    // Query to fetch the user and their stored hashed password
    $stmt = $con->prepare('SELECT id, password FROM admin_user WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result(); 

    if ($stmt->num_rows === 1) {
        // Bind the result to variables
        $stmt->bind_result($user_id, $stored_password);
        $stmt->fetch();

        // Verify the entered password against the stored hashed password
        if (password_verify($password, $stored_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            header('Location: category_head_register.php');
            exit;
        } else {
            // Incorrect password
            $error_message = 'Invalid username or password.';
        }
    } else {
        // No matching user found
        $error_message = 'Invalid username or password.';
    }

    $stmt->close();
}
?>
