<?php
require "db.php";

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$password = $_POST['password'] ?? '';

if (!$name || !$email || !$password) {
    echo "Missing fields";
    exit;
}

// secure password
$hashed = password_hash($password, PASSWORD_DEFAULT);

// insert into DB
$sql = "INSERT INTO users (full_name, email, phone, password, role, created_at)
        VALUES (?, ?, ?, ?, 'user', NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone, $hashed);

if($stmt->execute()){
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conn->close();
?>
