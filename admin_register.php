<?php
// Database connection
include("config/dbcons.php");

// Handle the registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password']; // Plain text password

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $stmt = $con->prepare('SELECT id FROM admin_user WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error_message = "Username already exists!";
    } else {
        // Insert the username and hashed password into the database
        $stmt = $con->prepare('INSERT INTO admin_user (username, password) VALUES (?, ?)');
        $stmt->bind_param('ss', $username, $hashed_password);
        if ($stmt->execute()) {
            $success_message = "Admin registered successfully!";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-12">
                <div class="card p-4">
                    <h3 class="text-center mb-4">Admin Registration</h3>

                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php elseif (isset($success_message)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
                    <?php endif; ?>

                    <form action="admin_register.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
