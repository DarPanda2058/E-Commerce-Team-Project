<?php
    include('connect.php');
    session_start();
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
    $image_temp = $_FILES['pimage']['tmp_name']; // Temporary file path


    $destination = "images/" . $pimage; 
    $shop_id = $_SESSION['shopID'];
    if (move_uploaded_file($image_temp, $destination)){
        $query = "INSERT INTO PRODUCT(PRODUCT_NAME,PRODUCT_PRICE,PRODUCT_IMAGE,PRODUCT_CATEGORY,PRODUCT_MAX_LIMIT,PRODUCT_DETAILS,PRODUCT_QUANTITY,PRODUCT_STATUS,SHOP_ID) VALUES('$pname','$pprice','$pimage','$pcategory','$porderlim','$pdesc','$pstock',0,'$shop_id')";
        $insertstmt = oci_parse($conn,$query);
        if(oci_execute($insertstmt)){
            echo'<script>alert("Data Inserted Successfully!")</script>';
    
            $target_url = "ManageProduct.php";
            echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
            
        }else{
            echo'<script>alert("ERROR: Data Not Inserted'.oci_error($insertstmt).'")</script>';
    

            $target_url = "AddProduct.php";
            echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
            
        }
    }
};


oci_close($conn);
?>