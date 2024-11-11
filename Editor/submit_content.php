<?php
// submit_content.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "content_db";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'content' parameter is set
if (isset($_POST['content'])) {
    $content = $conn->real_escape_string($_POST['content']);

    // Insert content into the database
    $sql = "INSERT INTO editor_content (content) VALUES ('$content')";

    if ($conn->query($sql) === TRUE) {
        // Display highlighted success message
        echo "<div class='alert success'>Content submitted successfully!</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<style>
/* Styling for success message */
.alert.success {
    background-color: #4CAF50; /* Green background */
    color: white;              /* White text */
    padding: 15px;
    margin: 10px 0;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
}
</style>
