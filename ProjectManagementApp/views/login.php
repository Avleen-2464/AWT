<!-- login.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Project Management System</title>
    <link rel="stylesheet" href="assets/css/styles.css">  <!-- Your CSS file -->
</head>
<body>

    <div class="login-container">
        <h2>Login to Project Management System</h2>

        <?php
        // Display any error messages if login fails
        if (isset($message)) {
            echo "<div class='error-message'>$message</div>";
        }
        ?>

        <form action="index.php?route=login" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Login</button>
            </div>

            <p>New user? <a href="index.php?route=register">Register here</a></p>
        </form>
    </div>

</body>
</html>
