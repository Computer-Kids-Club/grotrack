CREATE DATABASE groceries;
GRANT ALL ON groceries.* TO 'groperson'@'localhost';

USE groceries;

CREATE TABLE users(
    id INT AUTO_INCREMENT,
    name VARCHAR(20),
    uuid VARCHAR(23),
    PRIMARY KEY(id)
);

CREATE TABLE groceries(
    id INT AUTO_INCREMENT,
    barcode VARCHAR(50),
    name VARCHAR(100),
    amount INT,
    exp_date DATE,
    user_id INT,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id)
);




-- run once --
-- user setup --------------------------------------------------
CREATE USER 'groperson'@'localhost' IDENTIFIED BY 'gropassword';
ALTER USER 'groperson'@'localhost' IDENTIFIED WITH mysql_native_password by 'gropassword';