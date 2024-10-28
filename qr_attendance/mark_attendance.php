<?php
include 'db.php'; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Status</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 500px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php
        // Get the scanned URN from the request
        if (isset($_GET['urn'])) {
            $urn = $_GET['urn'];

            // Check if the URN exists in the students table and retrieve the student's name
            $sql = "SELECT name FROM students WHERE urn = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $urn);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc();
                $name = $student['name'];

                // Check if the URN has already been marked in the attendance table
                $checkAttendanceSql = "SELECT * FROM attendance WHERE urn = ?";
                $checkAttendanceStmt = $conn->prepare($checkAttendanceSql);
                $checkAttendanceStmt->bind_param("s", $urn);
                $checkAttendanceStmt->execute();
                $attendanceResult = $checkAttendanceStmt->get_result();

                if ($attendanceResult->num_rows > 0) {
                    // Display message if attendance already marked
                    echo "<div class='alert alert-info' role='alert'>
                            Attendance has already been marked for <strong>" . htmlspecialchars($name) . "</strong>
                          </div>";
                } else {
                    // Mark attendance in the attendance table
                    $timestamp = date("Y-m-d H:i:s");
                    $insertSql = "INSERT INTO attendance (urn, timestamp) VALUES (?, ?)";
                    $insertStmt = $conn->prepare($insertSql);
                    $insertStmt->bind_param("ss", $urn, $timestamp);
                    $insertStmt->execute();

                    // Display success message
                    echo "<div class='alert alert-success' role='alert'>
                            Attendance successfully marked for <strong>" . htmlspecialchars($name) . "</strong>
                          </div>";
                }

                $checkAttendanceStmt->close();
            } else {
                // Display error message for invalid URN
                echo "<div class='alert alert-danger' role='alert'>
                        Invalid URN: <strong>" . htmlspecialchars($urn) . "</strong>. Please try again.
                      </div>";
            }

            $stmt->close();
            $conn->close();
        } else {
            // Display message when no URN is provided
            echo "<div class='alert alert-warning' role='alert'>
                    No URN provided.
                  </div>";
        }
        ?>
        <a href="index.php" class="btn btn-primary mt-3">Go Back to Scanner</a>
    </div>
</body>
</html>
