<?php
session_start();
include('includes/db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

// Check if the form is submitted
if (isset($_POST['submit_entry'])) {
    // Get form data and sanitize input
    $user_id = $_SESSION['user_id'];
    $gratitude_text = htmlspecialchars($_POST['entry']); // Sanitize the entry text
    $category = htmlspecialchars($_POST['category']); // You can use this if you want to store category as well
    $date = date('Y-m-d'); // Current date

    try {
        // Prepare SQL query to insert the entry
        $query = "INSERT INTO entries (user_id, date, gratitude_text) VALUES (:user_id, :date, :gratitude_text)";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':gratitude_text', $gratitude_text);

        // Execute the query
        $stmt->execute();
        
        // Redirect to dashboard after successfully adding the entry
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
    <title>Gratitude Journal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div id="logoContainer">
            <img src="./assets/images/logo1.jpg" alt="Logo" id="logo">
        </div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#entries">Entries</a></li>
                <li><a href="#calendar">Calendar</a></li>
                <li><a href="#insights">Insights</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section id="dashboard">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <p>Your personal space to reflect on the positive moments in life.</p>
        </section>

        <section id="home">
            <div id="slideshow">
                <img src="./assets/images/dayy2.jpg" alt="Slide 1" class="slide">
                <img src="./assets/images/dayy3.jpg" alt="Slide 2" class="slide">
                <img src="./assets/images/dayy1.jpg" alt="Slide 3" class="slide">
                <img src="./assets/images/dayy.jpg" alt="Slide 4" class="slide">
            </div>
        </section>

 <section id="entries">
    <h2>Daily Gratitude Entry</h2>
    <form method="POST" action="dashboard.php">
        <label for="entry">What are you grateful for today?</label>
        <textarea id="entry" name="entry" placeholder="Write your gratitude entry here..." required></textarea>

        <label for="category">Category</label>
        <select id="category" name="category">
            <option value="family">Family</option>
            <option value="work">Work</option>
            <option value="health">Health</option>
            <option value="Food">Food</option>
            <option value="Other">Other</option>
        </select>

        <button type="submit" name="submit_entry">Add</button>
        <button type="reset">Cancel</button>
    </form>
</section>


        <section id="savedEntries">
            <h2>Your Gratitude Entries</h2>
            <ul id="entriesList">
                <?php foreach ($entries as $entry): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($entry['title']); ?></h3>
                        <p><?php echo nl2br(htmlspecialchars($entry['content'])); ?></p>
                        <small>Category: <?php echo htmlspecialchars($entry['category']); ?> | Posted on <?php echo $entry['created_at']; ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
        
        <section id="calendar">
            <h2>Calendar View</h2>
            <div id="calendarHeader">
                <button id="prevMonth">←</button>
                <span id="currentMonthYear"></span>
                <button id="nextMonth">→</button>
            </div>
            <div id="dayNames">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div id="calendarContainer"></div>
            <div id="selectedDateEntries" style="display: none;">
                <h3>Entries for <span id="selectedDate"></span></h3>
                <ul id="entriesForDateList"></ul>
                <button id="closeSelectedDateEntries">Close</button>
            </div>

        </section>

        <section id="insights">
            <h2>Insights</h2>
            <div id="categoryAnalysis" class="form-select">
                <h3>Most Common Categories</h3>
                <ul id="categoryList">
                    <!-- Categories List -->
                </ul>
            </div>
        </section>

        <!-- Logout Form -->
        <form action="auth/logout.php" method="post" style="display:inline;">
            <button type="submit" class="logout-btn">Logout 💚</button>
        </form>
    </main>

    <footer>
        <p>Made with ❤️ for your mental health</p>
        <p>&copy; 2025 Gratitude Journal</p>
        <ul>
            <li><a href="#about">About Us</a></li>
            <li><a href="#privacy">Privacy Policy</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </footer>

    <script src="script.js"></script>
</body>
</html>
