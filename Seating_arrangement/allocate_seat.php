<?php
$host = 'localhost';
$db = 'seating_arrangements';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rollNumber = $_POST['rollNumber'] ?? null;

if ($rollNumber) {
    // Check for existing allocation
    $existingSeatQuery = $conn->prepare("SELECT seat_number FROM seats WHERE roll_number = ?");
    $existingSeatQuery->bind_param("i", $rollNumber);
    $existingSeatQuery->execute();
    $existingSeatResult = $existingSeatQuery->get_result();
    if ($existingSeatResult->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => "Seat already allocated to roll number $rollNumber."]);
        exit;
    }

    // Check for available seat
    $availableSeatQuery = $conn->query("SELECT * FROM seats WHERE occupied = FALSE LIMIT 1");
    if ($availableSeatQuery->num_rows > 0) {
        $seat = $availableSeatQuery->fetch_assoc();
        $updateSeatQuery = $conn->prepare("UPDATE seats SET occupied = TRUE, roll_number = ? WHERE id = ?");
        $updateSeatQuery->bind_param("ii", $rollNumber, $seat['id']);
        $updateSeatQuery->execute();

        echo json_encode(['status' => 'success', 'message' => "Seat number {$seat['seat_number']} allocated to roll number $rollNumber."]);
    } else {
        // Add to waiting list
        $waitingListQuery = $conn->prepare("INSERT INTO waiting_list (roll_number) VALUES (?) ON DUPLICATE KEY UPDATE roll_number = roll_number");
        $waitingListQuery->bind_param("i", $rollNumber);
        $waitingListQuery->execute();
        
        echo json_encode(['status' => 'error', 'message' => "All seats are occupied. Roll number $rollNumber added to waiting list."]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => "Invalid roll number."]);
}

$conn->close();
?>
