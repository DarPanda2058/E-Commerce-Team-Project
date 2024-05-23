<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Products</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/Shop.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
       <?php include('nav.php');?>
       <?php include('connect.php'); ?>
    </header>
    <?php 
        $shop_id = $_GET['id'];
        $shop_name = $_GET['name'];
        $shop_query = "SELECT * FROM SHOP WHERE SHOP_ID = '$shop_id'";
        $shop_stmt = oci_parse($conn,$shop_query);
        oci_execute($shop_stmt);
        $shop_row = oci_fetch_assoc($shop_stmt);


        $product_query = "SELECT * FROM PRODUCT WHERE SHOP_ID = '$shop_id' AND PRODUCT_STATUS = 1";
        $product_stmt = oci_parse($conn,$product_query);
        oci_execute($product_stmt);
        $noofproducts = 5;
    ?>

    <center>
        <h1 class="title" style="font-size: 4rem;font-weight: 600;"><?php echo $shop_name; ?></h1>
        <h1>Products</h1>
        <hr width="5%">
    </center>

    <div class="headline">
        <div class="l-container">

            <?php 


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
                        <a href="<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'customer'){
                                echo 'Cart.php?product_id='.$row['PRODUCT_ID'].'';
                            }else{
                                echo 'login_register.php';
                            } ?>" class="btn add-to-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php $noofproducts--; } ?>
            
            <div class="allproduct">
                <button class="custom-btn btn-16"><a href="AllProduct.php?id=<?php echo $shop_id; ?>&name=<?php echo $shop_name; ?>">See More</a></button>
                <hr class="line-below-button">
            </div>
        </div>

    </div>
    <section class="about-butcher">
        <div class="about-container">
            <div class="b-game-card-rect">
                <div class="b-game-card__cover-rect" style="background-image: url(images/<?php echo $shop_row['SHOP_LOGO']; ?>);"></div>
            </div>
            <div class="about-text">
                <h2>About <?php echo $shop_name; ?></h2>
                <p><?php echo $shop_row['SHOP_CATEGORY']; ?></p>
                <p><?php echo $shop_row['SHOP_DESCRIPTION']; ?></p>
            </div>
        </div>
    </section>

    <!-- <center>
        <button class="custom-btn btn-16">Read More</button>
        <hr class="line-below-button">
    </center> -->
    
    <section class="trending">
        <div class="similar-products">
            <h1>Recommended by <?php echo $shop_row['SHOP_NAME'];?></h1>
            <p>Lorem ipsum dolor sit amet consectetur. Consectetur faucibus tristique eu magna curabitur.</p>
        </div>
        <div class="headline">
            <div class="l-container">

                <?php 
                    $product_query = "SELECT * FROM PRODUCT WHERE SHOP_ID = '$shop_id' AND PRODUCT_STATUS = 1 ORDER BY DBMS_RANDOM.VALUE";
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
<?php include('footer.html');?>
</body>
</html>