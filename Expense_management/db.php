<?php
ini_set('display_errors', 1);  // Show errors
ini_set('display_startup_errors', 1);  // Show startup errors
error_reporting(E_ALL);  // Report all types of errors

$servername = "localhost";  
$username = "root";  
$password = "";  
$dbname = "expense_management";  

// Create a new connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
