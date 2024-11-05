<?php
$host = 'localhost';
$db = 'seating_arrangements';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rollNumber = intval($_POST['rollNumber']);

// Deallocate the seat
$deallocateQuery = "UPDATE seats SET occupied = FALSE, roll_number = NULL WHERE roll_number = ?";
$stmt = $conn->prepare($deallocateQuery);
$stmt->bind_param('i', $rollNumber);
$stmt->execute();

// Check for waiting list
$nextInLineQuery = "SELECT roll_number FROM waiting_list ORDER BY wl_number LIMIT 1";
$nextInLineResult = $conn->query($nextInLineQuery);

if ($nextInLineResult->num_rows > 0) {
    $nextRollNumber = $nextInLineResult->fetch_assoc()['roll_number'];

    // Allocate the seat to the next in line
    $seatQuery = "SELECT seat_number FROM seats WHERE occupied = FALSE LIMIT 1";
    $seatResult = $conn->query($seatQuery);
    if ($seatResult->num_rows > 0) {
        $seatNumber = $seatResult->fetch_assoc()['seat_number'];
        
        // Update the seat
        $updateSeatQuery = "UPDATE seats SET occupied = TRUE, roll_number = ? WHERE seat_number = ?";
        $stmt = $conn->prepare($updateSeatQuery);
        $stmt->bind_param('ii', $nextRollNumber, $seatNumber);
        $stmt->execute();

        // Remove from waiting list
        $removeFromWLQuery = "DELETE FROM waiting_list WHERE roll_number = ?";
        $stmt = $conn->prepare($removeFromWLQuery);
        $stmt->bind_param('i', $nextRollNumber);
        $stmt->execute();
    }
}

echo json_encode(['status' => 'success', 'message' => "Seat deallocated for roll number $rollNumber."]);
$conn->close();
?>
