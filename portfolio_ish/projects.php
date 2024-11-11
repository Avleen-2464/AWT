<?php
include 'db.php'; // Database connection

$sql = "SELECT * FROM projects";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Projects</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
            font-family: 'Arial', sans-serif;
            padding-top: 80px; /* Space for fixed navbar */
        }

        .container {
            max-width: 960px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
            background-color: #fff;
        }

        .project-description {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .project-link a {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }

        .project-link a:hover {
            text-decoration: underline;
        }

        .text-center {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center display-4 text-primary">My Projects</h1>
        <?php while ($project = $result->fetch_assoc()) { ?>
            <div class="card">
                <div class="card-header">
                    <?= htmlspecialchars($project['name']) ?>
                </div>
                <div class="card-body">
                    <p class="project-description"><?= htmlspecialchars($project['description']) ?></p>
                    <?php if ($project['github_link']) { ?>
                        <p class="project-link">
                            <a href="<?= htmlspecialchars($project['github_link']) ?>" target="_blank">View on GitHub</a>
                        </p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
