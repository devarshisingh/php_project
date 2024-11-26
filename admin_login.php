<?php
session_start();
include("config/dbcons.php");  // Include the database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password']; // The password entered by the user

    // Query to fetch the user details from the database
    $stmt = $con->prepare('SELECT id, password FROM admin_user WHERE username = ?');
    $stmt->bind_param('s', $username);  // Bind the username to the query
    $stmt->execute();
    $stmt->store_result();  // Store the result to check the number of rows

    if ($stmt->num_rows === 1) {
        // If user found, bind the result to variables
        $stmt->bind_result($user_id, $stored_password);
        $stmt->fetch();

        // Use password_verify to check the entered password against the stored hashed password
        if (password_verify($password, $stored_password)) {
            // Correct password, create session and redirect
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header('Location: category_head_register.php');  // Redirect to a protected page
            exit;
        } else {
            // Password is incorrect
            $error_message = 'Invalid username or password.';
        }
    } else {
        // No user found with the entered username
        $error_message = 'Invalid username or password.';
    }

    // Close the statement
    $stmt->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-12">
                <div class="card p-4">
                    <h3 class="text-center mb-4">Admin Login</h3>

                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php endif; ?>

                    <form action="admin_login.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
