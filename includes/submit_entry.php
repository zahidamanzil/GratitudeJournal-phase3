<?php
session_start();
include 'db.php'; // Include database connection
include 'functions.php'; // Include helper functions

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Process the form when submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID
    $entry = $_POST['entry']; // Get the gratitude entry text
    $category = $_POST['category']; // Get the category

    // Use the helper function to submit the entry
    $result = submit_gratitude_entry($conn, $user_id, $entry, $category);

    if ($result === true) {
        // If the entry was successfully submitted, redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // If there was an error, show the error message
        echo "<p>Error: $result</p>";
    }
}
?>
