<?php
session_start();
require_once '../controllers/ProjectController.php';

$projectController = new ProjectController();

// Check if the project ID is provided
if (!isset($_GET['id'])) {
    header("Location: view_projects.php"); // Redirect if no ID is provided
    exit;
}

$project_id = $_GET['id'];
$project = $projectController->getProjectById($project_id);

// Check if the project exists
if (!$project) {
    header("Location: view_projects.php"); // Redirect if project not found
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $team_members = $_POST['team_members'];

    // Update the project
    $result = $projectController->updateProject($project_id, $title, $description, $team_members);

    if ($result) {
        header("Location: view_projects.php"); // Redirect to view projects
        exit;
    } else {
        $error = "Failed to update project. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Update Project</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="title">Project Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($project['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="team_members">Team Members (comma-separated)</label>
                <input type="text" class="form-control" id="team_members" name="team_members" value="<?php echo htmlspecialchars($project['team_members']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Project</button>
            <a href="view_projects.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
