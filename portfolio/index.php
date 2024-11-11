<?php
// Database connection
$host = 'localhost'; // Database host
$db = 'portfolio_db'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

// Create a connection to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch profile data from the database
$sql = "SELECT * FROM profile WHERE id = 1"; // Assuming there is only one profile
$result = $conn->query($sql);
$profile = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 80px;
            text-align: center;
        }

        .navbar {
            width: 100%;
            background-color: #343a40;
            color: white;
            padding: 10px 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
            font-size: 1rem;
            display: flex;
            align-items: center;
        }

        .navbar-brand {
            color: #f8f9fa;
            font-weight: bold;
            transition: color 0.2s;
        }

        .navbar-brand span {
            font-weight: normal;
            color: #ced4da;
            margin-left: 5px;
        }

        .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            margin: 20px auto 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hello-text {
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .about-text {
            font-size: 18px;
            color: #555;
            max-width: 600px;
            margin: 0 auto 40px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 20px;
        }

        .circle-button {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: transform 0.2s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .circle-button:hover {
            transform: scale(1.1);
        }

        .resume-btn {
            background-color: #f8c471;
        }

        .projects-btn {
            background-color: #e59866;
        }

        .contact-btn {
            background-color: #85c1e9;
        }

        /* Mobile Responsive Adjustments */
        @media (max-width: 768px) {
            .hello-text {
                font-size: 40px;
            }

            .about-text {
                font-size: 16px;
                padding: 0 20px;
            }

            .button-container {
                flex-direction: column;
                gap: 15px;
            }

            .circle-button {
                width: 100px;
                height: 100px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">My Portfolio</a>
            <span>- <?php echo htmlspecialchars($profile['name']); ?></span>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container">
        <div class="profile-img">
            <img src="<?php echo htmlspecialchars($profile['profile_image']); ?>" alt="Profile Image">
        </div>
        <h1 class="hello-text">Hello</h1>
        <p class="about-text"><?php echo htmlspecialchars($profile['bio']); ?></p>
        
        <div class="button-container">
            <a href="<?php echo htmlspecialchars($profile['resume_link']); ?>" class="circle-button resume-btn">Resume</a>
            <a href="<?php echo htmlspecialchars($profile['projects_link']); ?>" class="circle-button projects-btn">Projects</a>
            <a href="<?php echo htmlspecialchars($profile['contact_link']); ?>" class="circle-button contact-btn">Contact</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
