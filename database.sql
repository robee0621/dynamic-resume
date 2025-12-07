CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

CREATE TABLE about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50),
    content TEXT
);

CREATE TABLE skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(100)
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT,
    tech_stack VARCHAR(255),
    image_path VARCHAR(255)
);

CREATE TABLE education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    institution VARCHAR(100),
    details VARCHAR(255),
    year VARCHAR(50)
);

INSERT INTO about (category, content) VALUES ('Motto', 'Code is poetry, logic is art.');
INSERT INTO skills (skill_name) VALUES ('Java'), ('PHP'), ('MySQL'), ('Python');
INSERT INTO education (institution, details, year) VALUES ('Emilio Aguinaldo College - Cavite', 'BS Computer Science', '2026');