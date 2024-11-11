<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'portfolio_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch profile information
$profile_query = "SELECT email, linkedin FROM profile_info LIMIT 1";
$profile_result = $conn->query($profile_query);

if ($profile_result->num_rows > 0) {
    $profile = $profile_result->fetch_assoc();
} else {
    echo "No profile information found.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert message into database
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql)) {
        echo "Message sent successfully!";

        // Send email notification
        $to = 'your-email@example.com';  // Replace with your email address
        $subject = "New Message from $name";
        $body = "You have received a new message from $name.\n\n" .
                "Email: $email\n" .
                "Message:\n$message";
        $headers = "From: noreply@example.com";  // Replace with a suitable sender email

        // Use PHP's mail function
        if (mail($to, $subject, $body, $headers)) {
            echo "Email notification sent!";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
