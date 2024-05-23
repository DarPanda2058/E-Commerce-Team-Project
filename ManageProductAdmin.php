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
    <?php

        if(isset($_GET['ID'])){
            $product_id = $_GET['ID'];
            $status = $_GET['status'];
            $query = "UPDATE PRODUCT SET PRODUCT_STATUS = :status WHERE PRODUCT_ID = :product_id";
            $stmt = oci_parse($conn, $query);
            oci_bind_by_name($stmt, ':status', $status);
            oci_bind_by_name($stmt, ':product_id', $product_id);

            if (oci_execute($stmt)) {
                echo '<script>alert("Product status updated successfully.");</script>';
            } else {
                echo '<script>alert("Error updating product status.");</script>';
            }
    
            // Redirect to the same page to reflect changes
            header("Location: ManageProductAdmin.php");
            exit();
        }

        $approved_count = 0;
        $not_approved_count = 0;
        $admin_id = $_SESSION['userID'];

        $query_product_data = "SELECT p.PRODUCT_IMAGE,
                                        p.PRODUCT_ID, 
                                        p.PRODUCT_NAME, 
                                        p.PRODUCT_QUANTITY, 
                                        p.PRODUCT_PRICE, 
                                        p.PRODUCT_STATUS, 
                                        s.SHOP_NAME
                                FROM product p
                                JOIN shop s ON p.SHOP_ID = s.SHOP_ID";
        $query_product_status = "SELECT 
                                    SUM(CASE WHEN PRODUCT_STATUS = 1 THEN 1 ELSE 0 END) AS APPROVED_COUNT,
                                    SUM(CASE WHEN PRODUCT_STATUS = 0 THEN 1 ELSE 0 END) AS NOT_APPROVED_COUNT,
                                    COUNT(*) AS TOTAL_PRODUCTS
                                FROM 
                                    PRODUCT";
        

        $product_data_stmt = oci_parse($conn,$query_product_data);
        $product_status_stmt = oci_parse($conn,$query_product_status);

        //finding approved and not approved products

        oci_execute($product_status_stmt);
        //extracting product deatails of a specific shop.

        oci_execute($product_data_stmt);
        
        if($row = oci_fetch_assoc($product_status_stmt)){
            $approved = $row['APPROVED_COUNT'];
            $not_approved = $row['NOT_APPROVED_COUNT'];
            $total_products = $row['TOTAL_PRODUCTS'];
            if($approved == null){
                $approved = 0;
            }
            if($not_approved == null){
                $not_approved = 0;
            }
        }


    ?>
    <div class="order-header">
        <h2>Manage Your Product.</h2>
        <div class="status-add">
            <div class="status-row">
                <h3>ALL(<?php echo $total_products;?>)</h3>
                <h3 class="green">Online(<?php echo $approved;?>)</h3>
                <h3 class="red">Pending-Review(<?php echo $not_approved;?>)</h3>
            </div>
        </div>
    </div>

    
    <table>
        <tr class="title">
            <th>Image</th>
            <th>Name</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Shop</th>
            <th>Status</th>
            <th>&Tab;</th>
            <th>&Tab;</th>
        </tr>
        <?php
            while (($row = oci_fetch_array($product_data_stmt))){
                $product_name = $row['PRODUCT_NAME'];
                $product_price = $row['PRODUCT_PRICE'];
                $product_image = $row['PRODUCT_IMAGE'];
                $product_stock = $row['PRODUCT_QUANTITY'];
                $product_status = $row['PRODUCT_STATUS'];
                $shop_name = $row['SHOP_NAME'];
                echo '<tr class="repeating-row">';
                echo '    <td><img src="images/'.$product_image.'" alt="Image"></td>';
                echo '    <td class="product-name">'."$product_name".'</td>';
                echo '    <td class="product-stock">'.$product_stock.'</td>';
                echo '    <td class="product-price">&pound; '.$product_price.'</td>';
                echo '    <td class="shop-name">'.$shop_name.'</td>';


                echo '<td class = "status">';
                    if ($product_status == 0) {
                        echo '<button class="pending-approval">Pending Approval</button>';
                    } else {
                        echo '<button class="approved">Approved</button>';
                    }
                echo '</td>';
                echo '    <td><button class="order-delete-button" id="red" ><a href="ManageProductAdmin.php?ID='.$row['PRODUCT_ID'].'&status=0">Disable</a></button></td>';
                echo '    <td><button class="order-modify-button" id="green" ><a href="ManageProductAdmin.php?ID='.$row['PRODUCT_ID'].'&status=1">Approve</a></button></td>';
                echo '</tr>';
            }
        oci_close($conn);
        ?>

            
            


</body>
</html>