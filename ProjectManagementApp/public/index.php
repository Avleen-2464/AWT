<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session for user management
session_start();

// Include the database configuration
require_once '../config/database.php';
echo "Database configuration included.<br>"; // Debug statement

// Simple routing logic
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
echo "Current page: $page<br>"; // Debug statement

// Include the corresponding controller based on the requested page
switch ($page) {
    case 'login':
        require_once '../controllers/AuthController.php';
        echo "AuthController included.<br>"; // Debug statement
        break;
    case 'projects':
        require_once '../controllers/ProjectController.php';
        echo "ProjectController included.<br>"; // Debug statement
        break;
    // Add more cases as needed
    default:
        require_once '../views/home.php'; // Default view
        echo "Default view (home.php) included.<br>"; // Debug statement
        break;
}
?>
