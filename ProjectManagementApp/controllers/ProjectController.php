<?php
// ProjectController.php
require_once 'Database.php';

class ProjectController {
    // Student: View their own projects
    public function viewStudentProjects($studentId) {
        $db = Database::getInstance()->getConnection();
        $query = $db->prepare("SELECT * FROM projects WHERE student_id = :studentId");
        $query->execute(['studentId' => $studentId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Student: Submit a new project
    public function addProject($studentId, $title, $description, $metadata) {
        $db = Database::getInstance()->getConnection();
        $query = $db->prepare("INSERT INTO projects (student_id, title, description, metadata, status, submission_date)
                               VALUES (:studentId, :title, :description, :metadata, 'Pending', NOW())");
        $query->execute([
            'studentId' => $studentId,
            'title' => $title,
            'description' => $description,
            'metadata' => json_encode($metadata)
        ]);
        return $query->rowCount() > 0;
    }

    // Teacher: View assigned students and projects
    public function viewAssignedStudents($teacherId) {
        $db = Database::getInstance()->getConnection();
        $query = $db->prepare("SELECT * FROM projects WHERE assigned_teacher = :teacherId");
        $query->execute(['teacherId' => $teacherId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Teacher: Approve or reject a project with feedback
    public function reviewProject($projectId, $status, $feedback) {
        $db = Database::getInstance()->getConnection();
        $query = $db->prepare("UPDATE projects SET status = :status, feedback = :feedback, approval_date = NOW() WHERE id = :projectId");
        $query->execute([
            'status' => $status,
            'feedback' => $feedback,
            'projectId' => $projectId
        ]);
        return $query->rowCount() > 0;
    }

    // Super Admin: View all projects
    public function getAllProjects() {
        $db = Database::getInstance()->getConnection();
        $query = $db->query("SELECT * FROM projects");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
