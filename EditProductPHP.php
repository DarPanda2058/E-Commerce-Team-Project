<?php
    include('connect.php')
?>

<?php
if(isset($_POST['submit'])){
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pdesc = $_POST['pdesc'];
    $pstock = $_POST['pstock'];
    $pprice = $_POST['pprice'];
    $pcategory = $_POST['pcategory'];
    $porderlim = $_POST['porderlim'];
    $pimage = $_FILES['pimage']['name'];
    if(empty($pimage)){
        $pimage = $_POST['image-alt'];
    }

    $query = "UPDATE PRODUCT SET PRODUCT_NAME='$pname',PRODUCT_PRICE='$pprice',PRODUCT_IMAGE='$pimage',PRODUCT_CATEGORY='$pcategory',PRODUCT_MAX_LIMIT='$porderlim',PRODUCT_DETAILS='$pdesc',PRODUCT_QUANTITY='$pstock',PRODUCT_STATUS=1 WHERE PRODUCT_ID='$pid'";

    $updatestmt = oci_parse($conn,$query);
    if(oci_execute($updatestmt)){

        echo'<script>alert("Data Updated Successfully!")</script>';

        header('Location: ManageProduct.php');
        
    }else{
        echo'<script>alert("ERROR: Data Not Inserted'.oci_error($updatestmt).'")</script>';

        header('Location: AddProduct.php');
        
    }
}


oci_close($conn);
?>