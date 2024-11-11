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
CREATE TABLE profile (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) DEFAULT NULL,
    profile_image VARCHAR(255) DEFAULT NULL,
    bio TEXT DEFAULT NULL,
    resume_link VARCHAR(255) DEFAULT NULL,
    projects_link VARCHAR(255) DEFAULT NULL,
    contact_link VARCHAR(255) DEFAULT NULL
INSERT INTO profile (name, profile_image, bio, resume_link, projects_link, contact_link)
VALUES 
('Ishpreet Singh', 'ishpreet_singh.jpg', 'Interested in Artificial Intelligence and Machine Learning. Experienced with Python libraries such as NumPy, Pandas, and TensorFlow.', 
'http://example.com/resume.pdf', 'http://example.com/projects', 'http://example.com/contact');

CREATE TABLE profile_info (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    linkedin VARCHAR(255) NOT NULL
);
INSERT INTO profile_info (email, linkedin)
VALUES ('itsnagpals@gmail.com', 'https://www.linkedin.com/in/ishpreet-singh/');
CREATE TABLE projects (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    github_link VARCHAR(255) DEFAULT NULL
);
UPDATE profile_info
SET linkedin = 'https://www.linkedin.com/in/ishpreet-singh/'
WHERE email = 'itsnagpals@gmail.com';
