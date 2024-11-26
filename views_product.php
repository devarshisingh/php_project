<?php
session_start();
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");
include("config/dbcons.php");
?>


<div class="container-fluid">
    <div class="row  bgr">
        <?php
        $categoryQuery = "SELECT * FROM category_head";
        $categoryResult = mysqli_query($con, $categoryQuery);

        if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
            while ($categoryHead = mysqli_fetch_assoc($categoryResult)) {
                ?>
                <div class="col-sm-6 col-md-4 col-lg-2 mb-2">
                    <div class="text-center">
                        <div class="dropdown mt-2">
                            <div style="display: flex; align-items: center;">
                                <h6 class="font-weight-bold" style="margin-right: 15px;">
                                    <?php echo htmlspecialchars($categoryHead['c_h_name']); ?>
                                </h6>
                                <span class="caret">▼</span>
                            </div>

                            <div class="dropdown-content">
                                <?php
                                $query = "SELECT * FROM category WHERE c_h_names = ?";
                                $stmt = mysqli_prepare($con, $query);
                                mysqli_stmt_bind_param($stmt, "s", $categoryHead['id']);
                                mysqli_stmt_execute($stmt);
                                $query_run = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                        <h6 class="p1" style="margin-bottom: 5px;">
                                            <a href="views_product.php?product_id=<?= intval($row['id']) ?>">
                                                <?php echo htmlspecialchars($row['c_name']); ?>
                                            </a>
                                        </h6>
                                        <?php
                                    }
                                } else {
                                    echo "<p>No subcategories found.</p>";
                                }

                                mysqli_stmt_close($stmt);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="col-md-12"><h6>No categories found.</h6></div>';
        }
        ?>

        <!-- Additional Categories -->
        <?php
        $additionalIds = [47, 70, 49]; // IDs of additional categories
        foreach ($additionalIds as $id) {
            $query = "SELECT * FROM category WHERE id = ?";
            $stmt = mysqli_prepare($con, $query);

            if ($stmt === false) {
                die("MySQL prepare error: " . htmlspecialchars(mysqli_error($con)));
            }

            mysqli_stmt_bind_param($stmt, "i", $id);
            $executeResult = mysqli_stmt_execute($stmt);

            if ($executeResult === false) {
                die("MySQL execute error: " . htmlspecialchars(mysqli_stmt_error($stmt)));
            }

            $query_run = mysqli_stmt_get_result($stmt);

            if ($query_run && mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <div class="col-md-2 mt-2 m1" style="margin-bottom: 10px;">
                        <h6 class="p11 text-center">
                            <strong>
                                <a href="views_product.php?product_id=<?= intval($row['id']) ?>"
                                    style="display: inline-block; text-decoration:none; color:black;">
                                    <?php echo htmlspecialchars($row['c_name']); ?>
                                </a>
                            </strong>
                        </h6>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-md-2 mb-4 m1'><p>No subcategories found.</p></div>";
            }

            mysqli_stmt_close($stmt);
        }
        ?>
    </div>
</div>





<div class="container-fluid mt-2">
    <div class="row d-flex">
        <div class="col-md-2 fixed-width-col mx-2 bg-light filter-sidebar">
            <h4 class="text-center filter-title mb-4">Filter</h4>
            <hr>

            <h5 class="text-center mb-4">Category</h5>
            <div class="list-group">
                <?php
                // Assume you already have a connection to the database
                if (isset($_GET['product_id'])) {
                    $productId = intval($_GET['product_id']); // Get the product ID from the URL
                
                    // Fetch product details based on product_id
                    $productQuery = "SELECT * FROM category WHERE id = ?";
                    $stmt = mysqli_prepare($con, $productQuery);
                    mysqli_stmt_bind_param($stmt, "i", $productId);
                    mysqli_stmt_execute($stmt);
                    $productResult = mysqli_stmt_get_result($stmt);

                    if ($productResult && mysqli_num_rows($productResult) > 0) {
                        while ($row = mysqli_fetch_assoc($productResult)) {
                            ?>
                            <a href="views_product.php?product_id=<?= intval($row['id']) ?>"
                                class="list-group-item list-group-item-action text-uppercase text-dark">
                                <?= htmlspecialchars($row['c_name']); ?>
                            </a>
                            <?php
                        }
                    } else {
                        echo '<div class="alert alert-warning text-center">No category found with this ID.</div>';
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo '<div class="alert alert-warning text-center">No product selected.</div>';
                }
                ?>
            </div>

            <h5 class="text-center mt-4 mb-4">Brand</h5>
            <?php
            if (isset($_GET['product_id'])) {
                $pro_id = $_GET['product_id'];
                $query = "SELECT * FROM c_product WHERE cat_name = ?";
                $stmt = mysqli_prepare($con, $query);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 's', $pro_id);
                    mysqli_stmt_execute($stmt);
                    $query_run = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($query_run) > 0) {
                        echo '<div class="list-group">';
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <a href="javascript:void(0);"
                                onclick="loadProducts('<?= htmlspecialchars($row['id']) ?>', '<?= htmlspecialchars($row['cat_name']) ?>')"
                                class="list-group-item list-group-item-action">
                                <?= htmlspecialchars($row['p_name']); ?>
                            </a>
                            <?php
                        }
                        echo '</div>';
                    } else {
                        echo '<div class="alert alert-warning">No Brands Found</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Database error: ' . htmlspecialchars(mysqli_error($con)) . '</div>';
                }
            } else {
                echo '<div class="alert alert-warning">No Category Selected</div>';
            }
            ?>

            <!-- Price Filter Section -->
            <h5 class="text-center mb-2 mt-4">Price</h5>
            <form id="price-filter-form" onsubmit="return false;">
                <div class="form-group">
                    <label for="min-price">Min Price:</label>
                    <input type="number" name="min_price" id="min-price" class="form-control" placeholder="0" min="0">
                </div>
                <div class="form-group">
                    <label for="max-price">Max Price:</label>
                    <input type="number" name="max_price" id="max-price" class="form-control" placeholder="100000"
                        min="0">
                </div>
                <input type="hidden" name="product_id"
                    value="<?php echo htmlspecialchars($_GET['product_id'] ?? ''); ?>">
                <button type="button" class="btn btn-primary btn-block" onclick="filterProducts()">Search Product</button>
            </form>
        </div>




        <div class="col bg-light product-displays mr-2" id="product-container">
            <h2 class="text-center filter-titles mb-4">CHOOSE PRODUCT</h2>
            <?php
            $cat_name = isset($_GET['product_id']) ? $_GET['product_id'] : '';

            $products_query = "SELECT * FROM p_details WHERE cats_name = ?";
            $products_stmt = mysqli_prepare($con, $products_query);

            if ($products_stmt) {
                mysqli_stmt_bind_param($products_stmt, 's', $cat_name);
                mysqli_stmt_execute($products_stmt);
                $products_result = mysqli_stmt_get_result($products_stmt);

                if (mysqli_num_rows($products_result) > 0) {
                    echo '<div class="row">';
                    foreach ($products_result as $product_row) {
                        ?>
                        <div class="col-md-3 mb-4">
                            <div class="card fixed-height-cards">
                                <a
                                    href="views_all_details_of_product.php?product_id=<?php echo htmlspecialchars($product_row['id']); ?>">
                                    <img src="<?php echo htmlspecialchars($product_row['pd_image']); ?>"
                                        alt="<?php echo htmlspecialchars($product_row['pdname']); ?>" class="card-img-top"
                                        style="height: 200px; object-fit: cover;">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-text name fixed-heights"><?php echo htmlspecialchars($product_row['pdname']); ?>
                                    </h5>
                                    <p class="card-text color"><?php echo htmlspecialchars($product_row['p_color']); ?></p>
                                    <p class="card-text price">₹<?php echo htmlspecialchars($product_row['p_price']); ?>
                                        <span
                                            class="price-space"><del>₹<?php echo htmlspecialchars($product_row['p_off_price']); ?></del></span>
                                        <span class="price-space"><?php echo htmlspecialchars($product_row['p_p_discount']); ?>
                                            off</span>
                                    </p>
                                    <p class="card-text"><?php echo htmlspecialchars($product_row['p_size']); ?></p>
                                    <p class="card-text"><?php echo htmlspecialchars($product_row['p_delivery']); ?></p>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-primary btn-sm"
                                            onclick="addToCart('<?php echo htmlspecialchars($product_row['id']); ?>')">Add to Cart
                                        </button>
                                        <button class="btn btn-success btn-sm"
                                            onclick="buyNow('<?php echo htmlspecialchars($product_row['id']); ?>')">Buy Now
                                        </button>
                                    </div>
                                    <p class="card-text offer"><?php echo htmlspecialchars($product_row['p_deal']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-warning">No Products Found in Category ' . htmlspecialchars($cat_name) . '</div>';
                }
                mysqli_stmt_close($products_stmt);
            } else {
                echo '<div class="alert alert-danger">Query preparation failed: ' . htmlspecialchars(mysqli_error($con)) . '</div>';
            }
            ?>
        </div>
    </div>
</div>





<?php
include("views_css_products.php");
include("assets/e-commerce_includefile/footer.php");
?>