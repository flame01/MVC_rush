#CREATE USER 'Client'@'localhost' IDENTIFIED BY 'Barcelona.20';
#GRANT SELECT, INSERT, UPDATE, DELETE ON MVC_rush.* TO Client@'localhost';
#DROP TABLE IF EXISTS User;
CREATE DATABASE IF NOT EXISTS MVC_rush;
USE MVC_rush;

CREATE TABLE User (
	user_id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(255),
    password VARCHAR(255),
	email VARCHAR(255),
    group_id INT NOT NULL DEFAULT '2',
    is_banned TINYINT(4) NOT NULL DEFAULT '0',
    is_activated TINYINT(4) NOT NULL DEFAULT '1',
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_modification TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id)
);

INSERT INTO User(username, password, email)
VALUES ('user1', '1234', 'user1@email.com'),
('user2', '1234', 'user2@email.com'),
('user3', '1234', 'user3@email.com'),
('user4', '1234', 'user4@email.com'),
('user5', '1234', 'user5@email.com');
SELECT * FROM User;


