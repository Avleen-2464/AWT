<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKEditor with AJAX</title>
    
    <!-- Include jQuery and CKEditor -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script> 

    <!-- Bootstrap CDN for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Styling */
        .container {
            max-width: 1000px;
            margin-top: 50px;
        }

        /* Make CKEditor larger */
        #editor {
            min-height: 500px; /* Increase height */
            max-width: 100%; /* Ensure full width of the container */
        }

        .alert.success {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Page Header -->
    <div class="text-center mb-4">
        <h1>Content Editor</h1>
        <p>Use the editor below to create content and submit it.</p>
    </div>

    <!-- CKEditor -->
    <div class="form-group">
        <textarea id="editor" name="editor" class="form-control" placeholder="Write your content here..."></textarea>
    </div>

    <!-- Submit Button -->
    <div class="text-center">
        <button id="submit" class="btn btn-primary">Submit</button>
    </div>

    <!-- Response message area -->
    <div id="response" class="text-center mt-4"></div>

    <!-- Content display area (if needed for future content) -->
    <div id="content-area"></div>
</div>

<script>
$(document).ready(function() {
    // Initialize CKEditor
    CKEDITOR.replace('editor');

    $('#submit').click(function() {
        // Get the data from CKEditor
        var content = CKEDITOR.instances.editor.getData();

        $.ajax({
            url: 'submit_content.php',
            type: 'POST',
            data: {content: content},
            success: function(response) {
                $('#response').html(response);
                CKEDITOR.instances.editor.setData(''); // Clear CKEditor after submission
                // Optionally, refresh the content area
                $('#content-area').load('fetch_data.php');
            },
            error: function() {
                $('#response').html('Error occurred while submitting.');
            }
        });
    });
});
</script>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
