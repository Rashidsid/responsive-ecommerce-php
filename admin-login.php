<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - AlhurWear</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin:0; font-family:Arial; background:#16a085; display:flex; justify-content:center; align-items:center; height:100vh; }
        .card { background:#fff; padding:30px; border-radius:14px; width:100%; max-width:370px; box-shadow:0 12px 30px rgba(0,0,0,.2); }
        h1 { margin-bottom:8px; font-size:24px; text-align:center; }
        .field { margin-bottom:15px; }
        input { width:100%; padding:10px; border-radius:8px; border:1px solid #ccc; font-size:15px; }
        button { width:100%; padding:10px; border-radius:999px; background:#3498db; color:#fff; font-weight:600; border:none; cursor:pointer; font-size:15px; }
        .msg { margin-top:12px; color:#e74c3c; text-align:center; min-height:20px;}
    </style>
</head>
<body>
<div class="card">
    <h1>Admin Login</h1>

    <form id="admin-login-form">
        <div class="field">
            <input id="admin-email" type="email" placeholder="Email" required value="admin@alhurwear.com">
        </div>
        <div class="field">
            <input id="admin-password" type="password" placeholder="Password" required>
        </div>
        <button type="submit">Login</button>
        <div id="login-message" class="msg"></div>
    </form>
</div>

<script>
document.getElementById("admin-login-form").addEventListener("submit", function(e){
    e.preventDefault();

    const email = document.getElementById("admin-email").value.trim();
    const password = document.getElementById("admin-password").value.trim();
    const msg = document.getElementById("login-message");

    fetch("backend/admin-login.php", {
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:`email=${email}&password=${password}`
    })
    .then(res=>res.text())
    .then(data => {
        data = data.trim();
        if(data === "success"){
            msg.textContent = "Login successful... redirecting";
            msg.style.color = "green";
            window.location.href = "admin-panel.php";
        } else {
            msg.textContent = "Invalid credentials";
            msg.style.color = "red";
        }
    });
});
</script>
</body>
</html>
