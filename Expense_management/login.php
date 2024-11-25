<?php
session_start();
include 'db.php';  


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        
        if ($password === $user['password']) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            
            if ($user['role'] == 'admin') {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: family_dashboard.php');
            }
            exit;
        } else {
            echo "<div class='alert alert-danger'>Invalid password.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>No user found.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https:
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin-top: 100px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="login-container">
            <h2 class="text-center mb-4">Login</h2>
            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
