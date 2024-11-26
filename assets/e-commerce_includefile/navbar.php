<!-- Navigation Bar -->

<style>
    .nav-link {
        display: flex;
        align-items: center;

    }

    .login-text {
        margin-left: 5px;

    }

    .nav-item {
        position: relative;

    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: brown;
        border: 1px solid #ccc;
    }

    .nav-item:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item:hover {
        background-color: #f1f1f1;

    }

    .dropdown-item {
        padding: 0px;
        text-decoration: none;
        color: black;
    }

    .dropdown-item.signup {
        margin-left: 5px;
    }

    .dropdown-items p a {
        margin: 0px 0px;
    }

    .caret {
        font-size: 0.8em;
        margin-left: 5px;
        transition: transform 0.3s ease;
    }

    .dropdown:hover .caret {
        transform: rotate(180deg);
    }

    .dropdown-item {
        font-family: Georgia, serif;
        margin-bottom: 5px;
    }

    .dropdown-items p a {
        margin-bottom: -15px;
    }
   
</style>



<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <a class="navbar-brand" href="e_commerce.php">ShopBrand</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
    <nav>
        <a class="nav-link" href="<?php echo isset($_SESSION['user_data']) ? 'user_profile.php' : 'login.php'; ?>">
            <i class="fa fa-user"></i>
            <span class="login-text">
                <?php
                if (isset($_SESSION['user_data'])) {
                    echo "(" . htmlspecialchars($_SESSION['user_data']['name']) . ")";
                } else {
                    echo "Login";
                }
                ?>
                <span class="caret">▼</span>
            </span>
        </a>
    </nav>
    <div class="dropdown-menu">
        <div class="dropdown-items">
            <?php if (isset($_SESSION['user_data'])): ?>
                <p><a class="dropdown-item" href="user_profile.php">My Profile</a></p>
                <hr>
                <p><a class="dropdown-item" href="our_order.php">Our Orders</a></p>
                <p><a class="dropdown-item" href="logout.php">Logout</a></p>
          <?php endif; ?>
          <p><a class="dropdown-item" href="user_signup.php">Signup</a></p>
            <p><a class="dropdown-item" href="cart.php">Our Cart</a></p>
          <p><a class="dropdown-item" href="edit_profile.php">Forgot Password</a></p>
          <p><a class="dropdown-item" href="admin_login.php">Admin Login</a></p>
        </div>
    </div>
</li>



            <li class="nav-item active">
                <a class="nav-link" href="cart.php">
                    <i class="fa fa-shopping-cart"></i><span class="login-text">Cart</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fa fa-store"></i><span class="login-text">Become a Seller</span>
                </a>
            </li>

        </ul>
    </div>
</nav>