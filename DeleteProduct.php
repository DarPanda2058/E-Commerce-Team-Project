<?php
    include('connect.php');
?>

<?php
    $product_id = $_GET['ID'];

    $delete_query = "DELETE FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";
    $delete_stmt = oci_parse($conn,$delete_query);
    oci_execute($delete_stmt);

    if(oci_num_rows($delete_stmt) > 0){
        header('Location: ManageProduct.php');
    }else{
        echo'<script>alert("ERROR: '.oci_error($delete_stmt).'")</script>';
        exit;
    }

    oci_close($conn);

?>