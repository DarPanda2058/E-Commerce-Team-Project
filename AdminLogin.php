<?php
    include("connect.php");
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];
    $role = 'admin';


 
    // Prepared statement to prevent SQL injection
    $query = "SELECT * FROM USERS WHERE USER_EMAIL = :email AND USER_TYPE = :role AND USER_STATE = 1";
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
            

            

            
            echo '<script>alert("Logged in Successfully!")</script>';
            $target_url = "userProfile.php";
            echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
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
     
}


?>