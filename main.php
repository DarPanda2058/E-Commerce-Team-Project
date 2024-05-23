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
        <h1 class="title" style="font-size: 4rem;font-weight: 600;">Headline</h1>
        <h1>Sub-headline</h1>
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
<hr class="line-below-button">
    <center>
        <div class="about-us">
            <h1>About Us</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime nostrum cum provident. Est debitis voluptatibus ab natus? Deleniti eos velit delectus magnam nemo? Voluptate fugit magni est aliquam, perspiciatis dignissimos?</p>
        </div>
        <hr class="line-below-button">
    </center>


    <?php include('footer.html'); ?>
    <script>
        $(document).ready(function(){
            $('#itemslider').carousel({ interval: 3000 });

            $('.carousel-showmanymoveone .item').each(function(){
                var itemToClone = $(this);

                for (var i=1; i<6; i++) {
                    itemToClone = itemToClone.next();

                    if (!itemToClone.length) {
                        itemToClone = $(this).siblings(':first');
                    }

                    itemToClone.children(':first-child').clone()
                        .addClass("cloneditem-" + (i))
                        .appendTo($(this));
                }
            });
        });
    </script>
</body>
</html>
