<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged Out</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .logout-message {
            text-align: center;
            margin-top: 100px;
            font-size: 1.8rem;
            color: #305c38;
        }

        .logout-message a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #a8dab5;
            color: #2d4730;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .logout-message a:hover {
            background-color: #89c89c;
        }
    </style>
</head>
<body>
    <div class="logout-message">
        <p>You've been logged out 🌱</p>
        <a href="../index.php">Take me home</a>
    </div>
</body>
</html>

