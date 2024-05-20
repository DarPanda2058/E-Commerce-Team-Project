<?php
    include("connect.php");
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['customer_email'];
    $password = $_POST['customer_password'];
    $role = 'customer';


 
    // Prepared statement to prevent SQL injection
    $query = "SELECT * FROM USERS WHERE USER_EMAIL = :email AND USER_TYPE = :role";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':email', $email);
    oci_bind_by_name($stmt, ':role', $role);

    oci_execute($stmt);

    if ($row = oci_fetch_assoc($stmt)) {
        
        if (($password == $row['USER_PASSWORD'])) {
            session_start();
            $_SESSION['userID'] = $row['USER_ID'];
            $_SESSION['email'] = $email; 
            $_SESSION['role'] = $row['USER_TYPE'];
            $_SESSION['id'] = $row['USER_ID'];
            $_SESSION['fname'] = $row['USER_FIRST_NAME'];
            $_SESSION['lname'] = $row['USER_LAST_NAME'];
            $userID = $_SESSION['userID'];
            $userEmail = $_SESSION['email'];
            //creating cart for new customers

            //storing cart_id in session
            $query_cart_id = "SELECT CART_ID FROM USERS WHERE USER_ID = '$userID'";
            $cart_id_stmt = oci_parse($conn,$query_cart_id);
            oci_execute($cart_id_stmt);
            $row = oci_fetch_array($cart_id_stmt);
            $cart_id = $row['CART_ID'];

            //storing cart quantity from cart table.
            $query_cart = "SELECT CART_QUANTITY FROM CART WHERE CART_ID = '$cart_id'";
            $cart_stmt = oci_parse($conn,$query_cart);
            oci_execute($cart_stmt);
            $row = oci_fetch_assoc($cart_stmt);
            $cart_quantity = $row['CART_QUANTITY'];
            
            $_SESSION['cartID'] = $cart_id;
            $_SESSION['cartQuantity'] = $cart_quantity;

            
            echo '<script>alert("Logged in Successfully!")</script>';
            $target_url = "CustomerOrders.php";
            echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
            oci_free_statement($cart_id_stmt);
            oci_free_statement($cart_stmt);
        } else {
            $_SESSION['failmessage'] = "Authentication failed! Wrong Credentials entered";
            echo '<script>alert("ERROR: ' . $_SESSION['failmessage'] . '")</script>';
            $target_url = "login_register.php";
            echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
        }
        
    } else {
        $_SESSION['failmessage'] = "Authentication failed! Wrong Credentials entered";
        echo '<script>alert("ERROR: ' . $_SESSION['failmessage'] . '")</script>';
        $target_url = "login_register.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
    }

    oci_free_statement($stmt); // Close the statement handle
     // Close the cart check statement handle
}


?>