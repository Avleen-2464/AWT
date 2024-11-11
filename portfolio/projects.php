<?php
include 'db.php'; // Database connection

$sql = "SELECT * FROM projects";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Projects</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            padding-top: 60px; /* Space for fixed navbar */
        }

        .container {
            max-width: 800px;
            margin-top: 40px;
        }

        .project-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }

        .project-card:hover {
            transform: scale(1.02);
        }

        .project-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .project-description {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }

        .project-link a {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        .project-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center">My Projects</h1>
        <?php while ($project = $result->fetch_assoc()) { ?>
            <div class="project-card">
                <h2 class="project-title"><?= htmlspecialchars($project['name']) ?></h2>
                <p class="project-description"><?= htmlspecialchars($project['description']) ?></p>
                <?php if ($project['github_link']) { ?>
                    <p class="project-link"><a href="<?= htmlspecialchars($project['github_link']) ?>" target="_blank">GitHub Repository</a></p>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
