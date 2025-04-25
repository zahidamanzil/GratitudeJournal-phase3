<?php
$host = "localhost";
$dbname = "gratitude_journal";
$username = "root";
$password = ""; // default XAMPP setup

try {
    $conn = new PDO("mysql:host=$host;port=3307;dbname=$dbname", $username, $password);
    // Set error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database connected successfully!";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
