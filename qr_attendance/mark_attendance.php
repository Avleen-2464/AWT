<?php
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Status</title>
    <!-- Include Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            text-align: center;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .alert {
            font-size: 1.1rem;
        }

        .btn {
            font-size: 1rem;
            padding: 10px 20px;
        }

        h1 {
            font-size: 1.5rem;
            color: #343a40;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Attendance Status</h1>
        <?php
        if (isset($_GET['urn'])) {
            $urn = $_GET['urn'];

            // Check if URN exists in the database
            $sql = "SELECT name FROM students WHERE urn = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $urn);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc();
                $name = $student['name'];

                // Check if attendance is already marked
                $checkAttendanceSql = "SELECT * FROM attendance WHERE urn = ?";
                $checkAttendanceStmt = $conn->prepare($checkAttendanceSql);
                $checkAttendanceStmt->bind_param("s", $urn);
                $checkAttendanceStmt->execute();
                $attendanceResult = $checkAttendanceStmt->get_result();

                if ($attendanceResult->num_rows > 0) {
                    echo "<div class='alert alert-info' role='alert'>
                            Attendance has already been marked for <strong>" . htmlspecialchars($name) . "</strong>.
                          </div>";
                } else {
                    // Mark attendance
                    $timestamp = date("Y-m-d H:i:s");
                    $insertSql = "INSERT INTO attendance (urn, timestamp) VALUES (?, ?)";
                    $insertStmt = $conn->prepare($insertSql);
                    $insertStmt->bind_param("ss", $urn, $timestamp);
                    $insertStmt->execute();

                    echo "<div class='alert alert-success' role='alert'>
                            Attendance successfully marked for <strong>" . htmlspecialchars($name) . "</strong>.
                          </div>";
                }

                $checkAttendanceStmt->close();
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                        Invalid URN: <strong>" . htmlspecialchars($urn) . "</strong>. Please try again.
                      </div>";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<div class='alert alert-warning' role='alert'>
                    No URN provided.
                  </div>";
        }
        ?>
        <a href="index.php" class="btn btn-primary mt-3">Go Back to Scanner</a>
    </div>
    <!-- Include Bootstrap JS for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
