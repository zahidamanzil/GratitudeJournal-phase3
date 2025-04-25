<?php
session_start();
include ('includes/db.php'); 

// Check if form is submitted
if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']); // Sanitize user input
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    try {
        // Prepare SQL query to insert the message
        $query = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $conn->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        
        // Execute the query
        $stmt->execute();
        
        // Redirect to dashboard after successful submission
        header("Location: dashboard.php");
        exit();
        
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your styles -->
</head>
<body>

    <header>
        <div id="logoContainer">
            <img src="assets/images/logo1.jpg" alt="Logo" id="logo">
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="contact-form-container">
            <h2>Contact Us</h2>
            <form action="contact.php" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Gratitude Journal</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html> 
