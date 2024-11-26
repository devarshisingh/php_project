<?php
session_start();
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");
include("config/dbcons.php");

$userId = $_SESSION['user_data']['id'] ?? null;

if ($userId) {
    $query = "SELECT uc.*, pd.pdname, pd.p_price, pd.pd_image FROM user_cart uc JOIN p_details pd ON uc.product_id = pd.id WHERE uc.user_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // Handle temp cart
    $temp_cart_items = $_SESSION['temp_cart'] ?? [];
    $cartItems = [];

    foreach ($temp_cart_items as &$item) {
        $productId = $item['id'];
        $query = "SELECT pdname, p_price, pd_image FROM p_details WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'i', $productId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $productDetails = mysqli_fetch_assoc($result);

        if ($productDetails) {
            $item['pdname'] = $productDetails['pdname'];
            $item['p_price'] = $productDetails['p_price'];
            $item['pd_image'] = $productDetails['pd_image'];
            $cartItems[] = $item; // Populate cartItems with details
        }
    }
}

$total_price = 0;
foreach ($cartItems as $item) {
    $item_price = isset($item['p_price']) ? floatval($item['p_price']) : 0;
    $item_quantity = isset($item['quantity']) ? intval($item['quantity']) : 1;
    $total_price += $item_price * $item_quantity;
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Your Cart</h2>

    <?php if (!empty($cartItems)): ?>
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($cartItems as $item): ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo htmlspecialchars($item['pd_image']); ?>" class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($item['pdname']); ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($item['pdname'] ?? 'Product Name Unavailable'); ?></h5>
                                    <p class="card-text">Price: ₹<?php echo htmlspecialchars($item['p_price'] ?? 'Price Unavailable'); ?></p>

                                    <form action="update_cart.php" method="post" class="update-cart-form">
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                        <div class="input-group mb-3" style="max-width: 200px;">
                                            <button type="button" class="btn btn-secondary" onclick="changeQuantity('<?php echo htmlspecialchars($item['id']); ?>', -1)">-</button>
                                            <input type="number" name="quantity" id="quantity-<?php echo htmlspecialchars($item['id']); ?>" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1" max="100" class="form-control text-center" onchange="updateTotal('<?php echo htmlspecialchars($item['id']); ?>', <?php echo htmlspecialchars($item['p_price']); ?>)">
                                            <button type="button" class="btn btn-secondary" onclick="changeQuantity('<?php echo htmlspecialchars($item['id']); ?>', 1)">+</button>
                                        </div>
                                        <input type="hidden" name="updated_price" id="price-<?php echo htmlspecialchars($item['id']); ?>" value="<?php echo htmlspecialchars($item['p_price']); ?>">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </form>

                                    <p class="card-text">Total: ₹<span id="total-<?php echo htmlspecialchars($item['id']); ?>"><?php echo htmlspecialchars($item['p_price'] * $item['quantity']); ?></span></p>

                                    <form action="update_cart.php" method="post" class="remove-item-form">
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                        <input type="hidden" name="quantity" value="0">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cart Total</h4>
                        <p class="card-text">Total Price: ₹<?php echo htmlspecialchars(number_format($total_price, 2)); ?></p>
                        
                        <?php if (isset($_SESSION['user_data'])): ?>
                            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                        <?php else: ?>
                            <a href="login.php?redirect=checkout" class="btn btn-success">Login to Checkout</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<script>
    function changeQuantity(productId, change) {
        const quantityInput = document.getElementById('quantity-' + productId);
        let newQuantity = parseInt(quantityInput.value) + change;
        if (newQuantity < 1) newQuantity = 1; 
        quantityInput.value = newQuantity; 
        updateTotal(productId, document.getElementById('price-' + productId).value); 
    }

    function updateTotal(productId, price) {
        const quantity = document.getElementById('quantity-' + productId).value;
        const total = price * quantity;
        document.getElementById('total-' + productId).innerText = total.toFixed(2); 
    }
</script>

<?php
include("assets/e-commerce_includefile/footer.php");
?>
