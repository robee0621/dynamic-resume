<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$action = $_POST['action'] ?? '';

if ($action === 'add_skill') {
    $stmt = $pdo->prepare("INSERT INTO skills (skill_name) VALUES (?)");
    $stmt->execute([$_POST['skill_name']]);
} 
elseif ($action === 'delete_skill') {
    $stmt = $pdo->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->execute([$_POST['id']]);
}
elseif ($action === 'add_about') {
    $stmt = $pdo->prepare("INSERT INTO about (category, content) VALUES (?, ?)");
    $stmt->execute([$_POST['category'], $_POST['content']]);
}
elseif ($action === 'delete_about') {
    $stmt = $pdo->prepare("DELETE FROM about WHERE id = ?");
    $stmt->execute([$_POST['id']]);
}
elseif ($action === 'add_project') {
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = time() . "_" . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . $fileName)) {
            $imagePath = $fileName;
        }
    }
    $stmt = $pdo->prepare("INSERT INTO projects (title, description, tech_stack, image_path) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['description'], $_POST['tech_stack'], $imagePath]);
}
elseif ($action === 'delete_project') {
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$_POST['id']]);
}
elseif ($action === 'add_edu') {
    $stmt = $pdo->prepare("INSERT INTO education (institution, details, year) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['institution'], $_POST['details'], $_POST['year']]);
}
elseif ($action === 'delete_edu') {
    $stmt = $pdo->prepare("DELETE FROM education WHERE id = ?");
    $stmt->execute([$_POST['id']]);
}

header("Location: admin.php");
exit();
?>