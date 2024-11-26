<?php
session_start();
include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");
include("config/dbcons.php");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown a {
        text-decoration: none;
        font-size: 15px;
        font-family: Georgia, serif;
        margin-bottom: 5px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        border-radius: 10px;
        min-width: 200px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    .dropdown:hover .dropdown-content {
        display: block;
        opacity: 1;
        visibility: visible;
    }

    .caret {
        font-size: 0.8em;
        margin-left: -5px;
        transition: transform 0.3s ease;
    }

    .dropdown:hover .caret {
        transform: rotate(180deg);
    }

    .hero {
        text-align: center;
        padding: 50px 0;
        background-color: #f8f9fa;
    }

    .cards-img-top {
        transition: transform 0.3s ease;
        width: 180px;
        /* Fixed width */
        height: 120px;
        /* Fixed height */
        object-fit: cover;
        /* Maintain aspect ratio */
    }

    .cards-img-top:hover {
        transform: scale(1.1);
    }
    .first{
        background-color: aliceblue;
    border-top: 2px solid #dee2e6;
    border-bottom: 2px solid #dee2e6;
    }
</style>

<div class="container-flued">
    <div class="row first">
        <?php
        $categoryQuery = "SELECT * FROM category_head";
        $categoryResult = mysqli_query($con, $categoryQuery);

        if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
            while ($categoryHead = mysqli_fetch_assoc($categoryResult)) {
                ?>
                <div class="col-sm-6 col-md-4 col-lg-2 mb-4">
                    <div class="text-center">
                        <img src="<?php echo htmlspecialchars($categoryHead['c_image']); ?>"
                            alt="<?php echo htmlspecialchars($categoryHead['c_h_name']); ?>" class="cards-img-top">
                        <div class="dropdown mt-2">
                            <span>
                                <h6 class="font-weight-bold">
                                    <?php echo htmlspecialchars($categoryHead['c_h_name']); ?> <span class="caret">▼</span>
                                </h6>
                            </span>
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
                                        <h6 class="p1">
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

        <div class="col-md-2 mb-4 m1">
            <?php
            $query = "SELECT * FROM category WHERE id = ?";
            $stmt = mysqli_prepare($con, $query);

            if ($stmt === false) {
                die("MySQL prepare error: " . htmlspecialchars(mysqli_error($con)));
            }

            $id = 47; // Change this to whatever ID you're interested in
            mysqli_stmt_bind_param($stmt, "i", $id);

            $executeResult = mysqli_stmt_execute($stmt);

            if ($executeResult === false) {
                die("MySQL execute error: " . htmlspecialchars(mysqli_stmt_error($stmt)));
            }

            $query_run = mysqli_stmt_get_result($stmt);

            if ($query_run && mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <img src="<?php echo htmlspecialchars($row['c_image']); ?>"
                        alt="<?php echo htmlspecialchars($row['c_name']); ?>" class="cards-img-top">
                    <h6 class="p11 text-center">
                        <strong> <a href="views_product.php?product_id=<?= intval($row['id']) ?>"
                                style="margin-top: 9px; display: inline-block; text-decoration:none;color:black;">
                                <?php echo htmlspecialchars($row['c_name']); ?>
                            </a></strong>
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

<!-- Hero Section -->
<div class="hero">
    <div class="container">
        <h1>Welcome to Our Store!</h1>
        <p>Find the best products at unbeatable prices.</p>
        <a href="#" class="btn btn-primary">Shop Now</a>
    </div>
</div>

<?php
include("assets/e-commerce_includefile/content.php");
include("assets/e-commerce_includefile/footer.php");
?>