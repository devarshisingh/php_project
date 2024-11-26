
<style>
    .second{
        background-color: aliceblue;
    border-top: 3px solid #dee2e6;
    border-bottom: 3px solid #dee2e6;
}
</style>

    

<div class="container-flued second">
    <center>
        <h2 class="filter-titles-index mt-3">Latest Products</h2>
    </center>
    <div class="row justify-content-center mt-5">
    <?php
    // Modify the query to order by the id in descending order
    $query = "SELECT * FROM p_details ORDER BY id DESC"; 
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            ?>
          <div class="col-md-2 mb-4 " style="margin-left: 10px;
     margin-right: 10px;"  >
    <div class="card fixed-height-card">
        <a href="views_all_details_of_product.php?product_id=<?php echo htmlspecialchars($row['id']); ?>">
            <img src="<?php echo htmlspecialchars($row['pd_image']); ?>"
                 alt="<?php echo htmlspecialchars($row['p_name']); ?>" class="card-img-top"
                 style="width: 100%; height: 200px;">
        </a>
        <div class="card-body">
            <center>
                <p class="card-text name">
                    <?php 
                    $nameWords = explode(' ', htmlspecialchars($row['pdname'])); // Split the name into words
                    $displayName = implode(' ', array_slice($nameWords, 0, 3)); // Get only the first 3 words
                    if (count($nameWords) > 3) {
                        $displayName .= '...'; 
                    }
                    echo $displayName; 
                    ?>
                </p>
                <p class="card-text price">
                    ₹<?php echo htmlspecialchars($row['p_price']); ?>
                    <span class="price-space">
                        <del>₹<?php echo htmlspecialchars($row['p_off_price']); ?></del>
                    </span>
                    <span class="price-space"><?php echo htmlspecialchars($row['p_p_discount']); ?> off</span>
                </p>
                <button class="btn btn-primary btn-sm" onclick="addToCart('<?php echo htmlspecialchars($row['id']); ?>')">Add to Cart</button>
                <?php if (isset($_SESSION['user_data'])): ?>
                    <button class="btn btn-success btn-sm" onclick="buyNow('<?php echo htmlspecialchars($row['id']); ?>')">Buy Now</button>
                <?php else: ?>
                    <button class="btn btn-success btn-sm" onclick="redirectToLogin()">Buy Now</button>
                <?php endif; ?>
                <p class="card-text offer"><?php echo htmlspecialchars($row['p_deal']); ?></p>
            </center>
        </div>
    </div>
</div>

            <?php
        }
    } else {
        ?>
        <div class="col-12">
            <div class="alert alert-warning">No Records Found</div>
        </div>
        <?php
    }
    ?>
</div>

    
</div>

<script>
    function redirectToLogin() {
        window.location.href = 'login.php';
    }

    function buyNow(productId) {
        window.location.href = 'buy_now.php?product_id=' + productId;
    }

    function addToCart(productId) {
        const userLoggedIn = <?php echo json_encode(isset($_SESSION['user_data'])); ?>;

        const data = new FormData();
        data.append('action', 'add_to_cart');
        data.append('product_id', productId);

        fetch('add_to_cart.php', {
            method: 'POST',
            body: data,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (userLoggedIn) {
                    window.location.href = 'user_profile.php';
                } else {
                    alert('Item added to temporary cart. You can view it in your cart.');
                    window.location.href = 'cart.php';
                }
            } else {
                alert('Failed to add item to cart: ' + (data.message || 'Unknown error.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
</script>

<?php
include("first.php");
?>
