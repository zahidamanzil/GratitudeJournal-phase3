<?php
session_start();

// If the user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gratitude Journal</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body class="landing-body">

    <header>
        <div id="logoContainer">
            <img src="assets/images/logo1.jpg" alt="Logo" id="logo">
        </div>
        <nav>
            <ul>
                <li><a href="#Home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="contact.php">Contact</a></li> 
            </ul>
        </nav>
    </header>
    
    <main>
        <section id="home" class="landing-section">
            <h2>Welcome to <span class="highlight">Gratitude Journal</span> 🌿</h2>
            <p>Your cozy corner to reflect on the happy, tiny moments in life.</p>
            <p>Sign up and begin your gratitude journey ✨</p>
            <div class="auth-buttons">
                <a href="auth/register.php" class="btn register">Register</a>
                <a href="auth/login.php" class="btn login">Login</a>
            </div>
        </section>
    </main>

    <footer>
        <p>Made with ❤️ for your mental health</p>
        <p>&copy; 2025 Gratitude Journal</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
