<?php
session_start();
session_unset();
session_destroy();

// Redirect based on user type
if(isset($_SESSION['admin'])){
    header("Location: admin-login.php");
} else {
    header("Location: index.php");
}
exit();
?>
