DROP DATABASE IF EXISTS portal;

CREATE DATABASE portal;

USE portal;

DROP USER IF EXISTS 'portal';

CREATE USER 'portal'@'%' IDENTIFIED WITH mysql_native_password BY 'portal';

GRANT ALL PRIVILEGES ON portal . * TO 'portal'@'%';

FLUSH PRIVILEGES;

CREATE TABLE roles (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  task VARCHAR(30) NOT NULL
);

CREATE TABLE users(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(40) NOT NULL,
  role_id INT(6) UNSIGNED NOT NULL,
  FOREIGN KEY role_id_fk(role_id) REFERENCES roles(id)
);

CREATE TABLE submissions(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(300) NOT NULL,
  content TEXT NOT NULL,
  create_time DATETIME NOT NULL,
  create_user_id INT(6) UNSIGNED NOT NULL,
  FOREIGN KEY user_id_fk(create_user_id) REFERENCES users(id)
);

INSERT INTO roles(name, task) VALUES('Administration','admin');
INSERT INTO roles(name, task) VALUES('Member','member');

INSERT INTO users(firstname,lastname,email,password,role_id) VALUES('admin','admin','admin@admin.com',MD5('admin'),1);
