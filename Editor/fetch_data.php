<?php
// fetch_data.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "content_db";
$port=3307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all content from the database
$sql = "SELECT content, created_at FROM editor_content ORDER BY created_at DESC";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output the content
    while($row = $result->fetch_assoc()) {
        echo "<div class='submitted-content'>";
        echo "<p><strong>Submitted on:</strong> " . $row['created_at'] . "</p>";
        echo "<div>" . $row['content'] . "</div><hr>";
        echo "</div>";
    }
} else {
    echo "No content submitted yet.";
}

$conn->close();
?>
