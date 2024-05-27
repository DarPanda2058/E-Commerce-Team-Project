<?php 
if(!isset($_SESSION)){
    session_start();
} 
?>
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
    <?php
      include("connect.php");
      include("nav.php");

      $user_id = $_SESSION['userID'];
      $wishlist_id = $_SESSION['wishlistID'];

    ?>
    <div class="order-header">
        <h2>Your Wishlist</h2>
    </div>
    
    <table class="wishlist">
        <tr class="title">
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>&Tab;</th>
        </tr>
            
        <?php
            $selectquery = "SELECT p.PRODUCT_NAME, p.PRODUCT_PRICE, p.PRODUCT_IMAGE, p.PRODUCT_ID
                            FROM PRODUCT p
                            JOIN WISHLIST_PRODUCT wp ON wp.PRODUCT_ID = p.PRODUCT_ID
                            WHERE WISHLIST_ID = :wishlist_id";
            $selectstmt = oci_parse($conn, $selectquery);
            oci_bind_by_name($selectstmt, ':wishlist_id', $wishlist_id);
            oci_execute($selectstmt);

            while($row = oci_fetch_assoc($selectstmt)){
                echo '<tr class="repeating-row">';
                echo '    <td><img src="images/'.htmlspecialchars($row['PRODUCT_IMAGE'], ENT_QUOTES, 'UTF-8').'" width="100px" height="auto" alt="Image"></td>';
                echo '    <td class="product-name">'.htmlspecialchars($row['PRODUCT_NAME'], ENT_QUOTES, 'UTF-8').'</td>';
                echo '    <td class="product">&pound; '.htmlspecialchars($row['PRODUCT_PRICE'], ENT_QUOTES, 'UTF-8').'</td>';
                echo '    <td><a href="wishlistdelete.php?id='.htmlspecialchars($row['PRODUCT_ID'], ENT_QUOTES, 'UTF-8').'" style="text-decoration:none;"><button class="button review-button" style="background-color:red;">DELETE</button></a></td>';
                echo '</tr>';
            }

            oci_close($conn);
        ?>
    </table>
</body>
</html>