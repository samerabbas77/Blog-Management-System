-- Step 1: Check if the database exists, and create it if it does not exist
CREATE DATABASE IF NOT EXISTS blog_db;

-- Step 2: Select the `blog_db` database
USE blog_db;

 -- Step 3: Check if the `posts` table exists, and create it if it does not exist
CREATE TABLE IF NOT EXISTS posts (
    id INT(15) AUTO_INCREMENT,
    title VARCHAR(255),
    content TEXT,
    author VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

