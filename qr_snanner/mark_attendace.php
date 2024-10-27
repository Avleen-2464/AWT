<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'attendance_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crn = $_POST['crn'];

    // Check if CRN is valid
    if (!empty($crn)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO attendance (id, crn, timestamp) VALUES (1,?, NOW())");
        $stmt->bind_param("s", $crn); // "s" indicates the type is string

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Attendance marked for CRN: ' . $crn]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to mark attendance: ' . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No CRN provided']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

// Close the database connection
$conn->close();
?>
