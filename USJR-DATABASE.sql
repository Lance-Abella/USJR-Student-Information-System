CREATE DATABASE USJR;
USE USJR;

CREATE TABLE users(
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL,
password VARCHAR(100) NOT NULL
);

INSERT INTO users(id, username, password)
VALUES (1, "LILBOSS", "sheesh");

select * from users;
select * from students;