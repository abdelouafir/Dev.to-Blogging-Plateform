-- Active: 1733741706668@@127.0.0.1@3306@devblog_db
    DROP DATABASE IF EXISTS devblog_db;
    CREATE DATABASE devblog_db;

    -- Connect to the database
    USE devblog_db;


    -- Create users table first
    CREATE TABLE users (
        id BIGINT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(20) NOT NULL UNIQUE,
        email VARCHAR(255) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        profile_picture_url VARCHAR(255),0
        role ENUM('user', 'admin', 'author') NOT NULL DEFAULT 'user'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    -- Create categories table
    CREATE TABLE categories (
        id BIGINT PRIMARY KEY AUTO_INCREMENT,
        name TEXT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    -- Create articles table with proper foreign keys
    CREATE TABLE articles (
        id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        category_id BIGINT NOT NULL,
        author_id BIGINT NOT NULL,
        views INTEGER DEFAULT 0,
        KEY idx_articles_category (category_id),
        KEY idx_articles_author (author_id),
        CONSTRAINT fk_articles_category FOREIGN KEY (category_id) 
            REFERENCES categories (id),
        CONSTRAINT fk_articles_author FOREIGN KEY (author_id) 
            REFERENCES users (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    -- Create tags table
    CREATE TABLE tags (
        id BIGINT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL UNIQUE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    -- Create article_tags table
    CREATE TABLE article_tags (
        article_id BIGINT UNSIGNED,
        tag_id BIGINT,
        PRIMARY KEY (article_id, tag_id),
        CONSTRAINT fk_article_tags_article FOREIGN KEY (article_id) 
            REFERENCES articles (id) ON DELETE CASCADE,
        CONSTRAINT fk_article_tags_tag FOREIGN KEY (tag_id) 
            REFERENCES tags (id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
