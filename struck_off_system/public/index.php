<?php
// Start the session
session_start();

// Include the database connection (make sure the path is correct)
require_once '../config/db.php';

// Check if a URL is specified in the query string (e.g., index.php?url=hod_dashboard)
if (isset($_GET['url'])) {
    $url = $_GET['url'];  // Capture the URL part from the query string

    // Route the request based on the URL value
    switch ($url) {
        case 'hod_dashboard':
            require_once('app/views/hod_dashboard.php');
            break;
        case 'dl_dashboard':
            require_once('app/views/dl_dashboard.php');
            break;
        case 'registrar_dashboard':
            require_once('app/views/registrar_dashboard.php');
            break;
        case 'dean_dashboard':
            require_once('app/views/dean_dashboard.php');
            break;
        default:
            // If the URL is not recognized, redirect to the login page or home
            // Update the path to login.php based on its actual location
            require_once('login.php');  // Correct path here
            break;
    }
} else {
    // Default case if no URL is specified, show login or home page
    // Update the path to login.php based on its actual location
    require_once('login.php');  // Correct path here
}
?>
