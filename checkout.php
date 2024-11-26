<?php
session_start();
include('config/dbcons.php');
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");

$user_data = $_SESSION['user_data'] ?? null;

if (!$user_data) {
    header("Location: login.php");
    exit();
}

$userId = $user_data['id'];
$total_price = 0;

// Fetch user details with unique user ID
$userQuery = "SELECT name, email, mobile_no, address, pincode FROM registration WHERE id = ?";
$userStmt = mysqli_prepare($con, $userQuery);
if (!$userStmt) {
    die("SQL error: " . mysqli_error($con)); // Show error if prepare fails
}
mysqli_stmt_bind_param($userStmt, 'i', $userId);
mysqli_stmt_execute($userStmt);
$userResult = mysqli_stmt_get_result($userStmt);
$userDetails = mysqli_fetch_assoc($userResult);

// Check if user details were retrieved
if (!$userDetails) {
    echo "<div class='alert alert-danger'>User details not found. Please contact support.</div>";
    exit();
}

// Check if there's a buyNow session variable
$directPurchase = $_SESSION['buyNow'] ?? null;

// Retrieve cart items for the logged-in user
$query = "SELECT uc.*, pd.* FROM user_cart uc JOIN p_details pd ON uc.product_id = pd.id WHERE uc.user_id = ?";
$stmt = mysqli_prepare($con, $query);
if (!$stmt) {
    die("SQL error: " . mysqli_error($con)); // Show error if prepare fails
}
mysqli_stmt_bind_param($stmt, 'i', $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo "<div class='alert alert-danger'>There was an issue retrieving your cart items. Please try again later.</div>";
    exit();
}

$cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);

// If there's a direct purchase, add it to the cart items
if ($directPurchase) {
    $cartItems[] = [
        'id' => $directPurchase['id'],
        'pdname' => $directPurchase['name'],
        'p_price' => $directPurchase['price'],
        'pd_image' => $directPurchase['image'],
        'quantity' => 1 // Set default quantity
    ];
    $total_price += $directPurchase['price']; // Add the direct purchase price to total
}

// Calculate total price for existing cart items
foreach ($cartItems as $item) {
    $total_price += $item['p_price'] * ($item['quantity'] ?? 1);
}
?>

<div class="container mt-5">
    <h2 class="text-center">Checkout</h2>
    <?php if ($userId && $userDetails): ?>
        <div class="mb-4" style="border: 1px solid #ddd; padding: 20px; border-radius: 5px; position: relative;">
    <h4>Your Profile Information</h4>
    <a href="edit_profile.php?user_data=<?php echo htmlspecialchars($userId); ?>" class="btn btn-warning" id="edit-profile-btn" style="position: absolute; top: 20px; right: 20px;">Edit Profile</a>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($userDetails['name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($userDetails['email']); ?></p>
    <p><strong>Mobile No.:</strong> <?php echo htmlspecialchars($userDetails['mobile_no']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($userDetails['address']); ?></p>
    <p><strong>Pincode:</strong> <?php echo htmlspecialchars($userDetails['pincode']); ?></p>
</div>

    <?php endif; ?>

    <?php if (!empty($cartItems)): ?>
        <h4>Your Cart Items:</h4>
        <ul class="list-group mb-4">
            <?php foreach ($cartItems as $item): ?>
                <li class="list-group-item d-flex align-items-center">
                    <div class="col-md-4">
                        <img src="<?php echo htmlspecialchars($item['pd_image']); ?>" class="img-fluid rounded-start"
                             alt="<?php echo htmlspecialchars($item['pdname']); ?>">
                    </div>
                    <div class="ml-3">
                        <h5><?php echo htmlspecialchars($item['pdname'] ?? 'Unnamed Product'); ?></h5>
                        <p>Price: ₹<?php echo htmlspecialchars($item['p_price'] ?? '0'); ?><br> Qty:
                            <?php echo htmlspecialchars($item['quantity'] ?? 1); ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <h4>Total Price: ₹<?php echo htmlspecialchars(number_format($total_price, 2)); ?></h4>

        <form action="process_checkout.php" method="post" class="mt-4">
            <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($total_price); ?>">
            <?php foreach ($cartItems as $item): ?>
                <input type="hidden" name="product_ids[]" value="<?php echo htmlspecialchars($item['id']); ?>">
                <input type="hidden" name="product_images[]" value="<?php echo htmlspecialchars($item['pd_image']); ?>">
                <input type="hidden" name="product_prices[]" value="<?php echo htmlspecialchars($item['p_price'] ?? '0'); ?>">
                <input type="hidden" name="quantities[]" value="<?php echo htmlspecialchars($item['quantity'] ?? 1); ?>">
                <input type="hidden" name="product_names[]"
                       value="<?php echo htmlspecialchars($item['pdname'] ?? 'Unnamed Product'); ?>">
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success btn-lg">Confirm Purchase</button>
        </form>
    <?php else: ?>
        <div class="alert alert-warning">Your cart is empty. You can proceed with the checkout or add items to your cart.</div>
        <a href="product_list.php" class="btn btn-primary">Browse Products</a>
    <?php endif; ?>
</div>

<?php
include("assets/e-commerce_includefile/footer.php");
?>


<?php
include("assets/e-commerce_includefile/footer.php");
?>
