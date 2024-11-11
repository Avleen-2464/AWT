<!-- super_admin_dashboard.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard - Project Management System</title>
    <link rel="stylesheet" href="assets/css/styles.css">  <!-- Your CSS file -->
</head>
<body>

    <div class="super-admin-dashboard-container">
        <h2>Super Admin Dashboard</h2>
        <p>View all students' projects and faculty remarks:</p>

        <?php if (!empty($allProjects)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Project Title</th>
                        <th>Student Name</th>
                        <th>Faculty Name</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allProjects as $project): ?>
                        <tr>
                            <td><?php echo $project['title']; ?></td>
                            <td><?php echo $project['student_name']; ?></td>
                            <td><?php echo $project['faculty_name']; ?></td>
                            <td><?php echo $project['status']; ?></td>
                            <td><?php echo $project['remarks'] ?? 'No remarks yet'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No projects available or assigned yet.</p>
        <?php endif; ?>

        <p><a href="index.php?route=super_admin_dashboard" class="btn">Refresh Dashboard</a></p>
    </div>

</body>
</html>
