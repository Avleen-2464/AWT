CREATE TABLE education (
  id INT AUTO_INCREMENT PRIMARY KEY,
  institution VARCHAR(255),
  degree VARCHAR(255),
  start_year YEAR,
  end_year YEAR,
  description TEXT
);
CREATE TABLE achievements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  description TEXT
);
CREATE TABLE skills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  skill_type VARCHAR(255), -- E.g., 'Technical', 'Soft', 'Other'
  skill_description TEXT
);
