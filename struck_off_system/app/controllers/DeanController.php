<?php

require_once '../config/db.php';

class DeanController
{
    public function dashboard()
    {
        $db = Database::getConnection();

        // Fetch all records completed by Registrar
        $query = "SELECT r.id, s.roll_no, s.name, s.department, r.remarks_hod, r.remarks_dl, r.remarks_registrar 
                  FROM struck_off_records r
                  JOIN students s ON r.roll_no = s.roll_no
                  WHERE r.status != 'Completed'";
        $result = $db->query($query);
        $records = $result->fetch_all(MYSQLI_ASSOC);

        // Load the Dean dashboard view
        require '../app/Views/dean_dashboard.php';
    }

    public function approveRecord()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $record_id = $_POST['record_id'];

            $db = Database::getConnection();

            // Mark record as approved
            $query = "UPDATE struck_off_records SET status = 'Completed' WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $record_id);
            $stmt->execute();

            echo "Record approved successfully!";
        }
    }
}
