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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #74ebd5, #9face6);
        }

        .scanner-container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            color: #343a40;
        }

        #startButton {
            font-size: 18px;
            padding: 12px 30px;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            border: none;
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            margin-top: 20px;
        }

        #startButton:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
        }

        #preview {
            margin-top: 20px;
            border-radius: 10px;
            border: 4px solid #007bff;
            width: 100%;
            max-width: 450px;
        }

        #status {
            margin-top: 20px;
            font-size: 16px;
            color: #6c757d;
        }

        #error {
            color: #dc3545;
            font-size: 14px;
            font-weight: 600;
        }

        .highlight {
            display: none;
            margin-top: 20px;
            padding: 20px;
            font-size: 18px;
            color: #155724;
            background-color: #d4edda;
            border: 2px solid #c3e6cb;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="scanner-container">
    <h1>QR Attendance Scanner</h1>
    <button id="startButton" class="btn">Start Scanning</button>
    <video id="preview" class="mt-4"></video>
    <canvas id="canvas" class="d-none"></canvas>
    
    <div id="status" class="mt-3">Click "Start Scanning" to begin.</div>
    <div id="error" class="mt-2"></div>
    <div id="result" class="highlight mt-3"></div>
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
                startButton.style.display = 'none'; 
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
                resultDisplay.style.display = 'block';
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
