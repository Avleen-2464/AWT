-- Table to store seat allocation details
CREATE TABLE seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seat_number INT NOT NULL,
    occupied BOOLEAN DEFAULT FALSE,
    roll_number INT UNIQUE
);

-- Table to manage students on the waiting list
CREATE TABLE waiting_list (
    id INT AUTO_INCREMENT PRIMARY KEY,
    roll_number INT NOT NULL UNIQUE,
    wl_number INT NOT NULL
);
