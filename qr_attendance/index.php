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
