<?php
session_start(); // Start session

include("../includes/db.php");
 // Include database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Find the user in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Check if the user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Store user id in session
        $_SESSION['username'] = $user['username']; // Store username in session
        header("Location: ../index.php"); // Redirect to homepage
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class= "auth-form-container">
    <h2>Login</h2>
    <?php if (isset($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" required> 

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required> <br>

        <button type="submit">Login</button>
    </form>
    <p>Don’t have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
