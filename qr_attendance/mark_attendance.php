<?php
include 'db.php'; // Include database connection

// Get the scanned URN from the request
if (isset($_GET['urn'])) {
    $urn = $_GET['urn'];

    // Check if the URN exists in the students table
    $sql = "SELECT * FROM students WHERE urn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $urn);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Mark attendance in the attendance table
        $timestamp = date("Y-m-d H:i:s");
        $insertSql = "INSERT INTO attendance (urn, timestamp) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ss", $urn, $timestamp);
        $insertStmt->execute();
        
        echo "Attendance marked for URN: " . htmlspecialchars($urn);
    } else {
        echo "Invalid URN: " . htmlspecialchars($urn);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No URN provided.";
}
?>
