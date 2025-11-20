<?php
include "../db.php";

$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$data = [];

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

echo json_encode($data);
?>
