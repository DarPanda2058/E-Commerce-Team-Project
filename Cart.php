<?php
if(!isset($_SESSION)){
    session_start();
}
include('connect.php');

if (isset($_SESSION['id']) && isset($_GET['product_id'])) {
    $user_id = $_SESSION['id'];
    $product_id = $_GET['product_id'];
    $product_quantity = isset($_GET['product_quantity']) ? intval($_GET['product_quantity']) : 1;

    //get product stock
    $stockquery = "SELECT PRODUCT_QUANTITY FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
    $stockstmt = oci_parse($conn,$stockquery);
    oci_execute($stockstmt);

    $stockrow = oci_fetch_assoc($stockstmt);
    $stock = $stockrow['PRODUCT_QUANTITY'];

    if($product_quantity<=$stock){

        // Retrieve cart_id and current cart_quantity from session
        $cart_id = $_SESSION['cartID'];
        $current_cart_quantity = $_SESSION['cartQuantity'];
    
        // Check if the product is already in the cart
        $cart_product_query = "SELECT * FROM cart_product WHERE cart_id = :cart_id AND product_id = :product_id";
        $stmt = oci_parse($conn, $cart_product_query);
        oci_bind_by_name($stmt, ':cart_id', $cart_id);
        oci_bind_by_name($stmt, ':product_id', $product_id);
        oci_execute($stmt);
        $cart_product = oci_fetch_assoc($stmt);
    
        if ($cart_product) {
            // Product is already in the cart, update the quantity
            $new_quantity = intval($cart_product['CART_PRODUCT_QUANTITY']) + $product_quantity;
            $update_cart_product_query = "UPDATE cart_product SET CART_PRODUCT_QUANTITY = :quantity WHERE cart_product_id = :cart_product_id";
            $stmt = oci_parse($conn, $update_cart_product_query);
            oci_bind_by_name($stmt, ':quantity', $new_quantity);
            oci_bind_by_name($stmt, ':cart_product_id', $cart_product['CART_PRODUCT_ID']);
            oci_execute($stmt);
        } else {
            // Product is not in the cart, add it
            $insert_cart_product_query = "INSERT INTO cart_product (CART_ID, PRODUCT_ID, CART_PRODUCT_QUANTITY) VALUES (:cart_id, :product_id, :quantity)";
            $stmt = oci_parse($conn, $insert_cart_product_query);
            oci_bind_by_name($stmt, ':cart_id', $cart_id);
            oci_bind_by_name($stmt, ':product_id', $product_id);
            oci_bind_by_name($stmt, ':quantity', $product_quantity);
            oci_execute($stmt);
    
            // Update the cart quantity as new product is added
            $new_cart_quantity = $current_cart_quantity + 1;
            $update_cart_query = "UPDATE cart SET CART_QUANTITY = :cart_quantity WHERE cart_id = :cart_id";
            $stmt = oci_parse($conn, $update_cart_query);
            oci_bind_by_name($stmt, ':cart_quantity', $new_cart_quantity);
            oci_bind_by_name($stmt, ':cart_id', $cart_id);
            oci_execute($stmt);
    
            // Update session cart quantity
            $_SESSION['cartQuantity'] = $new_cart_quantity;

            
        }
    
        // Redirect back to the products page or show a success message
        echo '<script>alert("Product added to cart successfully!");</script>';
        if(isset($_GET['buynow'])){
            $target_url = "Shopping-cart.php";
        }else{
            $target_url = "main.php";
        }
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
    }else{
        echo '<script>alert("Product Out Of Stock!");</script>';
        echo '<meta http-equiv="refresh" content="0;url=main.php">';
    }
} else {
    // Redirect to login if the user is not logged in
    echo '<script>alert("You must be logged in to add products to the cart.");</script>';
    $target_url = "login_register.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
}
    ?>
