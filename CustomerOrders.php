<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/CustomerOrder.css">
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
            <li><img src="images/Logo.png" height="55px" width="55px" alt="LOGO"></li>
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


    <h2>Your Order History</h2>
    <h3>ALL(2)</h3>
    
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Order-Date</th>
            <th>Price</th>
            <th>Paid-By</th>
            <th>&Tab;</th>
        </tr>
            
        <tr>
            <td><img src="image" width="200px" height="auto" alt="Image"></td>
            <td>Product-Name</td>
            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis nobis cupiditate suscipit atque praesentium nulla conseq.</td>
            <td>03/24/2024</td>
            <td>&pound; 200</td>
            <td><img src="images/paypal-logo.png" height="auto" width="100px" alt="PayPal"></td>
            <td><a href="#"><button class = "order-review-button">Review</button></a></td>
        </tr>
    </table>


    <?php
        
    
    ?>

</body>
</html>