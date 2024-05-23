<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <?php
        include("connect.php");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
    ?>

        <nav class="nav-bar">
            <ul class="menu">
                <?php
                    if(!isset($_SESSION['role']) || ($_SESSION['role'] == 'customer')){ 
                ?>
                    <li class="drop-hover">
                        <div class="category">
                            <a href="#">Categories </a><i class="fa fa-angle-down" aria-hidden="true"></i>
                            <ul class="drop-content">
                                <li><a href="#">Butchery Tools and Meat</a></li>
                                <li><a href="#">Fruits and Vegetables</a></li>
                                <li><a href="#">Seafood</a></li>
                                <li><a href="#">Bread and Cakes</a></li>
                                <li><a href="#">Exotic Food</a></li>
                            </ul>
                        </div>
                        <div class="search-box">
                            <form class="nav-search" action="AllProduct.php" method="post">
                            <button type="submit" name="searchData" ><img src="images/search.png" width="30px" height="30px" alt="search button"></button>
                            <input type="text" name="search_content" placeholder="Search...." value="<?php
                                if(isset($_SESSION['search_content'])){
                                    echo $_SESSION['search_content'];
                                }
                            ?>">
                            </form>
                        </div>
                    </li>
                <?php } ?>
                <li class="nav-logo" ><a href="<?php 
                    if(isset($_SESSION['role']) && (($_SESSION['role'] == 'customer'))){
                        echo "main.php";
                    }else if(!isset($_SESSION['role'])){
                        echo "main.php";
                    }
                
                ?>"><img src="images\logonotxt.png" height="55px" width="auto" alt="LOGO"></a></li>
                <li class="account">
                    <?php if(isset($_SESSION['role'])){ ?>

                    <span class="user-name">Welcome, <?php echo ($_SESSION['fname']." ".$_SESSION['lname']);?></span>
                    <?php
                        if((isset($_SESSION['role']) && ($_SESSION['role'] == 'customer')) || (!isset($_SESSION['role']))){ 
                    ?>
                        <div class="cart-container">
                            <img src="images/shopping-cart.png" width="25px" height="25px" alt="Cart">
                            <span><a href="Shopping-cart.php">Cart</a></span>
                            <span id="items_in_cart"><?php echo $_SESSION['cartQuantity'];?></span>
                        </div>
                    <?php } ?>
                    <div class="user-menu">
                    <img src="images/user.png" height="40px" width="40px" alt="User Icon">
                    <div class="user-dropdown">
                        <a href="<?php
                            if($_SESSION['role'] == 'customer' || $_SESSION['role'] == 'trader' || $_SESSION['role'] == 'admin'){
                                echo "userProfile.php";
                            }
                        ?>">View Profile</a>
                        <?php
                            if($_SESSION['role'] == 'trader'){
                        ?>
                        <a href="ManageShop.php">Manage Your Shop</a>
                        <?php } ?>
                        <?php
                            if($_SESSION['role'] == 'admin'){
                        ?>
                        <a href="ManageProductAdmin.php">Manage Products</a>
                        <a href="ManageCustomer.php">Manage Customers</a>
                        <a href="ManageTrader.php">Manage Traders</a>
                        <?php } ?>

                        <a href="logout.php">Logout</a>
                    </div>
                </div>   

                    <?php } else{?>

                        <span class="user-name">Welcome, User</span>
                        <div class="cart-container">
                            <img src="images/shopping-cart.png" width="25px" height="25px" alt="Cart">
                            <span><a href="login_register.php">Cart</a></span>
                            <span id="items_in_cart">0</span>
                        </div>
                            <a href="login_register.php"><img src="images/user.png" height="40px" width="40px" alt="User Icon"></a>
                    <?php } ?>
                </li>
            </ul>
        </nav>

<script>
    document.querySelector('.user-menu img').addEventListener('click', function() {
        const dropdown = document.querySelector('.user-dropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    window.onclick = function(event) {
        if (!event.target.matches('.user-menu img')) {
            const dropdowns = document.getElementsByClassName('user-dropdown');
            for (let i = 0; i < dropdowns.length; i++) {
                const openDropdown = dropdowns[i];
                if (openDropdown.style.display === 'block') {
                    openDropdown.style.display = 'none';
                }
            }
        }
    }
</script>
</body>
</html>
