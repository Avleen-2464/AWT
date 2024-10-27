<?php
$servername = "localhost"; // Database server
$username = "root"; // MySQL username
$password = ""; // MySQL password (leave empty if none)
$dbname = "qr_attendance"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
