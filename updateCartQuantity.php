<?php
include 'connect.php';
session_start();

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $cart_id = $_SESSION['cartID']; // Assuming cart_id is stored in session during login


    // Update the cart product quantity in the database
    $update_query = "
        UPDATE cart_product 
        SET CART_PRODUCT_QUANTITY = :quantity 
        WHERE CART_ID = :cart_id AND PRODUCT_ID = :product_id
    ";
    $stmt = oci_parse($conn, $update_query);
    oci_bind_by_name($stmt, ':quantity', $quantity);
    oci_bind_by_name($stmt, ':cart_id', $cart_id);
    oci_bind_by_name($stmt, ':product_id', $product_id);

    if (oci_execute($stmt)) {
        echo "Quantity updated successfully.";
    } else {
        echo "Error updating quantity.";
    }
} else {
    echo "Invalid request.";
}
?>