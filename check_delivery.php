<?php
include("config/dbcons.php");

// Check if pincode is set
if (isset($_POST['pincode'])) {
    $pincode = mysqli_real_escape_string($con, $_POST['pincode']);

    // Prepare the response array
    $response = array('success' => false, 'message' => '');

    // Check if the pincode exists in the admin's pincode database and retrieve the is_active status
    $adminQuery = "SELECT is_active FROM admin_pincodes WHERE pincode = '$pincode' LIMIT 1";
    $adminResult = mysqli_query($con, $adminQuery);

    if (mysqli_num_rows($adminResult) > 0) {
        // Pincode found in admin's pincode database, get the is_active status
        $adminRow = mysqli_fetch_assoc($adminResult);
        $isActive = $adminRow['is_active'];

        if ($isActive == 1) {
            // If is_active = 1, delivery is available
            $response['success'] = true;
            $response['message'] = 'Delivery is available for your pincode.';
        } else {
            // If is_active = 0, delivery is not available
            $response['message'] = 'Delivery is not available for your pincode.';
        }
    } else {
        // Pincode not found in admin's pincode database
        $response['message'] = 'Sorry, we do not deliver to this pincode.';
    }

    // Return the response as JSON
    echo json_encode($response);
} else {
    // If pincode is not provided
    echo json_encode(array('success' => false, 'message' => 'No pincode provided.'));
}
?>

