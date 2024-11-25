<?php
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Attendance Scanner</title>
    <script src="jsQR.js"></script>
    <link href="https:
    <style>
        body, html {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        .scanner-container {
            text-align: center;
            max-width: 500px;
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        #preview {
            width: 100%;
            max-width: 400px;
            height: auto;
            margin-top: 20px;
            border: 3px solid #007bff;
            border-radius: 5px;
        }

        #startButton {
            font-size: 18px;
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        #startButton:hover {
            background-color: #0056b3;
        }

        #status {
            font-weight: bold;
            color: #6c757d;
            margin-top: 15px;
        }

        #error {
            color: #dc3545;
            font-weight: bold;
        }

        .highlight {
            margin-top: 20px;
            padding: 15px;
            font-size: 20px;
            color: #155724;
            background-color: #d4edda;
            border: 2px solid #c3e6cb;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="scanner-container">
        <h1 class="mb-4">QR Attendance Scanner</h1>
        <button id="startButton" class="btn">Start Scanning</button>
        <video id="preview" class="mx-auto d-block"></video>
        <canvas id="canvas" class="d-none"></canvas>
        
        <div id="status" class="mt-3">Click "Start Scanning" to begin.</div>
        <div id="error" class="mt-3"></div>
        <div id="result" class="highlight d-none"></div> 
    </div>

    <script>
        const video = document.getElementById('preview');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d', { willReadFrequently: true }); 
        const errorDisplay = document.getElementById('error');
        const statusDisplay = document.getElementById('status');
        const resultDisplay = document.getElementById('result');
        const startButton = document.getElementById('startButton');

        startButton.addEventListener('click', function () {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
                .then(function (stream) {
                    video.srcObject = stream;
                    video.setAttribute("playsinline", true); 
                    video.play();
                    video.style.display = 'block'; 
                    startButton.hidden = true; 
                    statusDisplay.innerText = 'Scanning started...'; 
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
                    errorDisplay.innerText = ''; 
                    statusDisplay.innerText = ''; 
                    resultDisplay.classList.remove('d-none'); 
                    resultDisplay.innerHTML = "Scanned URN: " + code.data;
                    
                    setTimeout(() => {
                        window.location.href = 'mark_attendance.php?urn=' + encodeURIComponent(code.data);
                    }, 2000); 
                } else {
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
