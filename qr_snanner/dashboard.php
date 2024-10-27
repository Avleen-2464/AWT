<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Attendance Scanner</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <style>
        #video {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>QR Code Attendance Scanner</h1>
        <video id="video" autoplay></video>
        <h3 id="result"></h3>
        
        <!-- File input for uploading QR code image -->
        <input type="file" id="file-input" accept="image/*" />
    </div>

    <script>
        const codeReader = new ZXing.BrowserQRCodeReader();

        // Start video scanning
        codeReader.decodeFromVideoDevice(null, 'video', (result, err) => {
            if (result) {
                document.getElementById('result').innerText = `QR Code detected: ${result.text}`;
                markAttendance(result.text);
            }
            if (err && !(err instanceof ZXing.NotFoundException)) {
                console.error(err);
            }
        });

        // Function to handle image upload
        document.getElementById('file-input').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = function () {
                        // Decode QR code from uploaded image
                        codeReader.decodeFromImage(img)
                            .then((result) => {
                                document.getElementById('result').innerText = `QR Code detected: ${result.text}`;
                                markAttendance(result.text);
                            })
                            .catch((err) => {
                                console.error(err);
                                alert('No QR code found in the image.');
                            });
                    };
                };
                reader.readAsDataURL(file);
            }
        });

        function markAttendance(crn) {
            $.ajax({
                url: 'mark_attendance.php', // Ensure this URL is correct and accessible
                method: 'POST',
                data: { crn: crn },
                success: function (response) {
                    console.log(response); // Check the response in the console
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error marking attendance:', textStatus, errorThrown);
                    alert('Failed to mark attendance. Please try again.');
                }
            });
        }

    </script>
</body>
</html>
