<?php
// Start the session to access session variables
session_start();

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header('Location: admin_login.php');
exit;
?>
