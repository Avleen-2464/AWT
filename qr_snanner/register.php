<?php
// Assuming the same connection setup from login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    
    $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->bind_param('ss', $username, $password);
    
    if ($stmt->execute()) {
        echo 'User registered successfully!';
    } else {
        echo 'Error registering user.';
    }
}
?>
<!-- HTML form for registration -->
<form method="post" action="">
    <label>Username:</label>
    <input type="text" name="username">
    <label>Password:</label>
    <input type="password" name="password">
    <button type="submit">Register</button>
</form>
