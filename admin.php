<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$about = $pdo->query("SELECT * FROM about")->fetchAll();
$skills = $pdo->query("SELECT * FROM skills")->fetchAll();
$projects = $pdo->query("SELECT * FROM projects")->fetchAll();
$education = $pdo->query("SELECT * FROM education")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .section-card { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { border-bottom: 2px solid #38bdf8; padding-bottom: 10px; }
        input, textarea { width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #38bdf8; border: none; padding: 10px 15px; color: white; border-radius: 4px; cursor: pointer; }
        .delete-btn { background: #ef4444; font-size: 0.8rem; padding: 5px 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td, th { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
        .logout { float: right; background: #ef4444; text-decoration: none; padding: 10px; color: white; border-radius: 4px; }
    </style>
</head>
<body>

<div class="container">
    <a href="logout.php" class="logout">Logout</a>
    <a href="index.php" target="_blank" style="float:right; margin-right:10px; padding:10px;">View Site</a>
    <h1>Dashboard</h1>

    <div class="section-card">
        <h2>Manage 'About Me'</h2>
        <form action="actions.php" method="POST">
            <input type="hidden" name="action" value="add_about">
            <input type="text" name="category" placeholder="Category (e.g., Motto, Fear)" required>
            <textarea name="content" placeholder="Content" required></textarea>
            <button type="submit">Add Item</button>
        </form>
        <table>
            <?php foreach($about as $row): ?>
            <tr>
                <td><b><?= $row['category'] ?></b>: <?= substr($row['content'], 0, 50) ?>...</td>
                <td>
                    <form action="actions.php" method="POST" style="margin:0;">
                        <input type="hidden" name="action" value="delete_about">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="section-card">
        <h2>Manage Skills</h2>
        <form action="actions.php" method="POST" style="display:flex; gap:10px;">
            <input type="hidden" name="action" value="add_skill">
            <input type="text" name="skill_name" placeholder="New Skill (e.g. Docker)" required>
            <button type="submit">Add</button>
        </form>
        <div style="margin-top:10px;">
            <?php foreach($skills as $row): ?>
                <div style="display:inline-block; background:#eee; padding:5px 10px; margin:2px; border-radius:15px;">
                    <?= $row['skill_name'] ?>
                    <form action="actions.php" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="delete_skill">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="delete-btn" style="padding:2px 5px;">x</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section-card">
        <h2>Manage Projects</h2>
        <form action="actions.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_project">
            <input type="text" name="title" placeholder="Project Title" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="text" name="tech_stack" placeholder="Tech Stack (e.g. PHP, MySQL)" required>
            <label>Project Image:</label>
            <input type="file" name="image" accept="image/*">
            <button type="submit">Add Project</button>
        </form>
        <table>
            <?php foreach($projects as $row): ?>
            <tr>
                <td><?= $row['title'] ?></td>
                <td>
                    <form action="actions.php" method="POST">
                        <input type="hidden" name="action" value="delete_project">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="section-card">
        <h2>Manage Education</h2>
        <form action="actions.php" method="POST">
            <input type="hidden" name="action" value="add_edu">
            <input type="text" name="institution" placeholder="School Name" required>
            <input type="text" name="details" placeholder="Degree/Certificate" required>
            <input type="text" name="year" placeholder="Year" required>
            <button type="submit">Add Education</button>
        </form>
        <table>
            <?php foreach($education as $row): ?>
            <tr>
                <td><?= $row['institution'] ?> (<?= $row['year'] ?>)</td>
                <td>
                    <form action="actions.php" method="POST">
                        <input type="hidden" name="action" value="delete_edu">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

</div>
</body>
</html>