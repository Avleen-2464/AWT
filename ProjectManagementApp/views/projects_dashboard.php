<?php
session_start();
require_once '../controllers/ProjectController.php';

$projectController = new ProjectController();
$projects = $projectController->getAllProjects(); // Fetch all projects

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Projects Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Projects Dashboard</h1>
        <a href="create_project.php" class="btn btn-primary">Create New Project</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?php echo $project['id']; ?></td>
                        <td><?php echo $project['title']; ?></td>
                        <td><?php echo $project['description']; ?></td>
                        <td>
                            <a href="update_project.php?id=<?php echo $project['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_project.php?id=<?php echo $project['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>