<?php
include('connect.php');
session_start();

if (isset($_POST['changePass'])) {
    $currentPass = $_POST['currentPass'];
    $newPass = $_POST['newPass'];
    $confirmPass = $_POST['confirmPass'];
    $user_id = $_SESSION['userID']; // Assuming userID is stored in the session

    // Check if new password and confirm password match
    if ($newPass !== $confirmPass) {
        echo '<script>alert("ERROR: New password and confirm password do not match.")</script>';
        $target_url = "changePass.php";
        // echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
        exit;
    }

    // Get the current password from the database
    $query = "SELECT USER_PASSWORD FROM USERS WHERE USER_ID = :user_id";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':user_id', $user_id);
    oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);

    if ($row) {
        $dbPass = $row['USER_PASSWORD'];
        
        // Verify the current password
        if (/*password_verify($currentPass, $dbPass*/$currentPass == $dbPass) {
            // Hash the new password
            $hashedNewPass = $newPass/*password_hash($newPass, PASSWORD_BCRYPT)*/;

            // Update the password in the database
            $updateQuery = "UPDATE USERS SET USER_PASSWORD = :newPass WHERE USER_ID = :user_id";
            $updateStmt = oci_parse($conn, $updateQuery);
            oci_bind_by_name($updateStmt, ':newPass', $hashedNewPass);
            oci_bind_by_name($updateStmt, ':user_id', $user_id);

            if (oci_execute($updateStmt)) {
                echo '<script>alert("Password Updated Successfully!")</script>';
                $target_url = "traderProfile.php";
                echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
                exit;
            } else {
                echo '<script>alert("ERROR: Password not updated. ' . oci_error($updateStmt) . '")</script>';
                $target_url = "changePass.php";
                echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
                exit;
            }
        } else {
            echo '<script>alert("ERROR: Current password is incorrect.")</script>';
            $target_url = "changePass.php";
            echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
            exit;
        }
    } else {
        echo '<script>alert("ERROR: User not found.")</script>';
        echo oci_error($updateStmt);
        $target_url = "traderProfile.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
        exit;
    }
}

// Close the connection
oci_close($conn);
?>