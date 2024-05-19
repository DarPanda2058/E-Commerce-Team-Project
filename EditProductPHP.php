<?php
include('connect.php');

if (isset($_POST['submit'])) {
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pdesc = $_POST['pdesc'];
    $pstock = $_POST['pstock'];
    $pprice = $_POST['pprice'];
    $pcategory = $_POST['pcategory'];
    $porderlim = $_POST['porderlim'];
    $pimage = $_FILES['pimage']['name'];
    $image_temp = $_FILES['pimage']['tmp_name']; // Corrected temporary file path

    // Check if a new image is uploaded
    if (!empty($pimage)) {
        // Define the destination for the new image
        $destination = "images/" . $pimage;

        // Move the uploaded file to the specified path
        if (move_uploaded_file($image_temp, $destination)) {
            // Prepare the query to update the product with the new image
            $query = "UPDATE PRODUCT SET 
                      PRODUCT_NAME = :pname,
                      PRODUCT_PRICE = :pprice,
                      PRODUCT_IMAGE = :pimage,
                      PRODUCT_CATEGORY = :pcategory,
                      PRODUCT_MAX_LIMIT = :porderlim,
                      PRODUCT_DETAILS = :pdesc,
                      PRODUCT_QUANTITY = :pstock,
                      PRODUCT_STATUS = 1
                      WHERE PRODUCT_ID = :pid";
        } else {
            echo '<script>alert("ERROR: Data Not Updated. ' . oci_error($updatestmt) . '")</script>';
            // header('Location: AddProduct.php');
            exit;
        }
    } else {
        // Keep the existing image if no new image is uploaded
        $pimage = $_POST['image-alt'];

        // Prepare the query to update the product without changing the image
        $query = "UPDATE PRODUCT SET 
                  PRODUCT_NAME = :pname,
                  PRODUCT_PRICE = :pprice,
                  PRODUCT_IMAGE = :pimage,
                  PRODUCT_CATEGORY = :pcategory,
                  PRODUCT_MAX_LIMIT = :porderlim,
                  PRODUCT_DETAILS = :pdesc,
                  PRODUCT_QUANTITY = :pstock,
                  PRODUCT_STATUS = 1
                  WHERE PRODUCT_ID = :pid";
    }

    // Prepare the statement
    $updatestmt = oci_parse($conn, $query);

    // Bind the parameters
    oci_bind_by_name($updatestmt, ':pname', $pname);
    oci_bind_by_name($updatestmt, ':pprice', $pprice);
    oci_bind_by_name($updatestmt, ':pimage', $pimage);
    oci_bind_by_name($updatestmt, ':pcategory', $pcategory);
    oci_bind_by_name($updatestmt, ':porderlim', $porderlim);
    oci_bind_by_name($updatestmt, ':pdesc', $pdesc);
    oci_bind_by_name($updatestmt, ':pstock', $pstock);
    oci_bind_by_name($updatestmt, ':pid', $pid);

    // Execute the statement
    if (oci_execute($updatestmt)) {
        echo '<script>alert("Data Updated Successfully!")</script>';
        header('Location: ManageProduct.php');
        exit;
    } else {
        echo '<script>alert("ERROR: Data Not Updated. ' . oci_error($updatestmt) . '")</script>';
        // header('Location: AddProduct.php');
        exit;
    }
}

// Close the connection
oci_close($conn);
?>