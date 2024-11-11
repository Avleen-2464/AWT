<?php
// Database connection
$host = 'localhost'; // Database host
$db = 'portfolio'; // Database name
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        header {
            background: linear-gradient(90deg, #1e3c72, #2a5298);
            padding: 50px 0;
            text-align: center;
            color: #fff;
        }

        .navbar {
            background-color: transparent;
            padding: 0;
            box-shadow: none;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff !important;
        }

        .profile-container {
            text-align: center;
            padding: 50px 15px;
        }

        .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin-bottom: 30px;
            border: 5px solid #fff;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-left: auto;
            margin-right: auto;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .name {
            font-size: 3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px; /* Added margin to create space between portfolio and name */
        }

        .bio {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 40px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .circle-button {
            width: 120px;
            height: 120px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 18px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        .circle-button:hover {
            transform: translateY(-5px);
        }

        .circle-button i {
            font-size: 2rem;
        }

        footer {
            background-color: #2a5298;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">Portfolio</a>
                <span class="navbar-brand" style="font-weight: normal; color: #fff;"><?php echo $profile['name']; ?></span>
            </div>
        </nav>
    </header>

    <div class="profile-container">
        <div class="profile-img">
            <img src="<?php echo $profile['profile_image']; ?>" alt="Profile Image">
        </div>
        <h2 class="name"><?php echo $profile['name']; ?></h2>
        <p class="bio"><?php echo $profile['bio']; ?></p>

        <div class="button-container">
            <a href="<?php echo $profile['resume_link']; ?>" class="circle-button" title="Resume">
                <i class="fas fa-file-alt"></i>
            </a>
            <a href="<?php echo $profile['projects_link']; ?>" class="circle-button" title="Projects">
                <i class="fas fa-project-diagram"></i>
            </a>
            <a href="<?php echo $profile['contact_link']; ?>" class="circle-button" title="Contact">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </div>

    <footer>
        <!-- Removed the copyright section as per your request -->
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
