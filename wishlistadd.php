<?php
if(!isset($_SESSION)){
    session_start();
}
include('connect.php');

if (isset($_SESSION['id']) && isset($_GET['product_id'])) {
    $user_id = $_SESSION['id'];
    $product_id = $_GET['product_id'];


    //get product stock
    $stockquery = "SELECT PRODUCT_QUANTITY FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
    $stockstmt = oci_parse($conn,$stockquery);
    oci_execute($stockstmt);

    $stockrow = oci_fetch_assoc($stockstmt);
    $stock = $stockrow['PRODUCT_QUANTITY'];

    if($stock>0){

        // Retrieve wishlist_id and current wishlist_quantity from session
        $wishlist_id = $_SESSION['wishlistID'];
        $wishlist_quantity = $_SESSION['wishlistQuantity'];
    
        // Check if the product is already in the wishlist
        $wishlist_product_query = "SELECT * FROM wishlist_product WHERE wishlist_id = :wishlist_id AND product_id = :product_id";
        $stmt = oci_parse($conn, $wishlist_product_query);
        oci_bind_by_name($stmt, ':wishlist_id', $wishlist_id);
        oci_bind_by_name($stmt, ':product_id', $product_id);
        oci_execute($stmt);
        $wishlist_product = oci_fetch_assoc($stmt);

        if ($wishlist_product) {
            // Product is already in the wishlist, update the quantity
            echo '<script>alert("Product already in Wishlist!");</script>';
            $target_url = "ProductPage.php?id=".$product_id;
            echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
            exit;
        } else {
            // Product is not in the wishlist, add it
            $insert_wishlist_product_query = "INSERT INTO wishlist_product (wishlist_ID, PRODUCT_ID, wishlist_PRODUCT_QUANTITY) VALUES (:wishlist_id, :product_id, 1)";
            $stmt = oci_parse($conn, $insert_wishlist_product_query);
            oci_bind_by_name($stmt, ':wishlist_id', $wishlist_id);
            oci_bind_by_name($stmt, ':product_id', $product_id);

            oci_execute($stmt);   
            
            // Update the cart quantity as new product is added
            $new_wishlist_quantity = $wishlist_quantity + 1;
            $update_wishlist_query = "UPDATE WISHLIST SET WISHLIST_QUANTITY = '$new_wishlist_quantity' WHERE wishlist_id = :wishlist_id";
            $stmt = oci_parse($conn, $update_wishlist_query);

            oci_bind_by_name($stmt, ':wishlist_id', $wishlist_id);
            oci_execute($stmt);
    
            // Update session cart quantity
            $_SESSION['wishlistQuantity'] = $new_wishlist_quantity;
        }
    
        // Redirect back to the products page or show a success message
        echo '<script>alert("Product added to wishlist successfully!");</script>';
        if(isset($_GET['buynow'])){
            $target_url = "Shopping-cart.php";
        }else{
            $target_url = "ProductPage.php?id=".$product_id;
        }
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
    }else{
        echo '<script>alert("Product Out Of Stock!");</script>';
        echo '<meta http-equiv="refresh" content="0;url=main.php">';
    }
} else {
    // Redirect to login if the user is not logged in
    echo '<script>alert("You must be logged in to add products to the wishlist.");</script>';
    $target_url = "login_register.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
}
    ?>
