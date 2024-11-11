<?php
// Include the database connection
include 'db.php'; 

// Fetch the most recent education data
$education_sql = "SELECT * FROM education ORDER BY id DESC LIMIT 1"; 
$education_result = $conn->query($education_sql);
$education = ($education_result->num_rows > 0) ? $education_result->fetch_assoc() : null;

// Fetch the most recent achievements data
$achievements_sql = "SELECT * FROM achievements ORDER BY id DESC LIMIT 1"; 
$achievements_result = $conn->query($achievements_sql);
$achievements = ($achievements_result->num_rows > 0) ? $achievements_result->fetch_assoc() : null;

// Fetch the most recent skills data
$skills_sql = "SELECT * FROM skills ORDER BY id DESC LIMIT 1"; 
$skills_result = $conn->query($skills_sql);
$skills = ($skills_result->num_rows > 0) ? $skills_result->fetch_assoc() : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
        }
        .container {
            max-width: 900px;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            color: #007bff;
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 30px;
        }
        h3 {
            color: #007bff;
            margin-top: 20px;
            font-size: 24px;
        }
        p {
            font-size: 1.1rem;
            line-height: 1.8;
        }
        .section-title {
            font-weight: bold;
            color: #555;
            font-size: 1.2rem;
        }
        .resume-section {
            margin-bottom: 30px;
        }
        .resume-section p {
            font-style: italic;
            color: #555;
        }
        .skill-list {
            list-style-type: none;
            padding-left: 0;
        }
        .skill-list li {
            background: #007bff;
            color: #fff;
            border-radius: 5px;
            margin-bottom: 8px;
            padding: 8px;
            font-size: 1rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>My Resume</h1>

        <!-- Education Section -->
        <div class="resume-section">
            <h3>Education</h3>
            <p class="section-title"><?= $education['institution'] ?? 'No data available.' ?></p>
            <p><?= $education['degree'] ?? 'No data available.' ?></p>
            <p><strong>Duration:</strong> <?= $education['start_year'] ?? 'No data available.' ?> - <?= $education['end_year'] ?? 'No data available.' ?></p>
            <p><strong>Description:</strong> <?= $education['description'] ?? 'No data available.' ?></p>
        </div>

        <!-- Achievements Section -->
        <div class="resume-section">
            <h3>Achievements</h3>
            <p class="section-title"><?= $achievements['title'] ?? 'No data available.' ?></p>
            <p><?= $achievements['description'] ?? 'No data available.' ?></p>
        </div>

        <!-- Skills Section -->
        <div class="resume-section">
            <h3>Skills</h3>
            <p class="section-title"><?= $skills['skill_type'] ?? 'No data available.' ?></p>
            <ul class="skill-list">
                <li><?= $skills['skill_description'] ?? 'No data available.' ?></li>
            </ul>
        </div>
    </div>

</body>
</html>
