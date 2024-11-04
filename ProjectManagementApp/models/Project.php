<?php
require_once '../config/db.php';

class Project {
    private $conn;

    public function __construct() {
        $this->conn = $GLOBALS['conn'];
    }

    public function createProject($title, $description, $userId, $teamMembers) {
        $stmt = $this->conn->prepare("INSERT INTO projects (title, description, user_id, team_members) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $title, $description, $userId, $teamMembers);
        return $stmt->execute();
    }

    public function getProjectsByUser($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM projects WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
