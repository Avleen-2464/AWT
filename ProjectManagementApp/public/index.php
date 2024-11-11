<?php
// index.php

// Start the session
session_start();

// Autoloading classes (assuming all your controllers, models, etc., follow a namespace or class structure)
function autoload($class) {
    $class = str_replace("\\", "/", $class);  // Replace namespace separator with directory separator
    $base_path = $_SERVER['DOCUMENT_ROOT'] . '/project_management_system/';  // Change path as necessary
    require_once $base_path . $class . '.php';
}
spl_autoload_register('autoload');

// Database connection
require_once 'config/databse.php';

// Get the route from the URL
$route = isset($_GET['route']) ? $_GET['route'] : 'login';  // Default route is login

// Routing mechanism (switch or if-else structure)
switch ($route) {
    case 'login':
        // Handle login logic
        $authController = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle login form submission
            $username = $_POST['username'];
            $password = $_POST['password'];
            $message = $authController->login($username, $password);
            if ($message) {
                // Return message if there are issues with login
                echo $message;
            }
        }
        include 'views/login.php'; // Load the login page view
        break;

    case 'student_dashboard':
        // Handle student dashboard
        if ($_SESSION['role'] === 'student') {
            $projectController = new ProjectController();
            $studentProjects = $projectController->viewStudentProjects($_SESSION['user_id']);
            include 'views/dashboard.php'; // Load student dashboard
        } else {
            include 'views/error.php'; // If not student, show error
        }
        break;

    case 'faculty_dashboard':
        // Handle faculty dashboard
        if ($_SESSION['role'] === 'teacher') {
            $projectController = new ProjectController();
            $assignedProjects = $projectController->viewAssignedStudents($_SESSION['user_id']);
            include 'views/faculty_dashboard.php'; // Load faculty dashboard
        } else {
            include 'views/error.php'; // If not faculty, show error
        }
        break;

    case 'project_submission':
        // Handle project submission
        if ($_SESSION['role'] === 'student') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Handle project submission form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $metadata = $_POST['metadata'];
                $projectController = new ProjectController();
                $projectController->addProject($_SESSION['user_id'], $title, $description, $metadata);
                echo "Project Submitted Successfully!";
            }
            include 'views/project_submission.php'; // Load project submission view
        } else {
            include 'views/error.php'; // If not student, show error
        }
        break;

    case 'logout':
        // Handle logout
        $authController = new AuthController();
        $authController->logout();
        break;

    default:
        // Default route (login page)
        include 'views/login.php';
        break;
}

?>
