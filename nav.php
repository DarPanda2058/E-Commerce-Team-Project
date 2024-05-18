<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
<nav class="nav-bar">
    <ul class="menu">
        <li class="drop-hover">
            <div class="category">
                <a href="">Categories <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                <ul class="drop-content">
                    <li><a href="">Option 1</a></li>
                    <li><a href="">Option 2</a></li>
                    <li><a href="">Option 3</a></li>
                </ul>
            </div>
            <div class="search-box">
                <img src="images/search.png" width="30px" height="30px" alt="search button">
                <input type="text" placeholder="  Search">
            </div>
        </li>
        <li><img src="images/logo.png" height="55px" width="55px" alt="LOGO"></li>
        <li class="account">
            <span>Welcome User</span>
            <div class="cart-container">
                <img src="images/shopping-cart.png" width="25px" height="25px" alt="Cart">
                <span>Cart</span>
                <span id="items_in_cart">1</span>
            </div>
            <img src="images/user.png" height="40px" width="40px" alt="">
        </li>
    </ul>
</nav>
</body>
</html>
