<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Seating Arrangement</title>
    <style>
        .matrix-container {
            display: flex;
            justify-content: center; /* Center the matrix horizontally */
            margin-bottom: 20px;
        }

        .matrix {
            display: grid;
            grid-template-columns: repeat(5, 50px);
            grid-template-rows: repeat(5, 50px);
            gap: 5px;
        }

        .seat {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #000;
            font-size: 20px;
        }

        .occupied {
            background-color: red;
        }

        .available {
            background-color: green;
        }

        .message {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .legend {
            display: flex;
            margin-top: 20px;
            align-items: center;
        }

        .legend div {
            width: 20px;
            height: 20px;
            border: 1px solid #000;
            margin-right: 5px;
        }

        .legend .available {
            background-color: green;
        }

        .legend .occupied {
            background-color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Seating Arrangement</h1>
        <div class="form-group">
            <label for="rollNumber">Enter Roll Number:</label>
            <input type="number" id="rollNumber" class="form-control" placeholder="Enter your roll number" />
            <button id="allocateSeat" class="btn btn-primary mt-2">Allocate Seat</button>
        </div>
        
        <div class="matrix-container">
            <div class="matrix" id="seatMatrix"></div>
        </div>

        <div class="legend">
            <div class="available"></div> <span>Available</span>
            <div class="occupied"></div> <span>Occupied</span>
        </div>

        <div id="message" class="message"></div>
    </div>

    <script>
        // Initialize seats
        const seats = Array.from({ length: 25 }, (_, i) => ({
            number: i + 1,
            occupied: false,
            rollNumber: null
        }));

        const seatMatrix = document.getElementById('seatMatrix');
        const messageDiv = document.getElementById('message');
        const rollNumberInput = document.getElementById('rollNumber');
        const allocateSeatButton = document.getElementById('allocateSeat');

        // Render seats
        function renderSeats() {
            seatMatrix.innerHTML = '';
            seats.forEach(seat => {
                const seatDiv = document.createElement('div');
                seatDiv.classList.add('seat', seat.occupied ? 'occupied' : 'available');
                seatDiv.textContent = seat.number;
                seatMatrix.appendChild(seatDiv);
            });
        }

        // Allocate seat
        allocateSeatButton.addEventListener('click', () => {
            const rollNumber = parseInt(rollNumberInput.value);
            const existingSeat = seats.find(seat => seat.rollNumber === rollNumber);
            
            if (!rollNumber) {
                messageDiv.textContent = 'Please enter a roll number.';
                return;
            }

            if (existingSeat) {
                messageDiv.textContent = `Seat number ${existingSeat.number} has already been allotted to you.`;
                return;
            }

            const seatToAllocate = seats.find(seat => seat.occupied === false && ((seat.number % 2 === 1 && rollNumber % 2 === 1) || (seat.number % 2 === 0 && rollNumber % 2 === 0)));

            if (seatToAllocate) {
                seatToAllocate.occupied = true;
                seatToAllocate.rollNumber = rollNumber;
                renderSeats();
                messageDiv.textContent = `Seat number ${seatToAllocate.number} allocated to roll number ${rollNumber}.`;
            } else {
                messageDiv.textContent = `No available seats for roll number ${rollNumber}.`;
            }
        });

        // Initial render
        renderSeats();
    </script>
</body>
</html>
