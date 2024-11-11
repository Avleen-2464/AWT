<?php
// AuthController.php
require_once 'Database.php';

class AuthController {
    public function login($username, $password) {
        $db = Database::getInstance()->getConnection();

        $query = $db->prepare("SELECT * FROM users WHERE username = :username");
        $query->execute(['username' => $username]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['login_time'] = time();

            // Redirect based on role
            switch ($user['role']) {
                case 'student':
                    header("Location: /views/student_dashboard.php");
                    break;
                case 'teacher':
                    header("Location: /views/teacher_dashboard.php");
                    break;
                case 'admin':
                    header("Location: /views/admin_dashboard.php");
                    break;
            }
            exit();
        } else {
            return "Invalid credentials.";
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: /index.php");
        exit();
    }
}
?>
