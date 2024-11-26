<style>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    .link1 a {
        color: aliceblue;
        text-decoration: none;
    }

    .p2 a {
        text-decoration: none;
        text-align: center;
    }

    .card-img-top {
        transition: transform 0.3s ease;
    }

    .card-img-top:hover {
        transform: scale(1.1);
    }

    .card-body button {
        margin: 0px 10px;
    }
    .a11 button {
        margin: 0px 9px;
    }
    .fixed-heights {
        height: 24px;
        overflow: hidden;
    }

    .fixed-height-cards {
        height: 358px;
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
        margin-bottom: 1px;
        font-size: 14px;
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
        text-align: center;
        position: relative;
    }

    .filter-sidebar {
        background-color: #f8f9fa;
         border-left: 2px solid #dee2e6;
        border-right: 2px solid #dee2e6;
        border-bottom: 2px solid #dee2e6;
        border-radius: 0;
        padding: 20px;
    }


    .product-displays {
        background-color: ;
        padding: 10px;
        min-height: 100vh;
        border-left: 2px solid #dee2e6;
        border-right: 2px solid #dee2e6;
        border-bottom: 2px solid #dee2e6;
    }

    .filter-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .filter-titles {
        font-size: 1.8rem;
        font-weight: bold;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }
    .fixed-width-col {
    width: 200px; /* Set your desired fixed width */
}

    .dropdown {
        position: relative;
        display: inline-block;
       
    }
    body {
        margin: 0;
        padding:auto;
    }
    .dropdown a {
        text-decoration: none;
        font-size: 15px;
        font-family: Georgia, serif;
        margin-bottom: 5px;
        margin-right: 10px;
    }

    .dropdown-content {
      
        display: none;
        position: absolute;
        background-color: aliceblue;
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

    .bgr {
        background-color: aliceblue;
        border-top: 2px solid #dee2e6;
    }

</style>
<script>
    let currentBrandId = null; // Variable to track the currently selected brand

    function loadProducts(productId, categoryId) {
        if (currentBrandId === productId) {
            return; // If the brand is already selected, do nothing
        }

       
        adjustColumnWidth();
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'views_product_details.php?product_ids=' + productId + '&category_id=' + categoryId, true);
        xhr.onload = function () {
            if (this.status === 200) {
                document.getElementById('product-container').innerHTML = this.responseText; // Update product display
            } else {
                console.error('Failed to load products');
            }
        };
        xhr.send();
    }
    function adjustColumnWidth() {
    const brandSection = document.querySelector('.filter-sidebar'); // Your sidebar element
    const productContainer = document.getElementById('product-container'); // Your product display area

    
}


    function filterProducts() {
        const minPrice = document.getElementById('min-price').value || 0;
        const maxPrice = document.getElementById('max-price').value || Number.MAX_VALUE;
        const categoryId = '<?php echo htmlspecialchars($_GET['product_id'] ?? ''); ?>';

        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'filter_products.php?min_price=' + minPrice + '&max_price=' + maxPrice + '&category_id=' + categoryId, true);
        xhr.onload = function () {
            if (this.status === 200) {
                document.getElementById('product-container').innerHTML = this.responseText; // Update product display
            } else {
                console.error('Failed to load filtered products');
            }
        };
        xhr.send();
    }

    const userLoggedIn = <?php echo json_encode(isset($_SESSION['user_data'])); ?>;

    function redirectToLogin() {
        window.location.href = 'login.php';
    }

    function buyNow(productId) {
        if (userLoggedIn) {
            // Redirect to checkout.php with the product ID
            window.location.href = 'checkout.php?product_id=' + productId;
        } else {
            redirectToLogin(); // Redirect to login if not logged in
        }
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
                    alert('Item added to cart. Quantity updated.');
                    if (userLoggedIn) {
                        window.location.href = 'user_profile.php';
                    } else {
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