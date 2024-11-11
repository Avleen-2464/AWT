<?php
include 'db.php';  // Ensure db.php is correctly included

// Query to fetch education data (adjusted for the actual schema)
$education_sql = "SELECT * FROM education LIMIT 1";  
$education_result = $conn->query($education_sql);  // Execute query

// Query to fetch achievements data
$achievements_sql = "SELECT * FROM achievements LIMIT 1";  
$achievements_result = $conn->query($achievements_sql);  // Execute query

// Query to fetch skills data
$skills_sql = "SELECT * FROM skills LIMIT 1";  
$skills_result = $conn->query($skills_sql);  // Execute query

// Fetch the data from each result
$education = $education_result->fetch_assoc();
$achievements = $achievements_result->fetch_assoc();
$skills = $skills_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        h3 {
            color: #007bff;
            margin-top: 30px;
        }
        p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        .section-title {
            font-weight: bold;
            margin-top: 15px;
        }
        .resume-section {
            margin-bottom: 20px;
        }
        .resume-section p {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>My Resume</h1>

        <!-- Education Section -->
        <div class="resume-section">
            <h3>Education</h3>
            <p class="section-title"><?= isset($education['institution']) ? $education['institution'] : 'No data available.' ?></p>
            <p><?= isset($education['degree']) ? $education['degree'] : 'No data available.' ?></p>
            <p><?= isset($education['start_year']) ? $education['start_year'] : 'No data available.' ?> - <?= isset($education['end_year']) ? $education['end_year'] : 'No data available.' ?></p>
            <p><?= isset($education['description']) ? $education['description'] : 'No data available.' ?></p>
        </div>

        <!-- Achievements Section -->
        <div class="resume-section">
            <h3>Achievements</h3>
            <p class="section-title"><?= isset($achievements['title']) ? $achievements['title'] : 'No data available.' ?></p>
            <p><?= isset($achievements['description']) ? $achievements['description'] : 'No data available.' ?></p>
        </div>

        <!-- Skills Section -->
        <div class="resume-section">
            <h3>Skills</h3>
            <p class="section-title"><?= isset($skills['skill_type']) ? $skills['skill_type'] : 'No data available.' ?></p>
            <p><?= isset($skills['skill_description']) ? $skills['skill_description'] : 'No data available.' ?></p>
        </div>
    </div>
</body>
</html>
