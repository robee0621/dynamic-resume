<?php
require 'db.php';
$about = $pdo->query("SELECT * FROM about")->fetchAll();
$skills = $pdo->query("SELECT * FROM skills")->fetchAll();
$projects = $pdo->query("SELECT * FROM projects")->fetchAll();
$education = $pdo->query("SELECT * FROM education")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Robert Escurel | Portfolio</title>
    <style>
        :root { --bg-color: #0f172a; --card-bg: #1e293b; --text-primary: #f8fafc; --text-secondary: #94a3b8; --accent: #38bdf8; }
        body { font-family: 'Segoe UI', sans-serif; background: var(--bg-color); color: var(--text-primary); margin: 0; line-height: 1.6; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 20px; }
        section { padding: 60px 0; border-bottom: 1px solid #334155; }
        h2 { color: var(--accent); text-align: center; font-size: 2.5rem; margin-bottom: 40px; }
        .btn { padding: 10px 20px; background: var(--accent); color: #000; text-decoration: none; border-radius: 5px; font-weight: bold; }
        
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
        .card { background: var(--card-bg); padding: 25px; border-radius: 10px; border-left: 4px solid var(--accent); }
        .skill-tag { display: inline-block; background: var(--card-bg); border: 1px solid #334155; padding: 8px 15px; border-radius: 20px; margin: 5px; color: var(--accent); }
        
        .project-img { width: 100%; height: 200px; object-fit: cover; border-radius: 5px; margin-bottom: 15px; }

        .admin-link { position: fixed; bottom: 20px; right: 20px; background: rgba(0,0,0,0.5); padding: 10px; border-radius: 5px; font-size: 0.8rem; }
    </style>
</head>
<body>

    <header style="text-align: center; padding: 100px 0;">
        <h1>John Robert Escurel</h1>
        <p style="color: var(--text-secondary)">Aspiring Software Engineer</p>
        <br>
        <a href="#projects" class="btn">View Work</a>
    </header>

    <section id="about">
        <div class="container">
            <h2>About Me</h2>
            <div class="grid">
                <?php foreach ($about as $a): ?>
                <div class="card">
                    <h3 style="color: var(--accent)"><?= htmlspecialchars($a['category']) ?></h3>
                    <p><?= htmlspecialchars($a['content']) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="skills">
        <div class="container" style="text-align: center;">
            <h2>Skills</h2>
            <?php foreach ($skills as $s): ?>
                <span class="skill-tag"><?= htmlspecialchars($s['skill_name']) ?></span>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="projects">
        <div class="container">
            <h2>Projects</h2>
            <div class="grid">
                <?php foreach ($projects as $p): ?>
                <div class="card" style="border-left: none; border-top: 4px solid var(--accent);">
                    <?php if(!empty($p['image_path'])): ?>
                        <img src="uploads/<?= htmlspecialchars($p['image_path']) ?>" class="project-img" alt="Project Image">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($p['title']) ?></h3>
                    <p style="font-size: 0.9rem; color: var(--text-secondary)"><?= htmlspecialchars($p['description']) ?></p>
                    <small style="color: var(--accent)">Stack: <?= htmlspecialchars($p['tech_stack']) ?></small>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="education">
        <div class="container">
            <h2>Education</h2>
            <?php foreach ($education as $e): ?>
            <div class="card" style="text-align: center; margin-bottom: 20px;">
                <h3><?= htmlspecialchars($e['institution']) ?></h3>
                <p><?= htmlspecialchars($e['details']) ?></p>
                <small><?= htmlspecialchars($e['year']) ?></small>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer style="text-align: center; padding: 40px; color: var(--text-secondary);">
        <p>Email: johnrobert.escurel.cvt@eac.edu.ph | GitHub: robee0621</p>
    </footer>

    <a href="login.php" class="admin-link">Admin Login</a>

</body>
</html>