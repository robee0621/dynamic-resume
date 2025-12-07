<?php
require 'db.php';

$new_username = 'admin';
$new_password = 'password123';

$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

try {
    $pdo->exec("DELETE FROM users WHERE username = '$new_username'");

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$new_username, $hashed_password]);

    echo "<h1>Success!</h1>";
    echo "<p>Admin user has been reset.</p>";
    echo "<ul>";
    echo "<li>Username: <strong>$new_username</strong></li>";
    echo "<li>Password: <strong>$new_password</strong></li>";
    echo "</ul>";
    echo "<p><a href='login.php'>Go to Login Page</a></p>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>