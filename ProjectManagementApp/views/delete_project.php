<?php
session_start();
require_once '../controllers/ProjectController.php';

$projectController = new ProjectController();

// Check if the project ID is set in the query string
if (isset($_GET['id'])) {
    $project_id = intval($_GET['id']);

    // Call the delete method from the ProjectController
    if ($projectController->deleteProject($project_id)) {
        // Redirect to the view projects page with a success message
        $_SESSION['message'] = "Project deleted successfully.";
    } else {
        // Redirect to the view projects page with an error message
        $_SESSION['message'] = "Failed to delete project.";
    }
}

// Redirect back to the view projects page
header("Location: view_projects.php");
exit;
?>
