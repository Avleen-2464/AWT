<?php

require_once '../config/db.php';

class RegistrarController
{
    public function dashboard()
    {
        $db = Database::getConnection();

        // Fetch records reviewed by DL but not yet reviewed by Registrar
        $query = "SELECT r.id, s.roll_no, s.name, s.department, r.remarks_hod, r.remarks_dl 
                  FROM struck_off_records r
                  JOIN students s ON r.roll_no = s.roll_no
                  WHERE r.remarks_registrar IS NULL AND r.remarks_dl IS NOT NULL";
        $result = $db->query($query);
        $records = $result->fetch_all(MYSQLI_ASSOC);

        // Load the Registrar dashboard view
        require '../app/Views/registrar_dashboard.php';
    }

    public function addRemark()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $record_id = $_POST['record_id'];
            $remarks = $_POST['remarks_registrar'];

            $db = Database::getConnection();

            // Update the record with Registrar's remarks
            $query = "UPDATE struck_off_records SET remarks_registrar = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("si", $remarks, $record_id);
            $stmt->execute();

            echo "Registrar remarks added successfully!";
        }
    }
}
