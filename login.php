<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: admin.php");
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body style="background:#0f172a; color:white; display:flex; justify-content:center; align-items:center; height:100vh; font-family:sans-serif;">
    <form method="POST" style="background:#1e293b; padding:40px; border-radius:10px; border:1px solid #38bdf8;">
        <h2 style="margin-top:0;">Admin Login</h2>
        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Username" required style="width:100%; padding:10px; margin-bottom:10px;"><br>
        <input type="password" name="password" placeholder="Password" required style="width:100%; padding:10px; margin-bottom:20px;"><br>
        <button type="submit" style="width:100%; padding:10px; background:#38bdf8; border:none; cursor:pointer;">Login</button>
    </form>
</body>
</html>