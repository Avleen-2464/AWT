CREATE DATABASE expense_management; --database creation 

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'family_member') DEFAULT 'family_member',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Expenses Table
CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    user_id INT,
    date_added DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create Monthly Expenses Table
CREATE TABLE monthly_expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    month_year VARCHAR(7) NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    admin_id INT,
    FOREIGN KEY (admin_id) REFERENCES users(id)
);


-- family expenses table
CREATE TABLE family_expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    expense_id INT,
    user_id INT,
    contribution DECIMAL(10, 2),
    FOREIGN KEY (expense_id) REFERENCES expenses(id),
    FOREIGN KEY (user_id) REFERENCES users(id)  -- Assuming there's a users table
);
