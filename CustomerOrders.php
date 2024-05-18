<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/CustomerOrder.css">
</head>
    <?php
      include("connect.php");      
    ?>
<body>
    <?php include("nav.php")?>

    <div class="order-header">
        <h2>Your Order History.</h2>
        <h3>ALL(2)</h3>
    </div>
    
    <table>
        <tr class="title">
            <th>Image</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Order-Date</th>
            <th>Price</th>
            <th>TOTAL</th>
            <th>Paid-By</th>
            <th>&Tab;</th>
        </tr>
            
        <?php
            $query_order_id = "SELECT * FROM USER_ORDER WHERE USER_ID = :user_id";
            $query_order_data = "SELECT * FROM ORDERS WHERE ORDER_ID = :order_id";
            $query_product_id = "SELECT * FROM ORDER_PRODUCT WHERE ORDER_ID = :order_id";
            $query_product_data = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :product_id";
            $order_id_stmt = oci_parse($conn, $query_order_id);
            $order_data_stmt = oci_parse($conn, $query_order_data);
            $product_id_stmt = oci_parse($conn, $query_product_id);
            $product_data_stmt = oci_parse($conn, $query_product_data);
            
            $user_id = 12;
            oci_bind_by_name($order_id_stmt,':user_id',$user_id);
            

            oci_execute($order_id_stmt);

            // Fetch the order_id
            while (($row = oci_fetch_array($order_id_stmt))) {
                $order_id =  $row['ORDER_ID'];
                //Fetch the order data.
                oci_bind_by_name($order_data_stmt,':order_id',$order_id);
                oci_execute($order_data_stmt);
                while(($row = oci_fetch_array($order_data_stmt))){
                    $order_quantity = $row['ORDER_QUANTITY'];
                    $order_date = $row['ORDER_DATE'];
                }
                //Fetch the Product data.
                oci_bind_by_name($product_id_stmt,':order_id',$order_id);
                oci_execute($product_id_stmt);
                while(($row = oci_fetch_array($product_id_stmt))){
                    $product_id = $row['PRODUCT_ID'];
                    oci_bind_by_name($product_data_stmt,':product_id',$product_id);
                    oci_execute($product_data_stmt);
                    while(($row = oci_fetch_array($product_data_stmt))){
                        $product_name = $row['PRODUCT_NAME'];
                        $product_price = $row['PRODUCT_PRICE'];
                        $product_image = $row['PRODUCT_IMAGE'];
                        echo '<tr class="repeating-row">';
                        echo '    <td><img src="images/'.$product_image.'" width="150px" height="auto" alt="Image"></td>';
                        echo '    <td class="product-name">'.$product_name.'</td>';
                        echo '    <td><div class="product-quantity">'.$order_quantity.'</div></td>';
                        echo '    <td>'.$order_date.'</td>';
                        echo '    <td class="product-price">&pound; '.$product_price.'</td>';
                        echo '    <td class="product-total">&pound; '.$product_price*$order_quantity.'</td>';
                        echo '    <td><img src="images/paypal-logo.png" height="auto" width="100px" alt="PayPal"></td>';
                        echo '    <td><button class="order-review-button"><a href="#">Review</a></button></td>';
                        echo '</tr>';
                    }
                }
            }

            // Free the statement and close the connection
            oci_free_statement($product_data_stmt);
            oci_close($conn);

        ?>
    </table>
</body>
</html>