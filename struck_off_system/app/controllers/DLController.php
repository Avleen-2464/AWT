<?php

require_once '../config/db.php';

class DLController
{
    public function dashboard()
    {
        $db = Database::getConnection();

        // Fetch records with HOD remarks but not yet reviewed by DL
        $query = "SELECT r.id, s.roll_no, s.name, s.department, r.remarks_hod 
                  FROM struck_off_records r
                  JOIN students s ON r.roll_no = s.roll_no
                  WHERE r.remarks_dl IS NULL";
        $result = $db->query($query);
        $records = $result->fetch_all(MYSQLI_ASSOC);

        // Load the DL dashboard view
        require '../app/Views/dl_dashboard.php';
    }

    public function addRemark()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $record_id = $_POST['record_id'];
            $remarks = $_POST['remarks_dl'];

            $db = Database::getConnection();

            // Update the record with DL's remarks
            $query = "UPDATE struck_off_records SET remarks_dl = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("si", $remarks, $record_id);
            $stmt->execute();

            echo "DL remarks added successfully!";
        }
    }
}
