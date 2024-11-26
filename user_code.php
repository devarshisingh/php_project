<?php
session_start();
include('config/dbcons.php');

if (isset($_POST["register"])) {


    $captchaInput = $_POST['captcha'] ?? '';
    $isCaptchaValid = ($captchaInput === $_SESSION['captcha']);

    // Collect form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $mobile_no = trim($_POST['mobile_no']);
    $confirmpassword = $_POST['confirmpassword'];
    $address = trim($_POST['address']);
    $pincode = trim($_POST['pincode']);

    $messages = [];

    if ($password !== $confirmpassword) {
        $messages[] = 'Passwords do not match!';
    }


    if (!$isCaptchaValid) {
        $messages[] = 'CAPTCHA verification failed. Please try again.';
    }

    
    if (empty($messages)) {
        $stmt = $con->prepare("SELECT * FROM registration WHERE email = ? OR mobile_no = ?");
        $stmt->bind_param("ss", $email, $mobile_no);
        $stmt->execute();
        $checkResult = $stmt->get_result();

        if ($checkResult->num_rows > 0) {
            while ($row = $checkResult->fetch_assoc()) {
                if ($row['email'] === $email) {
                    $messages[] = 'This email is already registered. Please use a different one.';
                }
                if ($row['mobile_no'] === $mobile_no) {
                    $messages[] = 'This mobile number is already registered. Please use a different one.';
                }
            }
        }
    }

   
    if (!empty($messages)) {
        echo "<script>
            alert('" . implode("\\n", $messages) . "');
            window.location.href = 'user_signup.php';
        </script>";
    } else {
       
        $insertStmt = $con->prepare("INSERT INTO registration (name, email, password, mobile_no, address, pincode) VALUES (?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("ssssss", $name, $email, $password, $mobile_no, $address, $pincode);
        $insertResult = $insertStmt->execute();

        if ($insertResult) {
            header("Location: login.php");
            exit();
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
}


if (isset($_POST['login_btn'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password']; // Assuming you are not hashing the password

    // Validate user
    $query = "SELECT * FROM registration WHERE email = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();

        // Check if the password matches the stored password (not hashed)
        if ($password === $user_data['password']) { // Direct comparison
            if ($user_data['is_verified'] == 1) {
                $_SESSION['user_data'] = $user_data;

                // Check for temporary cart items
                $temp_cart = $_SESSION['temp_cart'] ?? [];
                foreach ($temp_cart as $product) {
                    $productId = $product['id'];
                    $quantity = $product['quantity'];

                    // Insert item into user cart
                    $insert_cart = $con->prepare("INSERT INTO user_cart (user_id, product_id, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?");
                    $insert_cart->bind_param("iiii", $user_data['id'], $productId, $quantity, $quantity);
                    $insert_cart->execute();
                }

                unset($_SESSION['temp_cart']);
                header('Location: user_profile.php');
                exit();
            } else {
                $_SESSION['status'] = "Please verify your email before logging in.";
                header('Location: login.php');
                exit();
            }
        } else {
            $_SESSION['status'] = "Invalid email or password!";
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['status'] = "No user found with that email address.";
        header('Location: login.php');
        exit();
    }
}








if (isset($_POST['update_btns'])) {
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$mobile_no = $_POST['mobile_no'];
$address = $_POST['address'];
$pincode = $_POST['pincode'];

// Prepare the update statement
$stmt = $con->prepare("UPDATE registration SET name=?, email=?, password=?, mobile_no=?, address=?, pincode=? WHERE
id=?");
$stmt->bind_param("ssssssi", $name, $email, $password, $mobile_no, $address, $pincode, $id);

if ($stmt->execute()) {
// Update session data
$_SESSION['user_data'] = [
'id' => $id,
'name' => $name,
'email' => $email,
'mobile_no' => $mobile_no,
'address' => $address,
'pincode' => $pincode,
// Do not include the password for security reasons
];

$_SESSION['status'] = "User Updated Successfully";
header("Location: user_profile.php");
exit();
} else {
$_SESSION['status'] = "User Updating Failed";
header("Location: edit_profile.php?user_data=$id");
exit();
}
}

if (isset($_POST["update_f_category"])) {
$id = $_POST["id"];
$f_name = $_POST["f_c_name"];

$query = "UPDATE add_f_category SET f_c_name='$f_name' WHERE id = '$id'";
$query_edit_run = mysqli_query($con, $query);
if ($query_edit_run) {
echo "Data Updated Successful";
} else {
echo "Data Not Updated";
}
}

?>