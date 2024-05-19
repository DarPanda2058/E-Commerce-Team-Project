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
    $image_temp = $_FILES['pimage']['tmp_name']; // Temporary file path

    //session-part

    // $trader_id = $_SESSION['user_id'];

    // // Query to get the shop_id
    // $shop_id_query = "SELECT shop_id FROM shop WHERE trader_id = :trader_id";

    // // Prepare the statement
    // $shop_id_stmt = oci_parse($conn, $shop_id_query);

    // // Bind the trader_id parameter
    // oci_bind_by_name($shop_id_stmt, ':trader_id', $trader_id);

    // // Execute the statement
    // oci_execute($shop_id_stmt);

    // // Fetch the result
    // $shop_id = null;
    // if ($row = oci_fetch_assoc($shop_id_stmt)) {
    //     $shop_id = $row['SHOP_ID'];
    // }

    $destination = "images/" . $pimage; 
    if (move_uploaded_file($image_temp, $destination)){
        $query = "INSERT INTO PRODUCT(PRODUCT_NAME,PRODUCT_PRICE,PRODUCT_IMAGE,PRODUCT_CATEGORY,PRODUCT_MAX_LIMIT,PRODUCT_DETAILS,PRODUCT_QUANTITY,PRODUCT_STATUS,SHOP_ID) VALUES('$pname','$pprice','$pimage','$pcategory','$porderlim','$pdesc','$pstock',1,102)";
        $insertstmt = oci_parse($conn,$query);
        if(oci_execute($insertstmt)){
            echo'<script>alert("Data Inserted Successfully!")</script>';
    
            header('Location: ManageProduct.php');
            
        }else{
            echo'<script>alert("ERROR: Data Not Inserted'.oci_error($insertstmt).'")</script>';
    
            header('Location: AddProduct.php');
            
        }
    }
};


oci_close($conn);
?>