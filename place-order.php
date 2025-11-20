<?php
session_start();
include "db.php";
header("Content-Type: text/plain");

// Check login
if(!isset($_SESSION['user_id'])){
    echo "not-logged";
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if(!$data){
    echo "invalid";
    exit;
}

$user_id = $_SESSION['user_id'];
$items = json_encode($data['items'], JSON_UNESCAPED_UNICODE);
$total = $data['total'];
$payment = $data['payment'];

// Insert Order
$sql = "INSERT INTO orders (user_id, items, total_amount, payment_method, status)
        VALUES (?, ?, ?, ?, 'Pending')";
$stmt = $conn->prepare($sql);

$stmt->bind_param("isis", $user_id, $items, $total, $payment);

if($stmt->execute()){
    echo "success";
} else {
    echo "error";
}
?>
