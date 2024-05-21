<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butcher Products</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
       <?php include('nav.php');?>
       <?php include('connect.php');?>
       <?php
            if(isset($_GET['id'])){
                $shop_id = $_GET['id'];
                $shop_name = $_GET['name'];
                $query = "SELECT * FROM PRODUCT WHERE SHOP_ID = '$shop_id'";
            }else{
                $query = "SELECT * FROM PRODUCT";
            }
            $stmt = oci_parse($conn,$query);
            oci_execute($stmt);
       ?>


    <center>
        <?php if(isset($_GET['id'])){ ?>
        <h1 class="title">Butcher</h1>
        <?php } ?>
        <h1>Products</h1>
        <hr width="5%">
    </center>

    <div class="headline">
        <div class="l-container">
            <?php 
                while($row = oci_fetch_assoc($stmt)){
            ?>
            <div class="product">
                <div class="product-image" style="background-image: url(images/<?php echo $row['PRODUCT_IMAGE'] ?>);"></div>
                <div class="product-info">
                    <h2><?php echo $row['PRODUCT_NAME'] ?></h2>
                    <p class="price">&pound;<?php echo $row['PRODUCT_PRICE'] ?></p>
                    <p class="descr"><?php echo $row['PRODUCT_DETAILS'] ?></p>
                    <div class="product-buttons">
                        <a href="#" class="btn buy">Buy</a>
                        <a href="#" class="btn add-to-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php } ?>  
        </div>
    </div>
<?php include('footer.html');?>
</body>
</html>