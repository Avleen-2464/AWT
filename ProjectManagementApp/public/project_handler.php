_<?php
require_once '../config/db.php';
require_once '../app/models/Project.php';
require_once '../app/controllers/ProjectController.php';

session_start();

$projectController = new ProjectController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $userId = $_SESSION['user_id'];
    $teamMembers = $_POST['team_members']; // Expecting a comma-separated string

    if ($projectController->createProject($title, $description, $userId, $teamMembers)) {
        header('Location: ../views/projects.php'); // Redirect to projects view
    } else {
        // Handle project creation error
    }
}
?>
