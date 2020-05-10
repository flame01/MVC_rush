#CREATE USER 'Client'@'localhost' IDENTIFIED BY 'Barcelona.20';
#GRANT SELECT, INSERT, UPDATE, DELETE ON MVC_rush.* TO Client@'localhost';

CREATE DATABASE IF NOT EXISTS MVC_rush;
USE MVC_rush;

#DROP TABLE IF EXISTS User;
CREATE TABLE User (
	user_id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(255),
	email VARCHAR(255),
    password VARCHAR(255),
    group_id INT NOT NULL DEFAULT '2',
    is_banned TINYINT(4) NOT NULL DEFAULT '0',
    is_activated TINYINT(4) NOT NULL DEFAULT '1',
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_modification TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id)
);

#DROP TABLE IF EXISTS Article;
CREATE TABLE Article (
	article_id INT NOT NULL AUTO_INCREMENT,
	content VARCHAR(2000),
	title VARCHAR(255),
    created_by VARCHAR(255),
    category_id INT NOT NULL DEFAULT '0',
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_modification TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(article_id)
);

#DROP TABLE IF EXISTS Comment;
CREATE TABLE Comment (
	comment_id INT NOT NULL AUTO_INCREMENT,
	content VARCHAR(2000),
    article_id INT NOT NULL DEFAULT '0',
    commented_by VARCHAR(255),
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_modification TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(comment_id)
);



INSERT INTO User(username, password, email)
VALUES ('Blueplant12', '1234', 'vegan@iam.com'),
('k3yb0ard', '1234', 'key@email.com'),
('darkswan', '1234', 'dark@swan.com'),
('user', '1234', 'user@user.com'),
('user2', '1234', 'user2@user.com'),
('user3', '1234', 'user3@user.com'),
('pipo', '1234', 'pipo@email.com');

INSERT INTO User(username, password, email, group_id)
VALUES ('admin', '123', 'admin@system.com', 0),
('writer', '123', 'writer@email.com', 1);

SELECT * FROM User;


