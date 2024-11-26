<?php
session_start();
include("assets/e-commerce_includefile/header.php");
include("config/dbcons.php");
?>

<h2 class="text-center filter-titles mb-4">CHOOSE PRODUCT</h2>
<?php
if (isset($_GET['product_ids']) && isset($_GET['category_id'])) {
    $pro_ids = $_GET['product_ids'];
    $category_id = $_GET['category_id'];

    // Prevent SQL injection by using prepared statements
    $query = "SELECT * FROM p_details WHERE p_name = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $pro_ids);
        mysqli_stmt_execute($stmt);
        $query_run = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($query_run) > 0) {
            echo '<div class="row">'; // Start row for product cards
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                <div class="col-md-3 mb-4">
                    <div class="card fixed-height-cards">
                        <a href="views_all_details_of_product.php?product_id=<?php echo htmlspecialchars($row['id']); ?>">
                            <img src="<?php echo htmlspecialchars($row['pd_image']); ?>"
                                 alt="<?php echo htmlspecialchars($row['p_name']); ?>" class="card-img-top"
                                 style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-text name fixed-heights"><?php echo htmlspecialchars($row['pdname']); ?></h5>
                            <p class="card-text color"><?php echo htmlspecialchars($row['p_color']); ?></p>
                            <p class="card-text price">₹<?php echo htmlspecialchars($row['p_price']); ?>
                                <span class="price-space"><del>₹<?php echo htmlspecialchars($row['p_off_price']); ?></del></span>
                                <span class="price-space"><?php echo htmlspecialchars($row['p_p_discount']); ?> off</span>
                            </p>
                            <p class="card-text"><?php echo htmlspecialchars($row['p_size']); ?></p>
                            <p class="card-text"><?php echo htmlspecialchars($row['p_delivery']); ?></p>
                            <div class="d-flex  justify-content-between">
                                <button class="btn btn-primary btn-sm"
                                        onclick="addToCart('<?php echo htmlspecialchars($row['id']); ?>')">Add to Cart</button>
                                <button class="btn btn-success btn-sm"
                                        onclick="buyNow('<?php echo htmlspecialchars($row['id']); ?>')">Buy Now</button>
                            </div>
                            <p class="card-text offer"><?php echo htmlspecialchars($row['p_deal']); ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo '</div>'; // Closing row
        } else {
            echo '<div class="alert alert-warning">No Records Found</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Database error: ' . htmlspecialchars(mysqli_error($con)) . '</div>';
    }
} else {
    echo '<div class="alert alert-warning">Invalid Request</div>';
}

include("views_css_products.php");
?>



</body>
</html>
