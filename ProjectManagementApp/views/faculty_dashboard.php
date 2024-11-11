<!-- faculty_dashboard.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard - Project Management System</title>
    <link rel="stylesheet" href="assets/css/styles.css">  <!-- Your CSS file -->
</head>
<body>

    <div class="faculty-dashboard-container">
        <h2>Faculty Dashboard</h2>
        <p>Manage your assigned projects below:</p>

        <?php if (!empty($assignedProjects)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Project Title</th>
                        <th>Student Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assignedProjects as $project): ?>
                        <tr>
                            <td><?php echo $project['title']; ?></td>
                            <td><?php echo $project['student_name']; ?></td>
                            <td><?php echo $project['status']; ?></td>
                            <td>
                                <a href="index.php?route=approve_project&id=<?php echo $project['id']; ?>" class="btn">Approve</a>
                                <a href="index.php?route=reject_project&id=<?php echo $project['id']; ?>" class="btn">Reject</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No projects assigned to you at the moment.</p>
        <?php endif; ?>

        <p><a href="index.php?route=faculty_dashboard" class="btn">Refresh Dashboard</a></p>
    </div>

</body>
</html>
