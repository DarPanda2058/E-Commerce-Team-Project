<?php
    include('connect.php');
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_GET['id'])){
        $product_id = $_GET['id'];
        $query = "DELETE FROM CART_PRODUCT WHERE PRODUCT_ID = '$product_id'";
        $stmt = oci_parse($conn,$query);
        oci_execute($stmt);

        echo '<script>alert("Item Deleted");</script>';
        $target_url = "Shopping-cart.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
    }
?>