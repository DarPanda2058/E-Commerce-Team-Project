<?php
    include('connect.php');
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_GET['id'])){
        $cart_quantity = $_SESSION['cartQuantity'];
        $product_id = $_GET['id'];
        $deletequery = "DELETE FROM CART_PRODUCT WHERE PRODUCT_ID = '$product_id'";
        $deletestmt = oci_parse($conn,$deletequery);
        oci_execute($deletestmt);
        $cart_quantity = $cart_quantity-1;
        $updatequery = "UPDATE CART SET CART_QUANTITY = '$cart_quantity'";
        $updatestmt = oci_parse($conn,$updatequery);
        oci_execute($updatestmt);
        $_SESSION['cartQuantity'] = $cart_quantity;

        echo '<script>alert("Item Deleted");</script>';
        $target_url = "Shopping-cart.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
    }
?>