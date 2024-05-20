<?php
    include("connect.php");
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['trader_email'];
    $password = $_POST['trader_password'];
    $role = 'trader';


 
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
            $_SESSION['fname'] = $row['USER_FIRST_NAME'];
            $_SESSION['lname'] = $row['USER_LAST_NAME'];
            $_SESSION['phone'] = $row['USER_PHONE'];
            $_SESSION['address'] = $row['USER_ADDRESS'];
            $_SESSION['image'] = $row['USER_IMAGE'];
            $userID = $_SESSION['userID'];
            $userEmail = $_SESSION['email'];
            $shopid_query = "SELECT COUNT(*) AS COUNT FROM SHOP WHERE USER_ID = $userID";
            $shopid_stmt = oci_parse($conn,$shopid_query);
            oci_execute($shopid_stmt);
            $shop_row = oci_fetch_array($shopid_stmt);
            //creating shop for new traders
            if($shop_row['COUNT'] == 0){
                $shop_query = "INSERT INTO SHOP(SHOP_EMAIL,USER_ID,SHOP_LOGO)VALUES('$userEmail','$userID','default-image.png')";
                $shop_stmt = oci_parse($conn,$shop_query);
                oci_execute($shop_stmt);
            }
            //storing shop_id in session
            $query_shop_id = "SELECT * FROM SHOP WHERE USER_ID = $userID";
            $shop_id_stmt = oci_parse($conn,$query_shop_id);
            oci_execute($shop_id_stmt);
            while (($row = oci_fetch_array($shop_id_stmt))){
                $_SESSION['shopID'] = $row['SHOP_ID'];
                $_SESSION['shopName'] = $row['SHOP_NAME'];
                $_SESSION['shopCategory'] = $row['SHOP_CATEGORY'];
                $_SESSION['shopLogo'] = $row['SHOP_LOGO'];
                $_SESSION['shopAddress'] = $row['SHOP_ADDRESS'];
                $_SESSION['shopPan'] = $row['PAN_NO'];
                $_SESSION['shopDescription'] = $row['SHOP_DESCRIPTION'];

            }

            $shop_id = $_SESSION['shopID'];
            

            
            echo '<script>alert("Logged in Successfully!")</script>';
            $target_url = "ManageShop.php";
            echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
            oci_free_statement($shopid_stmt);// Close the SHOP check statement handle
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
     
    if (isset($shop_stmt)) {
        oci_free_statement($shop_stmt); // Close the SHOP insert statement handle if it was used
    }
}


?>