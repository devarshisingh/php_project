<?php
session_start();
include("config/dbcons.php");
?>
<style>
    .card-img-top {
        transition: transform 0.3s ease;
    }

    .card-img-top:hover {
        transform: scale(1.1);
    }

    .card-body button {
        margin: 0px 10px;
    }

    .fixed-height {
        height: 30px;
        overflow: hidden;
    }

    .fixed-height-cards {
        height: 360px;
        overflow: hidden;
    }

    .name {
        font-family: Georgia, serif;
        margin-top: -20px;
    }

    .price-space {
        margin-left: 10px;
    }

    .price-space del {
        color: red;
        font-weight: bold;
    }

    .price {
        font-weight: bold;
    }

    .offer {
        color: darkcyan;
    }

    .color {
        color: darkcyan;
    }

    .card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .card p {
        margin-bottom: 3px;
        font-size: 14px;
    }

    .card {
        position: relative;
        overflow: hidden;
    }

    .card-body {
        position: relative;
        transition: transform 0.3s ease;
        background-color: white;
    }

    .card-body:hover {
        transform: translateY(-30px);
    }

    .card-text {
        transition: opacity 0.3s ease;
    }

    .card-body:hover .card-text {
        opacity: 1;
    }

    .card-text {
        opacity: 0.8;
    }

    .card-text {
        text-align: center;
        position: relative;
    }

    .pcn {
        margin-top: -20px;
    }

    .no-format {
        color: #8c8c8c;
    }
</style>
<?php
if (isset($_GET['product_ids']) && isset($_GET['category_id'])) {
    $pro_ids = $_GET['product_ids'];
    $category_id = $_GET['category_id'];

    $query = "SELECT * FROM p_details WHERE p_name='$pro_ids'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $serial = 1; // Initialize serial number
        echo '<div class="row">'; // Added row for cards
        foreach ($query_run as $row) {
            ?>
            <div class="col-md-3 mb-4">
                <div class="card fixed-height-cards">
                    <a href="views_all_details_of_product.php?product_id=<?php echo htmlspecialchars($row['id']); ?>">
                        <img src="<?php echo htmlspecialchars($row['pd_image']); ?>"
                             alt="<?php echo htmlspecialchars($row['p_name']); ?>" class="card-img-top"
                             style="height: 200px; object-fit: cover;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-text name fixed-height"><?php echo htmlspecialchars($row['pdname']); ?></h5>
                        <p class="card-text color"><?php echo htmlspecialchars($row['p_color']); ?></p>
                        <p class="card-text price">₹<?php echo htmlspecialchars($row['p_price']); ?>
                            <span class="price-space"><del>₹<?php echo htmlspecialchars($row['p_off_price']); ?></del></span>
                            <span class="price-space"><?php echo htmlspecialchars($row['p_p_discount']); ?> off</span>
                        </p>
                        <p class="card-text"><?php echo htmlspecialchars($row['p_size']); ?></p>
                        <p class="card-text"><?php echo htmlspecialchars($row['p_delivery']); ?></p>
                        <div class="d-flex justify-content-between">
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
            $serial++; // Increment serial number
        }
        echo '</div>'; // Closing row
    } else {
        echo '<div class="col-12"><div class="alert alert-warning">No Records Found</div></div>';
    }
}
?>
