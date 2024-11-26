<?php
session_start();

include("assets/e-commerce_includefile/navbar.php");
include("assets/e-commerce_includefile/header.php");
?>

<div class="container mt-5">
    <h2>Your Cart</h2>
    <?php
    if (!empty($_SESSION['buyNow'])) {
        $item = $_SESSION['buyNow']; 
        echo "<div class='card mb-4'>"; 
        echo "<div class='row no-gutters'>";
        echo "<div class='col-md-4'>";
        echo "<img src='" . htmlspecialchars($item['image']) . "' class='card-img' alt='" . htmlspecialchars($item['name']) . "' style='height:100%; object-fit:cover;'>"; // Ensure image fits nicely
        echo "</div>";
        echo "<div class='col-md-8'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . htmlspecialchars($item['name']) . "</h5>";
        echo "<p class='card-text'>Price: ₹" . htmlspecialchars($item['price']) . "</p>";
        echo "<p class='card-text'>Discount: " . htmlspecialchars($item['discount']) . "</p>";

        
        if (!empty($item['poffprice'])) {
            echo "<p class='card-text'><del>Original Price: ₹" . htmlspecialchars($item['poffprice']) . "</del></p>";
        } else {
            echo "<p class='card-text'>Original Price: —</p>"; 
        }

        echo "<p class='card-text'>Color: " . htmlspecialchars($item['color']) . "</p>";
        echo "<p class='card-text'>Size: " . htmlspecialchars($item['size']) . "</p>";
        echo "<p class='card-text'>Delivery: " . htmlspecialchars($item['delivery']) . "</p>";
        echo "<p class='card-text'>Deal: " . htmlspecialchars($item['deal']) . "</p>";
        
       
        echo "<form method='POST' action=''>"; 
        echo "<input type='hidden' name='item_id' value='" . htmlspecialchars($item['id']) . "'>";
        echo "<button type='submit' name='cash_on_delivery' class='btn btn-danger'>Order Now</button>";
        echo "</form>";
        
        echo "</div>"; 
        echo "</div>"; 
        echo "</div>"; 
        echo "</div>"; 
    } else {
        echo "<div class='alert alert-warning'>Your cart is empty.</div>";
    }
    ?>
</div>

<?php
include("assets/e-commerce_includefile/footer.php");
?>
