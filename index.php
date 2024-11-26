<?php
include("config/dbcons.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Card Example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <center><h2>Choose Category</h2></center><br>
        <div class="row">
            <?php
            $query = "SELECT * FROM category";
            $query_run = mysqli_query($con, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $row) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                        <?php ($row['id']); ?>
                            <img 
                                src="<?php echo htmlspecialchars($row['c_image']); ?>" 
                                alt="<?php echo htmlspecialchars($row['c_name']); ?>" 
                                class="card-img-top" 
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['c_name']); ?></h5>
                                <p class="card-text">Description of the category.</p>
                                <a href="views_product.php?product_id=<?=$row['id']?>" class="btn btn-primary">View Product</a>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
