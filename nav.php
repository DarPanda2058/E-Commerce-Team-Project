<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <?php
        include("connect.php");
        session_start();
    ?>
<header>
        <nav class="nav-bar">
            <ul class="menu">
                <?php
                    if($_SESSION['role'] == 'customer'){ 
                ?>
                    <li class="drop-hover">
                        <div class="category">
                            <a href="#">Categories </a><i class="fa fa-angle-down" aria-hidden="true"></i>
                            <ul class="drop-content">
                                <li><a href="#">Option 1</a></li>
                                <li><a href="#">Option 2</a></li>
                                <li><a href="#">Option 3</a></li>
                                <li><a href="#">Option 4</a></li>
                            </ul>
                        </div>
                        <div class="search-box">
                            <img src="images/search.png" width="30px" height="30px" alt="search button">
                            <input type="text" placeholder="Search">
                        </div>
                    </li>
                <?php } ?>
                <li><img src="images\logonotxt.png" height="55px" width="auto" alt="LOGO"></li>
                <li class="account">
                    <span class="user-name">Welcome, <?php echo ($_SESSION['fname']." ".$_SESSION['lname']);?></span>
                    <?php
                        if($_SESSION['role'] == 'customer'){ 
                    ?>
                        <div class="cart-container">
                            <img src="images/shopping-cart.png" width="25px" height="25px" alt="Cart">
                            <span>Cart</span>
                            <span id="items_in_cart"><?php echo $_SESSION['cartQuantity'];?></span>
                        </div>
                    <?php } ?>
                    <a href="<?php
                        if($_SESSION['role'] == 'customer'){
                            echo '#';
                        }else if($_SESSION['role'] == 'trader'){
                            echo 'ManageShop.php';
                        }else if($_SESSION['role'] == 'admin'){
                            echo'#';
                        }else{
                            echo'login_register.php';
                        }
                    ?>"><img src="images/user.png" height="40px" width="40px" alt="User"></a>
                </li>
            </ul>
        </nav>
</header>
</body>
</html>
