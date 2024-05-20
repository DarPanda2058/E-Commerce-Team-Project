<?php
include('connect.php');
session_start();

if (isset($_POST['shopSave'])) {
    $sname = $_POST['sname'];
    $sdesc = $_POST['sdesc'];
    $scategory = $_POST['scategory'];
    $span = $_POST['span'];
    $saddress = $_POST['saddress'];
    $shop_id = $_SESSION['shopID'];
    $simage = $_FILES['simage']['name'];
    $image_temp = $_FILES['simage']['tmp_name']; // Corrected temporary file path

    // Check if a new image is uploaded
    if (!empty($simage)) {
        // Define the destination for the new image
        $destination = "images/" . $simage;

        // Move the uploaded file to the specified path
        if (move_uploaded_file($image_temp, $destination)) {
            // Prepare the query to update the product with the new image
            $query = "UPDATE SHOP SET 
                      SHOP_NAME = :sname,
                      SHOP_DESCRIPTION = :sdesc,
                      SHOP_CATEGORY = :scategory,
                      PAN_NO = :span,
                      SHOP_ADDRESS = :saddress,
                      SHOP_LOGO = :simage
                      WHERE SHOP_ID = :shop_id";
        } else {
            echo '<script>alert("ERROR: Data Not Updated. ' . oci_error($updatestmt) . '")</script>';
            // header('Location: AddProduct.php');
            exit;
        }
    } else {
        // Keep the existing image if no new image is uploaded
        $simage = $_POST['image-alt'];

        // Prepare the query to update the product without changing the image
        $query = "UPDATE SHOP SET 
                  SHOP_NAME = :sname,
                  SHOP_DESCRIPTION = :sdesc,
                  SHOP_CATEGORY = :scategory,
                  PAN_NO = :span,
                  SHOP_ADDRESS = :saddress,
                  SHOP_LOGO = :simage
                  WHERE SHOP_ID = :shop_id";
    }

    // Prepare the statement
    $updatestmt = oci_parse($conn, $query);

    // Bind the parameters
    oci_bind_by_name($updatestmt, ':sname', $sname);
    oci_bind_by_name($updatestmt, ':sdesc', $sdesc);
    oci_bind_by_name($updatestmt, ':scategory', $scategory);
    oci_bind_by_name($updatestmt, ':span', $span);
    oci_bind_by_name($updatestmt, ':saddress', $saddress);
    oci_bind_by_name($updatestmt, ':simage', $simage);
    oci_bind_by_name($updatestmt, ':shop_id', $shop_id);

    // Execute the statement
    if (oci_execute($updatestmt)) {
        echo '<script>alert("Data Updated Successfully!")</script>';
        //updating the session variables.
        $_SESSION['shopName'] = $sname;
        $_SESSION['shopDescription'] = $sdesc;
        $_SESSION['shopCategory'] = $scategory;
        $_SESSION['shopPan'] = $span;
        $_SESSION['shopAddress'] = $saddress;
        $_SESSION['shopLogo'] = $simage;

        $target_url = "ManageShop.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
        exit;
    } else {
        echo '<script>alert("ERROR: Data Not Updated. ' . oci_error($updatestmt) . '")</script>';
        $target_url = "AddProduct.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
        exit;
    }
}

// Close the connection
oci_close($conn);
?>