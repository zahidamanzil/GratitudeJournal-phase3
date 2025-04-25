<?php
session_start();
include("../includes/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$username, $email, $hashed_password]);
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['username'] = $username;
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            $error_message = "Error: " . $e->getMessage(); // You can customize this later
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../style.css">

</head>
<body>
    <div class= "auth-form-container">
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="your name" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="email address"required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="create a password"required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="enter your password again" required>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>
</body>
</html>
