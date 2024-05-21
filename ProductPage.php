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

        $product_id = $_GET['id'];
        $product_query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
        $product_stmt = oci_parse($conn,$product_query);
        oci_execute($product_stmt);
        $product_row = oci_fetch_assoc($product_stmt);
    ?>
    <div class="product-container">
        <div class="product-image">
            <img src="images/<?php echo $product_row['PRODUCT_IMAGE'] ; ?>" alt="Product Image">
        </div>
        <div class="product-details">
            <h2><?php echo $product_row['PRODUCT_NAME'] ; ?></h2>
            <div class="star-rating">
                <p class="small-font">Star-Review</p>
                <p class="small-font">5 Reviews</p>
            </div>
            <hr>
            <p class="description"><?php echo $product_row['PRODUCT_DETAILS'] ; ?></p>
            <div class="quantity-price">
                <div class="quantity">
                    <button>&nbsp;+</button>
                    <span>1</span>
                    <button>-&nbsp;</button>
                </div>
                <p class="stock-status">In Stock</p>
                <p class="price">&pound;<?php echo $product_row['PRODUCT_PRICE'] ; ?></p>
            </div>
            <div class="buy-cart-buttons">
                <a href=""><button>BUY NOW</button></a>
                <a href=""><button>ADD TO CART</button></a>
            </div>
        </div>
    </div>
    <h2 class="sub-section">More By Shop</h2>
    <center>
    <div class="recommendation-container">
            <div class="recommend-product">
                <img src="images/product-recommendation.jpg" alt="">
                <p class="small-font">Product Name</p>
                <p class="small-font">Price</p>
            </div>
            <div class="recommend-product">
                <img src="images/product-recommendation.jpg" alt="">
                <p class="small-font">Product Name</p>
                <p class="small-font">Price</p>
            </div>
            <div class="recommend-product">
                <img src="images/product-recommendation.jpg" alt="">
                <p class="small-font">Product Name</p>
                <p class="small-font">Price</p>
            </div>
            <div class="recommend-product">
                <img src="images/product-recommendation.jpg" alt="">
                <p class="small-font">Product Name</p>
                <p class="small-font">Price</p>
            </div>
            <div class="recommend-product">
                <img src="images/product-recommendation.jpg" alt="">
                <p class="small-font">Product Name</p>
                <p class="small-font">Price</p>
            </div>
            <div class="recommend-product">
                <img src="images/product-recommendation.jpg" alt="">
                <p class="small-font">Product Name</p>
                <p class="small-font">Price</p>
            </div>
    </div>
    </center>
    <h2 class="sub-section">Reviews</h2>
    <div class="review-container">
        <div class="reviews">
            <div class="review-profile">
                <img src="images/profile-review.jpg" alt="profile">
                <div class="profile-details">
                    <p>Profile Name</p>
                    <span class="small-font">Review Date</p>
                    <span class="small-font">Star Rating</p>
                </div>
            </div>
            <div class="review-description">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet corrupti nam repudiandae blanditiis a beatae vel nulla amet quisquam animi quod magnam, exercitationem, cupiditate similique dolorum est? Laborum, doloribus minus!. Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae iste dolor, ullam voluptatum aperiam officia atque ab magni expedita esse ipsam ut earum praesentium suscipit tempora blanditiis consequatur, nisi totam.</p>
            </div>
        </div>
        <div class="reviews">
            <div class="review-profile">
                <img src="images/profile-review.jpg" alt="profile">
                <div class="profile-details">
                    <p>Profile Name</p>
                    <span class="small-font">Review Date</p>
                    <span class="small-font">Star Rating</p>
                </div>
            </div>
            <div class="review-description">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet corrupti nam repudiandae blanditiis a beatae vel nulla amet quisquam animi quod magnam, exercitationem, cupiditate similique dolorum est? Laborum, doloribus minus!. Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae iste dolor, ullam voluptatum aperiam officia atque ab magni expedita esse ipsam ut earum praesentium suscipit tempora blanditiis consequatur, nisi totam.</p>
            </div>
        </div>
        <div class="reviews">
            <div class="review-profile">
                <img src="images/profile-review.jpg" alt="profile">
                <div class="profile-details">
                    <p>Profile Name</p>
                    <span class="small-font">Review Date</p>
                    <span class="small-font">Star Rating</p>
                </div>
            </div>
            <div class="review-description">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet corrupti nam repudiandae blanditiis a beatae vel nulla amet quisquam animi quod magnam, exercitationem, cupiditate similique dolorum est? Laborum, doloribus minus!. Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae iste dolor, ullam voluptatum aperiam officia atque ab magni expedita esse ipsam ut earum praesentium suscipit tempora blanditiis consequatur, nisi totam.</p>
            </div>
        </div>
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
    </script>
</body>
</html>