CREATE DATABASE IF NOT EXISTS schedule_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE schedule_db;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_number VARCHAR(10) NOT NULL UNIQUE
);

CREATE TABLE teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    teacher_id INT,
    subject VARCHAR(255),
    description TEXT,
    start DATETIME,
    end DATETIME,
    room VARCHAR(100),
    lesson_form VARCHAR(50),
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (teacher_id) REFERENCES teachers(id)
);
