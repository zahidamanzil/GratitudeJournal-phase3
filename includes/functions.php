<?php
// Function to sanitize input data to prevent XSS attacks
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to validate gratitude entry
function validate_entry($entry) {
    if (empty($entry)) {
        return "Gratitude entry cannot be empty.";
    }
    return true; // Valid entry
}

// Function to submit a gratitude entry
function submit_gratitude_entry($conn, $user_id, $entry, $category) {
    // Sanitize user input
    $entry = sanitize_input($entry);
    $category = sanitize_input($category);

    // Validate the entry
    $validation_result = validate_entry($entry);
    if ($validation_result !== true) {
        return $validation_result; // Return validation error message if any
    }

    // Insert the entry into the database
    try {
        $stmt = $conn->prepare("INSERT INTO entries (user_id, date, gratitude_text, category) VALUES (?, NOW(), ?, ?)");
        $stmt->execute([$user_id, $entry, $category]);
        return true; // Successfully submitted
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage(); // Return error if insertion fails
    }
}
?>
