<?php
// Start session to store login data
session_start();

// Include the DB connection
require_once '../config/db.php'; // Correct path to db.php

class HODController
{
    // Fetch and display the HOD Dashboard
    public function dashboard()
    {
        // Get database connection
        $db = Database::getConnection();  // Assuming Database class handles connection

        // Query to fetch students (this can be updated based on actual requirement)
        $query = "SELECT * FROM students";  // Adjust this as needed
        $result = $db->query($query);
        
        if ($result) {
            $students = $result->fetch_all(MYSQLI_ASSOC);  // Fetch all students as an associative array
        } else {
            // Handle query failure
            echo "Error fetching students: " . $db->error;
            return;
        }

        // Load the HOD dashboard view and pass the student data
        require '../app/views/hod_dashboard.php';
    }

    // Additional method for adding remarks (if needed)
    public function addRemark()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the posted data from the form
            $roll_no = $_POST['roll_no'];
            $remarks = $_POST['remarks'];

            // Process the data, for example, add remarks to the database
            $db = Database::getConnection();
            $query = "UPDATE students SET remarks = ? WHERE roll_no = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("si", $remarks, $roll_no);
            $stmt->execute();

            // Redirect or show a success message
            echo "Remarks added successfully!";
        }
    }
}
?>
