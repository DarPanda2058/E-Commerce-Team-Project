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
                    if(!isset($_SESSION['role']) || !($_SESSION['role'] == 'trader')){ 
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
                <li class="nav-logo" ><a href="<?php 
                    if(isset($_SESSION['role']) && (($_SESSION['role'] == 'customer')||($_SESSION['role']=='admin'))){
                        echo "main.php";
                    }else if(!isset($_SESSION['role'])){
                        echo "main.php";
                    }
                
                ?>"><img src="images\logonotxt.png" height="55px" width="auto" alt="LOGO"></a></li>
                <li class="account">
                    <?php if(isset($_SESSION['role'])){ ?>

                    <span class="user-name">Welcome, <?php echo ($_SESSION['fname']." ".$_SESSION['lname']);?></span>
                    <?php
                        if(isset($_SESSION['role']) && ($_SESSION['role'] == 'customer')){ 
                    ?>
                        <div class="cart-container">
                            <img src="images/shopping-cart.png" width="25px" height="25px" alt="Cart">
                            <span>Cart</span>
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
                        <a href="logout.php">Logout</a>
                    </div>
                </div>   

                    <?php } else{?>

                        <span class="user-name">Welcome, User</span>
                        <div class="cart-container">
                            <img src="images/shopping-cart.png" width="25px" height="25px" alt="Cart">
                            <span>Cart</span>
                            <span id="items_in_cart"><?php echo $_SESSION['cartQuantity'];?></span>
                        </div>
                            <a href="login_register.php"><img src="images/user.png" height="40px" width="40px" alt="User Icon"></a>
                    <?php } ?>
                </li>
            </ul>
        </nav>
</header>
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
