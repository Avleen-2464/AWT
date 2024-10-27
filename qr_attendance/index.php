<?php
include 'db.php'; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Attendance Scanner</title>
    <script src="jsQR.js"></script> <!-- Include jsQR library locally -->
    <style>
        video {
            display: none; /* Hide video element until scanning starts */
        }
        canvas {
            display: none; /* Hide canvas until needed */
        }
    </style>
</head>
<body>
    <h1>QR Attendance Scanner</h1>
    <button id="startButton">Start Scanning</button>
    <video id="preview" width="300" height="200"></video>
    <canvas id="canvas"></canvas>
    <div id="status"></div>
    <div id="error"></div>
    <div id="result"></div>

    <script>
        const video = document.getElementById('preview');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');
        const errorDisplay = document.getElementById('error');
        const statusDisplay = document.getElementById('status');
        const startButton = document.getElementById('startButton');

        startButton.addEventListener('click', function () {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
                .then(function (stream) {
                    video.srcObject = stream;
                    video.setAttribute("playsinline", true); // Required to tell iOS Safari we don't want fullscreen
                    video.play();
                    video.style.display = 'block'; // Show the video element
                    startButton.hidden = true; // Hide the button
                    statusDisplay.innerText = 'Scanning started...'; // Indicate that scanning has started
                    requestAnimationFrame(scanQRCode);
                })
                .catch(function (e) {
                    errorDisplay.innerText = 'Error accessing the camera: ' + e.message;
                    console.error(e);
                });
        });

        function scanQRCode() {
            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, canvas.width, canvas.height);

                if (code) {
                    errorDisplay.innerText = ''; // Clear any previous error message
                    statusDisplay.innerText = ''; // Clear status message
                    document.getElementById('result').innerHTML = "Scanned URN: " + code.data;
                    // Redirect to mark attendance page with scanned URN
                    window.location.href = 'mark_attendance.php?urn=' + encodeURIComponent(code.data);
                } else {
                    // Error message if no QR code is found in the current frame
                    errorDisplay.innerText = 'No QR code detected. Please try again.';
                }
            } else {
                errorDisplay.innerText = 'Waiting for video data...';
            }
            requestAnimationFrame(scanQRCode);
        }
    </script>
</body>
</html>
