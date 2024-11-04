<?php
class Session {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createSession($userId) {
        $stmt = $this->conn->prepare("INSERT INTO sessions (user_id, login_time) VALUES (:user_id, NOW())");
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function updateSession($sessionId) {
        $stmt = $this->conn->prepare("UPDATE sessions SET logout_time = NOW() WHERE session_id = :session_id");
        $stmt->bindParam(':session_id', $sessionId);
        return $stmt->execute();
    }

    // Other session-related methods if needed
}
?>
