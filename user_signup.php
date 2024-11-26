<?php
session_start();
include('config/dbcons.php'); // Ensure you have your database connection
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Initialize variables to hold form data
$name = $email = $mobile_no = $address = $pincode = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); 
    $mobile_no = trim($_POST['mobile_no']);
    $address = trim($_POST['address']);
    $pincode = trim($_POST['pincode']);
    $verification_token = bin2hex(random_bytes(16)); // Generate a verification token

    // Check for existing email or mobile number
    $check_query = "SELECT * FROM registration WHERE email = ? OR mobile_no = ?";
    $check_stmt = mysqli_prepare($con, $check_query);
    mysqli_stmt_bind_param($check_stmt, 'ss', $email, $mobile_no);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        // User already exists
        $error_message = "Email or Mobile Number already registered. Please try again.";
    } else {
        // Insert user into the database with is_verified set to 0
        $query = "INSERT INTO registration (name, email, password, mobile_no, address, pincode, verification_token, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        
        if ($stmt) {
            $is_verified = 0; // Default value for is_verified
            mysqli_stmt_bind_param($stmt, 'ssssssss', $name, $email, $password, $mobile_no, $address, $pincode, $verification_token, $is_verified);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Send verification email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'devarshisingh50@gmail.com'; // Your email
                $mail->Password = 'dyazovsxnyzxczhi'; // Your email password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('devarshisingh50@gmail.com', 'Your Name');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = "Email Verification";
                $mail->Body = "Click the link to verify your email: <a href='http://localhost/admin_cats/admin_cat/verify.php?token=$verification_token&email=$email'>Verify Email</a>";

                $mail->send();

                // Redirect to e-commerce page with JavaScript
                echo "<script>alert('Registration successful! A verification email has been sent to $email.'); window.location.href='e_commerce.php';</script>";
                exit();
            } catch (Exception $e) {
                echo "<div class='alert alert-danger'>Email could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Error preparing the SQL statement.</div>";
        }
    }
    mysqli_stmt_close($check_stmt);
}
?>

<!-- Registration HTML form -->
<div class="container mt-5">
    <h4 class="mb-4 text-center">Please Register Now</h4>
    <?php if ($error_message): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form id="registrationForm" action="user_signup.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nameField">Name</label>
                <input type="text" class="form-control" id="nameField" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="emailField">Email</label>
                <input type="email" class="form-control" id="emailField" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required minlength="7">
            </div>
            <div class="col-md-3 mb-3">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required minlength="7">
            </div>
            <div class="col-md-6 mb-3">
                <label for="mobileField">Mobile No.</label>
                <input type="tel" class="form-control" id="mobileField" name="mobile_no" value="<?php echo htmlspecialchars($mobile_no); ?>" required maxlength="10" pattern="\d{10}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="addressField">Address</label>
                <input type="text" class="form-control" id="addressField" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="pincodeField">Pincode</label>
                <input type="text" class="form-control" id="pincodeField" name="pincode" value="<?php echo htmlspecialchars($pincode); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="captcha">Captcha</label>
                <img src="captcha.php" alt="CAPTCHA Image" class="img-fluid mb-2">
                <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter CAPTCHA code" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3 mb-3">
                <button type="submit" class="btn btn-primary btn-block" name="register">Submit</button>
            </div>
        </div>
    </form>
</div>

<?php
include("assets/e-commerce_includefile/footer.php");
?>
