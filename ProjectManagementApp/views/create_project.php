<?php
session_start();
require_once '../controllers/ProjectController.php';

$projectController = new ProjectController();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $team_members = $_POST['team_members'];

    // Create a new project
    $result = $projectController->createProject($title, $description, $team_members, $_SESSION['user_id']);

    if ($result) {
        header("Location: view_projects.php"); // Redirect to view projects
        exit;
    } else {
        $error = "Failed to create project. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Create New Project</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="title">Project Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="team_members">Team Members (comma-separated)</label>
                <input type="text" class="form-control" id="team_members" name="team_members" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Project</button>
            <a href="view_projects.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
