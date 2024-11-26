<?php
include("config/dbcons.php");
?>
<h2 class="text-center mb-4">Choose Product</h2>
<?php
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : PHP_INT_MAX;
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';

// Prepare the product query
$products_query = "SELECT * FROM p_details WHERE cats_name = ? AND p_price BETWEEN ? AND ?";
$products_stmt = mysqli_prepare($con, $products_query);

if ($products_stmt) {
    mysqli_stmt_bind_param($products_stmt, 'sdd', $category_id, $min_price, $max_price);
    mysqli_stmt_execute($products_stmt);
    $products_result = mysqli_stmt_get_result($products_stmt);

    if (mysqli_num_rows($products_result) > 0) {
        echo '<div class="row">'; // Start row for product cards
        foreach ($products_result as $product_row) {
            ?>
            <div class="col-md-3 mb-4">
                <div class="card fixed-height-cards">
                    <a href="views_all_details_of_product.php?product_id=<?php echo htmlspecialchars($product_row['id']); ?>">
                        <img src="<?php echo htmlspecialchars($product_row['pd_image']); ?>"
                             alt="<?php echo htmlspecialchars($product_row['pdname']); ?>" class="card-img-top"
                             style="height: 200px; object-fit: cover;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-text name fixed-heights"><?php echo htmlspecialchars($product_row['pdname']); ?></h5>
                        <p class="card-text color"><?php echo htmlspecialchars($product_row['p_color']); ?></p>
                        <p class="card-text price">₹<?php echo htmlspecialchars($product_row['p_price']); ?>
                            <span class="price-space"><del>₹<?php echo htmlspecialchars($product_row['p_off_price']); ?></del></span>
                            <span class="price-space"><?php echo htmlspecialchars($product_row['p_p_discount']); ?> off</span>
                        </p>
                        <p class="card-text"><?php echo htmlspecialchars($product_row['p_size']); ?></p>
                        <p class="card-text"><?php echo htmlspecialchars($product_row['p_delivery']); ?></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-sm"
                                    onclick="addToCart('<?php echo htmlspecialchars($product_row['id']); ?>')">Add to Cart</button>
                            <button class="btn btn-success btn-sm"
                                    onclick="buyNow('<?php echo htmlspecialchars($product_row['id']); ?>')">Buy Now</button>
                        </div>
                        <p class="card-text offer"><?php echo htmlspecialchars($product_row['p_deal']); ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        echo '</div>'; // Closing row
    } else {
        echo '<div class="alert alert-warning">No Products Found in this Price Range</div>';
    }
    mysqli_stmt_close($products_stmt);
} else {
    echo '<div class="alert alert-danger">Query preparation failed: ' . htmlspecialchars(mysqli_error($con)) . '</div>';
}
?>
