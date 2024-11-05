<?php
$host = 'localhost'; // Your database host
$db = 'seating_arrangements'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all seats
$query = "SELECT seat_number, occupied FROM seats ORDER BY seat_number";
$result = $conn->query($query);

$seats = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }
    echo json_encode(['status' => 'success', 'seats' => $seats]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No seats found.']);
}

$conn->close();
?>
