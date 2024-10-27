<?php
session_start();
$conn = new mysqli('localhost', 'root','' , 'attendance_db'); // Modify with your credentials

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Check if user exists
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id']; // Store user id in session
            header('Location: dashboard.php'); // Redirect to the dashboard after login
        } else {
            echo 'Invalid username or password.';
        }
    } else {
        echo 'Invalid username or password.';
    }
}
?>
<!-- HTML form -->
<form method="post" action="">
    <label>Username:</label>
    <input type="text" name="username">
    <label>Password:</label>
    <input type="password" name="password">
    <button type="submit">Login</button>
</form>
