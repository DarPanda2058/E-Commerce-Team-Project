<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/ManageProduct.css">
</head>
<?php
    include("connect.php");
    include("nav.php");
?>
<body>
    <body>
        <div class="order-header">
            <h2>Your Order History.</h2>
            <br>
            <div class="status-add">
                <div class="status-row">
                    <h3>ALL(2)</h3>
                    <h3 class="green">Online(1)</h3>
                    <h3 class="red">Pending-Review(1)</h3>
                </div>
                <button><a href="AddProduct.php">Add New Product</a></button>
            </div>
        </div>
        
        <table>
            <tr class="title">
                <th>Image</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Order-Limit</th>
                <th>Status</th>
                <th>&Tab;</th>
                <th>&Tab;</th>
            </tr>
            <?php
                $query_shop_id = "SELECT SHOP_ID FROM SHOP WHERE USER_ID = 10";
                $query_product_data = "SELECT*FROM PRODUCT WHERE SHOP_ID = :shop_id";

                $shop_id_stmt = oci_parse($conn,$query_shop_id);
                $product_data_stmt = oci_parse($conn,$query_product_data);
                
                oci_execute($shop_id_stmt);


                while (($row = oci_fetch_array($shop_id_stmt))){
                    $shop_id = $row['SHOP_ID'];
                }
                    //extracting product deatails of a specific shop.
                    oci_bind_by_name($product_data_stmt,':shop_id',$shop_id);
                    oci_execute($product_data_stmt);
                    while (($row = oci_fetch_array($product_data_stmt))){
                        $product_name = $row['PRODUCT_NAME'];
                        $product_price = $row['PRODUCT_PRICE'];
                        $product_image = $row['PRODUCT_IMAGE'];
                        $product_max = $row['PRODUCT_MAX_LIMIT'];
                        $product_stock = $row['PRODUCT_QUANTITY'];
                        $product_status = $row['PRODUCT_STATUS'];
                        echo '<tr class="repeating-row">';
                        echo '    <td><img src="images/'.$product_image.'" alt="Image"></td>';
                        echo '    <td class="product-name">'."$product_name".'</td>';
                        echo '    <td class="product-stock">'.$product_stock.'</td>';
                        echo '    <td class="product-price">&pound; '.$product_price.'</td>';
                        echo '    <td class="order-limit">'.$product_max.'</td>';
                        echo '<td class = "status">';
                            if ($product_status == 1) {
                                echo '<button class="pending-approval">Pending Approval</button>';
                            } else {
                                echo '<button class="approved">Approved</button>';
                            }
                        echo '</td>';
                        echo '    <td><button class="order-delete-button"><a href="DeleteProduct.php?ID='.$row['PRODUCT_ID'].'">Delete</a></button></td>';
                        echo '    <td><button class="order-modify-button"><a href="ModifyProduct.php?ID='.$row['PRODUCT_ID'].'">Modify</a></button></td>';
                        echo '</tr>';
                    }
                oci_close($conn);
            ?>

            
            


</body>
</html>