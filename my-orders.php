<?php
session_start();
include "db.php";

// Check if logged in
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch orders for this user
$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>My Orders</title>
<link rel="stylesheet" href="css/style.css">
<style>
.order-card {
    background:#fff;
    margin:15px auto;
    padding:18px;
    border-radius:10px;
    max-width:600px;
    border:1px solid #ddd;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
}
.order-card p { font-size:1.5rem; margin:6px 0; }
.order-status { color:orange; font-weight:700; }
</style>
</head>
<body>

<h2 style="text-align:center; margin-top:30px;">My Orders</h2>

<?php 
if($result->num_rows === 0){
    echo "<p style='text-align:center;font-size:1.6rem;margin-top:20px;'>No orders found.</p>";
}
?>

<?php while($row = $result->fetch_assoc()): ?>
<?php
// Decode JSON items
$items = json_decode($row['items'], true);
?>
<div class="order-card">
    <p><b>Order ID:</b> <?= $row['id'] ?></p>
    <p><b>Date:</b> <?= $row['created_at'] ?></p>
    <p><b>Payment:</b> <?= $row['payment_method'] ?></p>
    <p><b>Total:</b> Rs <?= $row['total_amount'] ?></p>
    <p><b>Status:</b> <span class="order-status"><?= $row['status'] ?></span></p>
    <hr>
    <p><b>Items:</b></p>

    <?php foreach($items as $item): ?>
      <p><?= $item['title'] ?> &nbsp; × <?= $item['qty'] ?> &nbsp; (Color: <?= $item['color'] ?>)</p>
    <?php endforeach; ?>

</div>
<?php endwhile; ?>

</body>
</html>
