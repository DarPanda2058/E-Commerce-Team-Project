<?php
    session_start();
    session_destroy();
    echo '<script>alert("Logged Off Successfully!")</script>';
    $target_url = "main.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $target_url . '">';
?>