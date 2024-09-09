<?php
// Database configuration
$servername = "localhost";  // Replace with your server name
$username = "rimz";         // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "ssp";      // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// You can add this for debugging purposes
// echo "Connected successfully";
?>
