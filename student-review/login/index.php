<?php
session_start();
if (isset($_SESSION["sr_user_id"])) {
  header("Location: home");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
    }

    .login-card {
      width: 100%;
      max-width: 450px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }

    .login-header {
      background-color: #2575fc;
      padding: 20px;
      text-align: center;
      color: #fff;
    }

    .login-header h2 {
      margin: 0;
      font-size: 24px;
    }

    .login-body {
      padding: 30px;
    }

    .form-label {
      font-weight: bold;
      color: #333;
    }

    .form-control {
      border-radius: 10px;
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #2575fc;
    }

    .btn-primary {
      background: #2575fc;
      border: none;
      border-radius: 10px;
      padding: 10px;
    }

    .btn-primary:hover {
      background: #6a11cb;
    }

    .forgot-password {
      display: block;
      text-align: right;
      margin-top: 10px;
      font-size: 14px;
      color: #2575fc;
      text-decoration: none;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <!-- Login Card Start -->
  <div class="login-card">
    <!-- Header Section -->
    <div class="login-header">
      <h2>Student Stuck Off System</h2>
    </div>
    <!-- Form Section -->
    <div class="login-body">
      <form action="../api/login.php" method="post">
        <div class="mb-3">
          <label for="username" class="form-label">User Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter your username" name="name" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
        </div>
        <a href="#" class="forgot-password">Forgot Password?</a>
        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-primary">Sign In</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Login Card End -->

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
