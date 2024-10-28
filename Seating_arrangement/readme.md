CREATE TABLE seats (
    seat_number INT(11) PRIMARY KEY,
    roll_number INT(11) NULL,
    is_occupied TINYINT(1) NOT NULL DEFAULT 0,
    is_odd TINYINT(1) NOT NULL
);
