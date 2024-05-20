<?php
include('connect.php');
session_start();

if (isset($_POST['shopSave'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $tphone = $_POST['tphone'];
    $taddress = $_POST['taddress'];
    $timage = $_FILES['timage']['name'];
    $image_temp = $_FILES['timage']['tmp_name'];

    // Check if a new image is uploaded
    if (!empty($timage)) {
        // Define the destination for the new image
        $destination = "images/" . $timage;

        // Move the uploaded file to the specified path
        if (move_uploaded_file($image_temp, $destination)) {
            // Prepare the query to update the trader profile with the new image
            $query = "UPDATE USERS SET 
                      USER_FIRST_NAME = :fname,
                      USER_LAST_NAME = :lname,

                      USER_PHONE = :tphone,
                      USER_ADDRESS = :taddress,
                      USER_IMAGE = :timage
                      WHERE USER_ID = :trader_id";
        } else {
            echo '<script>alert("ERROR: Data Not Updated. ' . oci_error($updatestmt) . '")</script>';
            exit;
        }
    } else {
        // Keep the existing image if no new image is uploaded
        $timage = $_POST['image-alt'];

        // Prepare the query to update the trader profile without changing the image
        $query = "UPDATE USERS SET 
                  USER_FIRST_NAME = :fname,
                  USER_LAST_NAME = :lname,

                  USER_PHONE = :tphone,
                  USER_ADDRESS = :taddress,
                  USER_IMAGE = :timage
                  WHERE USER_ID = :trader_id";
    }

    // Prepare the statement
    $updatestmt = oci_parse($conn, $query);

    // Bind the parameters
    oci_bind_by_name($updatestmt, ':fname', $fname);
    oci_bind_by_name($updatestmt, ':lname', $lname);
    oci_bind_by_name($updatestmt, ':tphone', $tphone);
    oci_bind_by_name($updatestmt, ':taddress', $taddress);
    oci_bind_by_name($updatestmt, ':timage', $timage);
    oci_bind_by_name($updatestmt, ':trader_id', $_SESSION['userID']);

    // Execute the statement
    if (oci_execute($updatestmt)) {
        echo '<script>alert("Data Updated Successfully!")</script>';
        // Updating the session variables
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;

        $_SESSION['phone'] = $tphone;
        $_SESSION['address'] = $taddress;
        $_SESSION['image'] = $timage;

        $target_url = "traderProfile.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
        exit;
    } else {
        echo '<script>alert("ERROR: Data Not Updated. ' . oci_error($updatestmt) . '")</script>';
        $target_url = "traderProfile.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
        exit;
    }
}

// Close the connection
oci_close($conn);
?>