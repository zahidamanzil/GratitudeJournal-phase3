Gratitude Journal
Welcome to Gratitude Journal! A simple, mindful web application designed to help you reflect on the positive moments in life. Write down what you're grateful for every day, track your progress, and celebrate your journey toward mindfulness and happiness.

Features:
User Authentication: Sign up, log in, and manage your account.

Daily Gratitude Entries: Write and save your gratitude thoughts.

Calendar View: Easily navigate through your entries and track your daily gratitude.

Insights: Visual analysis of your gratitude categories to help you reflect on patterns.

Contact Us: Submit queries and feedback directly through the app.

Tech Stack:
Frontend: HTML, CSS, JavaScript

Backend: PHP

Database: MySQL

Server: XAMPP

##Setup Steps
1. Import the Database
To set up the database, follow these steps:

Create the Database:

Open phpMyAdmin in your browser by going to http://localhost/phpmyadmin/.

Click on the Databases tab and create a new database named gratitude_journal.

Import the SQL File:

Download or clone the project.

Inside the project folder, find the SQL file (e.g., gratitude_journal.sql).

In phpMyAdmin, select the gratitude_journal database you just created.

Go to the Import tab and choose the gratitude_journal.sql file.

Click Go to import the database.

2. Run the Project Using XAMPP
To run this project using XAMPP, follow these steps:

Install XAMPP:

If you haven't installed XAMPP yet, download it from XAMPP Official Website.

Install XAMPP and open the XAMPP Control Panel.

Start Apache and MySQL:

In the XAMPP Control Panel, click on Start next to Apache and MySQL. These services are required to run the project.

Move Project to XAMPP's htdocs Directory:

Copy or move your project folder (e.g., GratitudeJournal) into the htdocs folder inside the XAMPP directory (e.g., C:\xampp\htdocs\).

Edit the db.php File (If Necessary):

Inside the project folder, open the includes/db.php file.

Make sure your database settings match the ones you've set up in XAMPP:
eg:
$host = "localhost";
$dbname = "gratitude_journal";
$username = "root";
$password = ""; // Default XAMPP setup
Access the Project:


click here to view: 
https://github.com/zahidamanzil/GratitudeJournal-phase3



Feel free to fork, contribute, or improve the project! Open an issue if you encounter any bugs or have suggestions for new features.

License
Made with ❤️ for your mental health.
(c) 2025 Gratitude Journal









