<?php
// Database configuration
$host = 'localhost'; // Change if your database is hosted elsewhere
$username = 'root'; // Default username for local development
$password = ''; // Default password for local development (leave blank)
$database = 'responses'; // Database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set the character set to UTF-8
$conn->set_charset("utf8");

// You can now use $conn to interact with the database
?>