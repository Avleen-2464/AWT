<?php
// Check if session is started
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include the controller to fetch students data
require_once '../controllers/HODController.php';
$hodController = new HODController();
$hodController->dashboard();  // Fetch the data and load the view
?>

<!-- HTML part to display the student data -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD Dashboard</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, HOD!</h2>
        <h3>Students List</h3>

        <?php if (isset($students) && count($students) > 0) : ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['roll_no']); ?></td>
                            <td><?php echo htmlspecialchars($student['name']); ?></td>
                            <td><?php echo htmlspecialchars($student['remarks']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No students found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
