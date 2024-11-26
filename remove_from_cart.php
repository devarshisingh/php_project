<?php
session_start();
include("config/dbcons.php");

$response = ['success' => false];

if (isset($_POST['item_ids'])) {
    $itemId = $_POST['item_ids'];
    $userId = $_SESSION['user_data']['id'] ?? null;

    if ($userId) {
       
        $query = "DELETE FROM user_cart WHERE user_id = '$userId' AND product_id = '$itemId'";
        if (mysqli_query($con, $query)) {
            $response['success'] = true;
        }
    } else {

        if (isset($_SESSION['temp_cart'])) {
            foreach ($_SESSION['temp_cart'] as $key => $item) {
                if ($item['id'] == $itemId) {
                    unset($_SESSION['temp_cart'][$key]);
                    $response['success'] = true;
                    break;
                }
            }

            $_SESSION['temp_cart'] = array_values($_SESSION['temp_cart']);
        }
    }
}

echo json_encode($response);
?>
