<?php
session_start();
require_once '../controllers/ProjectController.php';

$projectController = new ProjectController();

// Get the user ID from session
$user_id = $_SESSION['user_id'];

// Fetch projects for the logged-in user
$projects = $projectController->getProjectsByUserId($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Projects</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">My Projects</h1>

        <a href="create_project.php" class="btn btn-primary mb-3">Create New Project</a>

        <?php if (count($projects) > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Project Title</th>
                        <th>Description</th>
                        <th>Team Members</th>
                        <th>Submission Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($project['title']); ?></td>
                            <td><?php echo htmlspecialchars($project['description']); ?></td>
                            <td><?php echo htmlspecialchars($project['team_members']); ?></td>
                            <td><?php echo htmlspecialchars($project['submission_date']); ?></td>
                            <td>
                                <a href="update_project.php?id=<?php echo $project['id']; ?>" class="btn btn-warning">Update</a>
                                <a href="delete_project.php?id=<?php echo $project['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">No projects found.</div>
        <?php endif; ?>
    </div>
</body>
</html>
