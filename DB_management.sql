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

#DROP TABLE IF EXISTS Article;
CREATE TABLE Article (
	article_id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
	content VARCHAR(2000),
    created_by VARCHAR(255) NOT NULL DEFAULT 'admin',
    category_id INT NOT NULL DEFAULT '0',
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_modification TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(article_id)
);

INSERT INTO Article(title, content)
VALUES ('About how I earned 1 million dooola', 'So my whole life, really it has been a NO and I fought through it. I started off in brooklyn, my father gave me a small loan of 1 million dollar, I came into Manhattan and I had to pay him back with interests'),
('Sample title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
('Hola me llamo Roberto', 'Es broma no me llamo Roberto, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore'),
('Article 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
('Donde conseguir Lore Ipsum ', 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles, pero la mayoría sufrió alteraciones en alguna manera, ya sea porque se le agregó humor, o palabras aleatorias que no parecen ni un poco creíbles. Si vas a utilizar un pasaje de Lorem Ipsum, necesitás estar seguro de que no hay nada avergonzante escondido en el medio del texto. Todos los generadores de Lorem Ipsum');

SELECT * FROM Article;

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





