<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'portfolio');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch profile information
$profile_query = "SELECT email, linkedin FROM profile_info LIMIT 1";
$profile_result = $conn->query($profile_query);

if ($profile_result->num_rows > 0) {
    $profile = $profile_result->fetch_assoc();
} else {
    echo "No profile information found.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the Thank You page
        header('Location: thankyou.php');
        exit; // Ensure no further code is executed after redirect
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <!-- Bootstrap CSS link -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 50px;
        }

        .container {
            max-width: 900px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 3rem;
            color: #4A90E2;
            font-weight: bold;
        }

        .header p {
            font-size: 1.1rem;
            color: #777;
        }

        .profile-section,
        .form-section {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .profile-section h3,
        .form-section h3 {
            font-size: 2rem;
            color: #4A90E2;
            margin-bottom: 20px;
        }

        .profile-section p,
        .form-section p {
            font-size: 1.1rem;
            color: #555;
        }

        .btn-primary {
            background-color: #4A90E2;
            border-color: #4A90E2;
            font-size: 1.1rem;
            padding: 12px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #357ABD;
            border-color: #357ABD;
        }

        .social-links a {
            margin-right: 15px;
            color: #4A90E2;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #357ABD;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: none;
            font-size: 1rem;
            padding: 15px;
        }

        .form-group label {
            font-size: 1.1rem;
            color: #555;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            background-color: #4A90E2;
            color: #fff;
            font-size: 1rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Contact Ishpreet Singh</h1>
            <p>Feel free to get in touch or send a message!</p>
        </div>

        <div class="row">
            <!-- Left side: Personal details from database -->
            <div class="col-md-6">
                <div class="profile-section">
                    <h3>Connect with Me</h3>
                    <?php if (isset($profile)): ?>
                        <p><strong>Email:</strong> <?php echo $profile['email']; ?></p>
                        <p><strong>LinkedIn:</strong> <a href="<?php echo $profile['linkedin']; ?>" target="_blank">View Profile</a></p>
                    <?php endif; ?>

                    <div class="social-links">
                        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://github.com" target="_blank"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

            <!-- Right side: Contact form -->
            <div class="col-md-6">
                <div class="form-section">
                    <h3>Send a Message</h3>
                    <form action="contact.php" method="POST">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Ishpreet Singh. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
