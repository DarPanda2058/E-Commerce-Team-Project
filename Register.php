<?php
    include("connect.php");
?>


<?php
session_start();
include('connect.php');

$error_msg=$error_email = $error_phone = $error_passwd = $error_passwdConfirm = '';
if (isset($_POST['registerBtn'])) {
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password_confirm = $_POST['confirmPassword'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $status = "0";
    $time = date("d-M-y h:i:s");
    $image = "default-image.png";

    $error = 0;
    // Session
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    $_SESSION['age'] = $age;
    $_SESSION['gender'] = $gender;
    $_SESSION['role'] = $role;

    // Validation
    if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
        $error_email = "Please enter a valid email, like yourname@abc.com";
        $error_msg = "Please enter a valid email, like yourname@abc.com";

        $error++;
    }
    if (!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || !preg_match('@[^\w]@', $password) || strlen($password) < 6) {
        $error_passwd = "Password must include an uppercase character, a lowercase character, a number, a special character and be greater than six characters";
        $error_msg = "Password must include an uppercase character, a lowercase character, a number, a special character and be greater than six characters";
        $error++;
    }
    if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        $error_phone = "Please enter a valid mobile number";
        $error_msg = "Please enter a valid mobile number";
        $error++;
    }
    if ($password != $password_confirm) {
        $error_passwdConfirm = "Password does not match";
        $error_msg = "Password does not match";
        $error++;
    }

    // Check for existing email
    $check_email = "SELECT COUNT(*) as EMAIL_COUNT FROM USERS WHERE USER_EMAIL = :email";
    $bind_email = oci_parse($conn, $check_email);
    oci_bind_by_name($bind_email, ':email', $email);

    if (oci_execute($bind_email)) {
        $result = oci_fetch_assoc($bind_email);
        if ($result["EMAIL_COUNT"] > 0) {
            $error_email = "Email already exists!";
            $error_msg = "Email already exists!";
            $error++;
        }
    }

    if ($error == 0) {
        
        $query = "INSERT INTO USERS (USER_FIRST_NAME, USER_LAST_NAME, USER_PHONE, USER_EMAIL, USER_PASSWORD, USER_TYPE, USER_CREATED_TIME, USER_STATE,USER_IMAGE)
                  VALUES (:fname, :lname, :phone, :email, :password, :role, TO_DATE(:time, 'DD-MON-YY HH24:MI:SS'), :status,'default-image.png')";
        $register_stmnt = oci_parse($conn, $query);
        
        //passwordSecurity
        $password = md5($password);
        oci_bind_by_name($register_stmnt, ':fname', $fname);
        oci_bind_by_name($register_stmnt, ':lname', $lname);
        oci_bind_by_name($register_stmnt, ':phone', $phone);
        oci_bind_by_name($register_stmnt, ':email', $email);
        oci_bind_by_name($register_stmnt, ':password', $password);
        oci_bind_by_name($register_stmnt, ':role', $role);
        oci_bind_by_name($register_stmnt, ':time', $time);
        oci_bind_by_name($register_stmnt, ':status', $status);


        if (oci_execute($register_stmnt)) {
            
            
           
            if ($role == 'customer') {
                // Select customer ID from USERS table
                $query_customer_id = "SELECT USER_ID FROM USERS WHERE USER_EMAIL = :email";
                $customer_id_stmt = oci_parse($conn, $query_customer_id);
                oci_bind_by_name($customer_id_stmt, ':email', $email);
                oci_execute($customer_id_stmt);
                $row = oci_fetch_assoc($customer_id_stmt);
                $user_id = $row['USER_ID'];
            
                // Insert a new cart with an initial quantity of 0
                $cart_query = "INSERT INTO CART (CART_QUANTITY) VALUES (0) RETURNING CART_ID INTO :cart_id";
                $cart_stmt = oci_parse($conn, $cart_query);
                oci_bind_by_name($cart_stmt, ':cart_id', $cart_id, -1, OCI_B_INT); // Bind cart_id to receive the new CART_ID
                oci_execute($cart_stmt);

                //Insert a new wishlist with an initail quantity of 0
                $wishlist_query = "INSERT INTO WISHLIST (WISHLIST_QUANTITY) VALUES (0) RETURNING WISHLIST_ID INTO :wishlist_id";
                $wishlist_stmt = oci_parse($conn, $wishlist_query);
                oci_bind_by_name($wishlist_stmt, ':wishlist_id', $wishlist_id, -1, OCI_B_INT); // Bind cart_id to receive the new CART_ID
                oci_execute($wishlist_stmt);
            
                // Update the USERS table with the new CART_ID for the specific USER_ID
                $update_user_cart_query = "UPDATE USERS SET CART_ID = :cart_id WHERE USER_ID = :user_id";
                $update_user_cart_stmt = oci_parse($conn, $update_user_cart_query);
                oci_bind_by_name($update_user_cart_stmt, ':cart_id', $cart_id); // Use the bound cart_id
                oci_bind_by_name($update_user_cart_stmt, ':user_id', $user_id);
                oci_execute($update_user_cart_stmt);   
                //Update the USERS table with the new WISHLIST_ID for the specific USER_ID
                $update_user_wishlist_query = "UPDATE USERS SET WISHLIST_ID = :wishlist_id WHERE USER_ID = :user_id";
                $update_user_wishlist_stmt = oci_parse($conn, $update_user_wishlist_query);
                oci_bind_by_name($update_user_wishlist_stmt, ':wishlist_id', $wishlist_id); // Use the bound cart_id
                oci_bind_by_name($update_user_wishlist_stmt, ':user_id', $user_id);
                oci_execute($update_user_wishlist_stmt);            
            }
                
            $target_url = "OTP.php";
            echo '<script>alert("Registered Successfully")</script>';
            echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
        } else {
            echo '<script>alert("ERROR: Data Not Inserted: ' . oci_error($register_stmnt) . '")</script>';
        }
    }else{
        echo '<script>alert("'.$error_msg.'")</script>';
        $target_url = "login_register.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
    }
}

oci_close($conn);
?>