<!-- project_submission.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Project - Project Management System</title>
    <link rel="stylesheet" href="assets/css/styles.css">  <!-- Your CSS file -->
</head>
<body>

    <div class="submission-container">
        <h2>Submit Your Project</h2>

        <form action="index.php?route=project_submission" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Project Title:</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div class="form-group">
                <label for="description">Project Description:</label>
                <textarea name="description" id="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="metadata">Project Metadata:</label>
                <input type="text" name="metadata" id="metadata" required>
            </div>

            <div class="form-group">
                <label for="file">Upload Project Files:</label>
                <input type="file" name="file" id="file" multiple required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Submit Project</button>
            </div>
        </form>

        <p><a href="index.php?route=student_dashboard" class="btn">Back to Dashboard</a></p>
    </div>

</body>
</html>
