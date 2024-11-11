<!-- dashboard.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Project Management System</title>
    <link rel="stylesheet" href="assets/css/styles.css">  <!-- Your CSS file -->
</head>
<body>

    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Here are your project details:</p>

        <!-- List Student's Projects -->
        <?php if (!empty($studentProjects)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Project Title</th>
                        <th>Status</th>
                        <th>Submission Date</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($studentProjects as $project): ?>
                        <tr>
                            <td><?php echo $project['title']; ?></td>
                            <td><?php echo $project['status']; ?></td>
                            <td><?php echo $project['submission_date']; ?></td>
                            <td><?php echo $project['remarks'] ?? 'No remarks yet'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You have no projects assigned or submitted yet.</p>
        <?php endif; ?>

        <p><a href="index.php?route=project_submission" class="btn">Submit New Project</a></p>
    </div>

</body>
</html>
