<?php
// UserController.php
require_once 'Database.php';

class UserController {
    // Admin: View all students
    public function getAllStudents() {
        $db = Database::getInstance()->getConnection();
        $query = $db->query("SELECT * FROM users WHERE role = 'student'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Admin: View all teachers
    public function getAllTeachers() {
        $db = Database::getInstance()->getConnection();
        $query = $db->query("SELECT * FROM users WHERE role = 'teacher'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get user info based on ID
    public function getUserById($userId) {
        $db = Database::getInstance()->getConnection();
        $query = $db->prepare("SELECT * FROM users WHERE id = :userId");
        $query->execute(['userId' => $userId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Super Admin: Assign a teacher to a student's project
    public function assignTeacherToProject($teacherId, $projectId) {
        $db = Database::getInstance()->getConnection();
        $query = $db->prepare("UPDATE projects SET assigned_teacher = :teacherId WHERE id = :projectId");
        $query->execute([
            'teacherId' => $teacherId,
            'projectId' => $projectId
        ]);
        return $query->rowCount() > 0;
    }
}
?>
