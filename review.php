<?php
    include('connect.php');
    if(!isset($_SESSION)){
        session_start();
    }
?>
<?php
    if(isset($_POST['reviewSubmit'])){
        $product_id = $_POST['product_id'];
        $review_desc = $_POST['review'];
        $product_rating = $_POST['rating'];
        $user_id = $_SESSION['userID'];
        echo $product_id;
        echo $review_desc;
        echo $product_rating;

        $reviewquery = "INSERT INTO REVIEW(REVIEW_DESC,REVIEW_RATING,PRODUCT_ID,USER_ID)VALUES('$review_desc','$product_rating','$product_id','$user_id')";
        $reviewstmt = oci_parse($conn,$reviewquery);
        if(oci_execute($reviewstmt)){
            $target_url = "CustomerOrders.php";
            echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
        }

    }
?>

