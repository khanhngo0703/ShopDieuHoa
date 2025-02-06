<?php
$servername = "localhost";
$username = "root";
$password = "";

// Kết nối MySQL
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connect failed: " . $conn->connect_error);
}

// Tạo database nếu chưa có
try {
    $sql = "CREATE DATABASE IF NOT EXISTS project1";
    $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating database: " . $e->getMessage();
    die();
}

// Chọn database
$conn->select_db("project1");

// Tạo bảng collections
try {
    $sql = "CREATE TABLE IF NOT EXISTS categories (
        id INT NOT NULL AUTO_INCREMENT,
        category_name VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";
    $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating collections table: " . $e->getMessage();
}


// Tạo bảng products
try {
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT NOT NULL AUTO_INCREMENT,
        product_name VARCHAR(50) NOT NULL,
        price FLOAT NOT NULL,
        thumbnail VARCHAR(100) NOT NULL,
        category_id INT NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
    )";
    $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating products table: " . $e->getMessage();
}

// Tạo bảng admincp
try {
    $sql = "CREATE TABLE IF NOT EXISTS admincp (
        id INT NOT NULL AUTO_INCREMENT,
        admin_username VARCHAR(50) NOT NULL,
        admin_password VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";
    $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating admincp table: " . $e->getMessage();
}

// Tạo bảng users
try {
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    )";
    $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating users table: " . $e->getMessage();
}
