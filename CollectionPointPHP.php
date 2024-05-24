<?php
    session_start();
    if(isset($_POST["collection_slot"])  ){
        $_SESSION['collectionDate'] = $_POST['date'];
        $_SESSION['collectionTime'] = $_POST['time'];
        header("Location: PaymentOption.php");
    }

?>