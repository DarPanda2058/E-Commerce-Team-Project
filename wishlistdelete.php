<?php
include('connect.php');
session_start();

if(isset($_GET['id'])){
    $product_id = $_GET['id'];
    $wishlist_id = $_SESSION['wishlistID'];

    $query = "DELETE FROM WISHLIST_PRODUCT WHERE PRODUCT_ID = :product_id AND WISHLIST_ID = :wishlist_id";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':product_id', $product_id);
    oci_bind_by_name($stmt, ':wishlist_id', $wishlist_id);
    oci_execute($stmt);

    $_SESSION['wishlistQuantity'] -= 1;

    echo '<script>alert("Item Deleted from Wishlist");</script>';
    echo '<meta http-equiv="refresh" content="0;url=Wishlistview.php">';
}
?>
