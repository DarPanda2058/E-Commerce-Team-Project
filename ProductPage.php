<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/ProductPage.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>Product</title>
    </head>
<body>
    <?php 
        include("nav.php");
        include('connect.php');

        function printStars($rating) {
            $stars = '';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $rating) {
                    $stars .= '<span class="star">&#9733;</span>'; // Full star
                } else {
                    $stars .= '<span class="star">&#9734;</span>'; // Empty star
                }
            }
            echo $stars;
        }


        $product_id = $_GET['id'];
        $product_query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
        $product_stmt = oci_parse($conn,$product_query);
        oci_execute($product_stmt);
        $product_row = oci_fetch_assoc($product_stmt);
        $shop_id = $product_row['SHOP_ID'];
        $max_limit = $product_row['PRODUCT_MAX_LIMIT'];
        $quantity = $product_row['PRODUCT_QUANTITY'];

        $reviewselectquery = "SELECT 
                                COUNT(*) AS TOTAL, 
                                ROUND(AVG(REVIEW_RATING)) AS RATING
                                FROM 
                                    REVIEW
                                WHERE 
                                    product_id = '$product_id'";
        $reviewselectstmt = oci_parse($conn,$reviewselectquery);
        oci_execute($reviewselectstmt);

        $totalreviewrow=oci_fetch_assoc($reviewselectstmt);
        $totalreviews = $totalreviewrow['TOTAL'];
        $avgrating = $totalreviewrow['RATING'];


    ?>
    <div class="product-container">
        <div class="product-image">
            <img src="images/<?php echo $product_row['PRODUCT_IMAGE'] ; ?>" alt="Product Image">
        </div>
        <div class="product-details">
            <h2><?php echo $product_row['PRODUCT_NAME'] ; ?></h2>
            <div class="star-rating" style="align-items:center">
                <p class="small-font"><?php printStars($avgrating) ?></p>
                <p class="small-font"><?php echo $totalreviews ?> Reviews</p>
                <a href='wishlistadd.php?product_id=<?php echo $product_id; ?>' class="wishlist-btn">❤</a>
            </div>
            <hr>
            <p class="description"><?php echo $product_row['PRODUCT_DETAILS'] ; ?></p>
            <div class="quantity-price">
                <div class="quantity">
                    <button class="quantity-plus">&nbsp;+</button>
                    <span class="quantity-value" id="quantity-value">1</span>
                    <button class="quantity-minus">-&nbsp;</button>
                </div>
                <p class="stock-status" id="<?php 
                    $product_quantity = $product_row['PRODUCT_QUANTITY'];
                if($product_quantity > 0){
                    echo "green";
                }else{
                    echo "red";
                } ?>"><?php if($product_row['PRODUCT_QUANTITY']>0){
                    echo "In Stock";
                }else{
                    echo "Out Of Stock";
                } ?></p>
                <p class="price">&pound;<?php echo $product_row['PRODUCT_PRICE']; ?></p>
            </div>
            <div class="buy-cart-buttons">
                <a id="buy-now-link" href="<?php if(!isset($_SESSION['id'])){
                    echo 'login_register.php';
                }else{
                    echo 'Cart.php?product_id='.$product_id.'&buynow=1'.'&product_quantity=1';
                } ?>"><button id="buy-now-button" >BUY NOW</button></a>
                <a id="add-to-cart-link" href="<?php if(!isset($_SESSION['id'])){
                    echo 'login_register.php';
                }else{
                    echo 'Cart.php?product_id='.$product_id.'&product_quantity=1';
                } ?>"><button id="add-to-cart-button">ADD TO CART</button></a>
            </div>
        </div>
    </div>
    <h2 class="sub-section" style="margin-bottom: 50px;" >More By Shop</h2>
    <div class="l-container">
        <?php 
            $recommendquery = "SELECT * FROM PRODUCT WHERE SHOP_ID = '$shop_id' ";
            $recommendstmt = oci_parse($conn,$recommendquery);
            oci_execute($recommendstmt);
            $iter = 5;
            while(($row = oci_fetch_assoc($recommendstmt)) && $iter>0){
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
        <?php $iter--; } ?>
    </div>
    <br>
    <h2 class="sub-section">Reviews</h2>
    <div class="review-container">
        <?php 

            $reviewdataquery = "SELECT r.REVIEW_DESC,r.REVIEW_RATING,u.USER_FIRST_NAME,u.USER_LAST_NAME,u.USER_IMAGE 
                                FROM REVIEW r 
                                JOIN USERS u ON u.USER_ID = r.USER_ID
                                WHERE r.PRODUCT_ID = '$product_id'";
            $reviewdatastmt = oci_parse($conn,$reviewdataquery);
            oci_execute($reviewdatastmt);
            while($row = oci_fetch_assoc($reviewdatastmt)){

            
        ?>
        <div class="reviews">
            <div class="review-profile">
                <img src="images/<?php echo $row['USER_IMAGE']; ?>" alt="profile">
                <div class="profile-details">
                    <p><?php echo($row['USER_FIRST_NAME']." ".$row['USER_LAST_NAME']) ?></p>
                    <span class="small-font"><?php printStars($row['REVIEW_RATING']) ?></span>
                </div>
            </div>
            <div class="review-description">
                <p><?php echo $row['REVIEW_DESC']; ?></p>
            </div>
        </div>
        <?php }?>
    </div>
        

    

    <?php include('footer.html');?>

    <!-- Slick Slider -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $('.recommendation-container').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            arrows: true,
            responsive: [
                {
                    breakpoint: 1395,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        
                    }
                },
                {
                    breakpoint: 1100,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,

                    }
                },
                {
                    breakpoint: 770,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        var productMaxLimit = <?php echo $max_limit; ?>;
        document.getElementById('add-to-cart-button').addEventListener('click', function(event) {
        var quantity = document.getElementById('quantity-value').textContent;
        var addToCartLink = document.getElementById('add-to-cart-link');
        var url = '<?php if(!isset($_SESSION['id'])) {
                        echo 'login_register.php';
                    } else {
                        echo 'Cart.php?product_id='.$product_id.'&product_quantity=';
                    } ?>' + quantity;
        addToCartLink.href = url;
    });
        document.getElementById('buy-now-button').addEventListener('click', function(event) {
        var quantity = document.getElementById('quantity-value').textContent;
        var addToCartLink = document.getElementById('buy-now-link');
        var url = '<?php if(!isset($_SESSION['id'])) {
                        echo 'login_register.php';
                    } else {
                        echo 'Cart.php?product_id='.$product_id.'&buynow=1'.'&product_quantity=';
                    } ?>' + quantity;
        addToCartLink.href = url;
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.quantity-plus').addEventListener('click', function() {
            var quantity = parseInt(document.getElementById('quantity-value').textContent);
            if (quantity < productMaxLimit) {
                quantity++;
                document.getElementById('quantity-value').textContent = quantity;
            } else {
                alert('You have reached the maximum limit for this product.');
            }
            document.getElementById('quantity-value').textContent = quantity;
        });

        document.querySelector('.quantity-minus').addEventListener('click', function() {
            var quantity = parseInt(document.getElementById('quantity-value').textContent);
            if (quantity > 1) {
                quantity--;
                document.getElementById('quantity-value').textContent = quantity;
            }
        });
    });
    </script>
</body>
</html>