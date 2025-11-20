<?php
$host = "localhost";
$user = "u757851891_alhurwear";   // MySQL user
$pass = "Khanjain786@$";          // Your database password
$dbname = "u757851891_alhurwear_db";  // Database name

$conn = mysqli_connect($host, $user, $pass, $dbname);

if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}
?>
