<?php
session_start();

if (isset($_POST['total_price'])) {
    $total_price = $_POST['total_price'];
    $_SESSION['totalPrice'] = $total_price;
    echo json_encode(['status' => 'success', 'total_price' => $total_price]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Total price not set']);
}
?>