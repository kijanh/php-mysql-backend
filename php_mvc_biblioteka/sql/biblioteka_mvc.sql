CREATE DATABASE IF NOT EXISTS biblioteka_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE biblioteka_mvc;

DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS categories;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    author VARCHAR(120) NOT NULL,
    published_year INT NOT NULL,
    category_id INT NOT NULL,
    status ENUM('Dostupna', 'Posuđena') DEFAULT 'Dostupna',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_books_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

INSERT INTO categories (name, description) VALUES
('Roman', 'Književna djela i romani.'),
('Nauka', 'Knjige iz oblasti prirodnih i tehničkih nauka.'),
('Historija', 'Historijske knjige i enciklopedije.');

INSERT INTO books (title, author, published_year, category_id, status) VALUES
('Na Drini ćuprija', 'Ivo Andrić', 1945, 1, 'Dostupna'),
('Kratka historija vremena', 'Stephen Hawking', 1988, 2, 'Posuđena'),
('Bosna i Hercegovina kroz vijekove', 'Grupa autora', 2010, 3, 'Dostupna');
