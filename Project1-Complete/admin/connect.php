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
    $sql = "CREATE TABLE IF NOT EXISTS collections (
        id INT NOT NULL AUTO_INCREMENT,
        collection_name VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";
    $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating collections table: " . $e->getMessage();
}

// Tạo bảng stylists
try {
    $sql = "CREATE TABLE IF NOT EXISTS stylists (
        id INT NOT NULL AUTO_INCREMENT,
        stylist_name VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";
    $conn->query($sql);
} catch (Exception $e) {
    echo "Error creating stylists table: " . $e->getMessage();
}

// Tạo bảng products (sau khi đã có collections và stylists)
try {
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT NOT NULL AUTO_INCREMENT,
        product_name VARCHAR(50) NOT NULL,
        price FLOAT NOT NULL,
        thumbnail VARCHAR(100) NOT NULL,
        collection_id INT NOT NULL,
        stylist_id INT NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (collection_id) REFERENCES collections(id) ON DELETE CASCADE,
        FOREIGN KEY (stylist_id) REFERENCES stylists(id) ON DELETE CASCADE
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