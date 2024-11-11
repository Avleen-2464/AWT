<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'portfolio_db');

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
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .profile-section, .form-section {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .profile-section h3, .form-section h3 {
            color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center mb-5">
            <h1>Avleen kaur</h1> <!-- Replace with your actual name -->
            <p>Feel free to connect with me or send a message directly!</p>
        </div>
        
        <div class="row">
            <!-- Left side: Personal details from database -->
            <div class="col-md-6">
                <div class="profile-section">
                    <h3>Let's Connect!</h3>
                    <?php if (isset($profile)): ?>
                        <p><strong>Email:</strong> <?php echo $profile['email']; ?></p>
                        <p><strong>LinkedIn:</strong> <a href="<?php echo $profile['linkedin']; ?>" target="_blank">View Profile</a></p>
                    <?php endif; ?>
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
