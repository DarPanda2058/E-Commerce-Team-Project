<?php
include ('connect.php');
session_start();
?>

<?php
    //insert into order table and get the order_id
    $cartID = $_SESSION['cartID'];
    $orderQuantity = $_SESSION['cartQuantity'];
    $orderDate = date("d/M/Y");
    $orderquery = "INSERT INTO ORDERS(ORDER_QUANTITY,ORDER_DATE)VALUES('$orderQuantity','$orderDate') RETURNING ORDER_ID INTO :order_id";
    $orderstmt = oci_parse($conn,$orderquery);
    oci_bind_by_name($orderstmt,':order_id',$order_id,-1,OCI_B_INT);
    oci_execute($orderstmt);

    //insert into collection_slot table and get the slot_id
    $collectionDate = $_SESSION['collectionDate'];
    $collectionTime = $_SESSION['collectionTime'];
    $times = explode("-",$collectionTime);
    $startTime = intval($times[0]);
    $endTime = intval($times[1]);
    $collectionquery = "INSERT INTO COLLECTION_SLOT(COLLECTION_DAY,COLLECTION_START_TIME,COLLECTION_END_TIME)VALUES(TO_DATE(:collectionDate,'YY-MM-DD'),'$startTime','$endTime') RETURNING SLOT_ID INTO :slot_id";
    $collectionstmt = oci_parse($conn,$collectionquery);
    oci_bind_by_name($collectionstmt, ':slot_id', $slot_id, -1, OCI_B_INT); 
    oci_bind_by_name($collectionstmt,':collectionDate',$collectionDate);
    oci_execute($collectionstmt);

    //update the slot_id of the order table with the newly formed slot_id
    $updateorderquery = "UPDATE ORDERS SET SLOT_ID = '$slot_id' WHERE ORDER_ID = '$order_id'";
    $updateorderstmt = oci_parse($conn,$updateorderquery);
    oci_execute($updateorderstmt);

    //transfer the details from the cart_product table to the order_product table
    $getcartproductquery = "SELECT * FROM CART_PRODUCT WHERE CART_ID = '$cartID'";
    $getcartproductstmt = oci_parse($conn,$getcartproductquery);
    oci_execute($getcartproductstmt);
    while($row = oci_fetch_assoc($getcartproductstmt)){
        $order_product_quantity = $row['CART_PRODUCT_QUANTITY'];
        $product_id = $row['PRODUCT_ID'];

        $orderproductquery = "INSERT INTO ORDER_PRODUCT(ORDER_ID,PRODUCT_ID,ORDER_PRODUCT_QUANTITY)VALUES('$order_id','$product_id','$order_product_quantity')";
        $orderproductstmt = oci_parse($conn,$orderproductquery);
        oci_execute($orderproductstmt);
    }

    //insert the orderid into the user_order table
    $userID = $_SESSION['userID'];
    $userorderquery = "INSERT INTO USER_ORDER(USER_ID,ORDER_ID)VALUES('$userID','$order_id')";
    $userorderstmt = oci_parse($conn,$userorderquery);
    oci_execute($userorderstmt);

    
    //update users table to remove cart
    $usercartquery = "UPDATE USERS SET CART_ID = NULL WHERE USER_ID = '$userID'";
    $usercartstmt = oci_parse($conn,$usercartquery);
    

    //remove products from the cart if the cart is updated in user.
    if(oci_execute($usercartstmt)){
        $deletecartquery = "DELETE FROM CART WHERE CART_ID = '$cartID'";
        $deletecartstmt = oci_parse($conn,$deletecartquery);
        oci_execute($deletecartstmt);
        $_SESSION['cartQuantity'] = 0;
    }

    $target_url = "CustomerOrders.php";
    echo '<script>alert("Ordered Successfully")</script>';
    echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';

?>