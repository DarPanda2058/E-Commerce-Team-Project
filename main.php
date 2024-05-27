<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        
        <?php 

            include('nav.php'); 
            if(isset($_SESSION['search_content']) && !is_null($_SESSION['search_content'])){
                $_SESSION['search_content'] = null;
            }
            include('connect.php');
        ?>
    </header>

    <center>
        <h1 class="title" style="font-size: 4rem;font-weight: 600;">Welcome to The Huddle Hub</h1>
        <h1 style="font-size: 20px;" >Your one-stop shop for all your grocery needs.</h1>
        <hr width="5%">
    </center>
    <div class="headline">
        <div class="l-container">

            <?php 
                $product_query = "SELECT * FROM PRODUCT WHERE PRODUCT_STATUS = 1";
                $product_stmt = oci_parse($conn,$product_query);
                oci_execute($product_stmt);
                $noofproducts = 10;

                while(($row = oci_fetch_assoc($product_stmt)) && $noofproducts>0 ){
            ?>
            <div class="product">
                <div class="product-image" style="background-image: url(images/<?php echo $row['PRODUCT_IMAGE'] ?>);"></div>
                <div class="product-info">
                    <h2><?php echo $row['PRODUCT_NAME'] ?></h2>
                    <p class="price">&pound;<?php echo $row['PRODUCT_PRICE'] ?></p>
                    <p class="descr"><?php echo $row['PRODUCT_DETAILS'] ?></p>
                    <div class="product-buttons">
                        <a href="ProductPage.php?id=<?php echo $row['PRODUCT_ID'] ;?>" class="btn buy">Buy</a>
                        <a href="<?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'customer')){
                               echo 'Cart.php?product_id='.$row['PRODUCT_ID'].'';
                            }else{
                                echo 'login_register.php';
                            } ?>" class="btn add-to-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php $noofproducts--; } ?>
            
            <div class="allproduct">
                <button class="custom-btn btn-16"><a href="AllProduct.php">See More</a></button>

            </div>
            <hr class="line-below-button">
        </div>

    </div>


    <div class="container-fluid">
        <h1 align = 'center'>Shop</h1>
        <hr>
        <div class="headline">
            <div class="l-container">

                <?php 
                    $shop_query = "SELECT * FROM SHOP";
                    $shop_stmt = oci_parse($conn,$shop_query);
                    oci_execute($shop_stmt);

                    while(($row = oci_fetch_assoc($shop_stmt))){
                ?>
                <div class="product" style="flex: 30%;">
                <div class="product-image" style="background-image: url(images/<?php echo $row['SHOP_LOGO'] ?>);"></div>
                    <div class="product-info">
                        <h2><?php echo $row['SHOP_NAME'] ?></h2>
                        <p class="price"><?php echo $row['SHOP_CATEGORY'] ?></p>
                        <p class="descr"><?php echo $row['SHOP_STATUS'] ?></p>
                        <div class="product-buttons">
                            <a href="Shop.php?id=<?php echo $row['SHOP_ID']; ?>&name=<?php echo $row['SHOP_NAME'] ;?>" class="btn buy">Visit Now</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

        </div>
    </div>

    <hr> 

    <section class="trending">
        <h1 style="width: 40%;">Trending</h1>
        <div class="headline">
            <div class="l-container">

                <?php 
                    $product_query = "SELECT * FROM PRODUCT WHERE PRODUCT_STATUS = 1 ORDER BY DBMS_RANDOM.VALUE";
                    $product_stmt = oci_parse($conn,$product_query);
                    oci_execute($product_stmt);
                    $noofproducts = 6;

                    while(($row = oci_fetch_assoc($product_stmt)) && $noofproducts>0 ){
                ?>
                <div class="product" id ="product-trending">
                    <div class="product-image" style="background-image: url(images/<?php echo $row['PRODUCT_IMAGE'] ?>);"></div>
                    <div class="product-info">
                        <h2><?php echo $row['PRODUCT_NAME'] ?></h2>
                        <p class="price">&pound;<?php echo $row['PRODUCT_PRICE'] ?></p>
                        <p class="descr"><?php echo $row['PRODUCT_DETAILS'] ?></p>
                        <div class="product-buttons">
                            <a href="ProductPage.php?id=<?php echo $row['PRODUCT_ID'] ;?>" class="btn buy">Buy</a>
                            <a href="<?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'customer')){
                                echo 'Cart.php?product_id='.$row['PRODUCT_ID'].'';
                            }else{
                                echo 'login_register.php';
                            } ?>" class="btn add-to-cart">Add to Cart</a>
                        </div>
                    </div>
                </div>
                <?php $noofproducts--; } ?>
            </div>

        </div>
    </section>

<hr> 
<br><br>
    <section class="about-butcher" id="about-us">
        <div class="about-container">
            <div class="b-game-card-rect">
                <div class="b-game-card__cover-rect" style="background-image: url(images/logo.png);"></div>
            </div>
            <div class="about-text">
                <h2>About Us</h2>
                <p>Welcome to The Huddle Hub! Our passionate team—Darpan Pandey, Shreyash Parajuli, Dajeel Dulal, Atit Dahal, Suchita Acharya, and Anisha Giri—works tirelessly to bring you the freshest groceries and exceptional service. We're dedicated to making your shopping experience seamless and enjoyable. Thank you for choosing The Huddle Hub!</p>
            </div>
        </div>
    </section>
    <hr>


    <?php include('footer.html'); ?>

</body>
</html>
