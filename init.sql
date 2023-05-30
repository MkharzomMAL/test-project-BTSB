-- init.sql
CREATE DATABASE IF NOT EXISTS web_DB;

USE web_DB;

CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password, email) VALUES
    ('john_doe', 'password123', 'john@example.com'),
    ('jane_smith', 'secret456', 'jane@example.com');
