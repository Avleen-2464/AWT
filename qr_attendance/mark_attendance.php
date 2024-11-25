<?php
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Status</title>
    <link href="https:
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
        
        if (isset($_GET['urn'])) {
            $urn = $_GET['urn'];

            
            $sql = "SELECT name FROM students WHERE urn = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $urn);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc();
                $name = $student['name'];

                
                $checkAttendanceSql = "SELECT * FROM attendance WHERE urn = ?";
                $checkAttendanceStmt = $conn->prepare($checkAttendanceSql);
                $checkAttendanceStmt->bind_param("s", $urn);
                $checkAttendanceStmt->execute();
                $attendanceResult = $checkAttendanceStmt->get_result();

                if ($attendanceResult->num_rows > 0) {
                    
                    echo "<div class='alert alert-info' role='alert'>
                            Attendance has already been marked for <strong>" . htmlspecialchars($name) . "</strong>
                          </div>";
                } else {
                    
                    $timestamp = date("Y-m-d H:i:s");
                    $insertSql = "INSERT INTO attendance (urn, timestamp) VALUES (?, ?)";
                    $insertStmt = $conn->prepare($insertSql);
                    $insertStmt->bind_param("ss", $urn, $timestamp);
                    $insertStmt->execute();

                    
                    echo "<div class='alert alert-success' role='alert'>
                            Attendance successfully marked for <strong>" . htmlspecialchars($name) . "</strong>
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
</body>
</html>
