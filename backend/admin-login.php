<?php
session_start();
require "../db.php";     // <-- your existing db.php in root

$email    = $_POST['email']    ?? '';
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    echo "invalid";
    exit;
}

$sql  = "SELECT * FROM users WHERE email = ? AND role = 'admin' LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // DB contains md5('admin123')
    if (md5($password) === $row['password']) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name']  = $row['full_name'];
        $_SESSION['admin_email'] = $row['email'];
        echo "success";
    } else {
        echo "invalid";
    }
} else {
    echo "invalid";
}
