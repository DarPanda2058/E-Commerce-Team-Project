<?php
    include('connect.php')
?>

<?php
if(isset($_POST['submit'])){
    $pname = $_POST['pname'];
    $pdesc = $_POST['pdesc'];
    $pstock = $_POST['pstock'];
    $pprice = $_POST['pprice'];
    $pcategory = $_POST['pcategory'];
    $porderlim = $_POST['porderlim'];
    $pimage = $_FILES['pimage']['name'];

    $query = "INSERT INTO PRODUCT(PRODUCT_NAME,PRODUCT_PRICE,PRODUCT_IMAGE,PRODUCT_CATEGORY,PRODUCT_MAX_LIMIT,PRODUCT_DETAILS,PRODUCT_QUANTITY,PRODUCT_STATUS,SHOP_ID) VALUES('$pname','$pprice','$pimage','$pcategory','$porderlim','$pdesc','$pstock',1,101)";

    $insertstmt = oci_parse($conn,$query);
    if(oci_execute($insertstmt)){
        // header("Location: ManageProduct.php")
        echo'<script>alert("Data Inserted Successfully!")</script>';
    }else{
        echo'<script>alert("ERROR: '.oci_error($insertstmt).'")</script>';
    }
}


oci_close($conn);
?>