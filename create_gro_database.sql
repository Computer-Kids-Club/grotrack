CREATE DATABASE groceries;
GRANT ALL ON groceries.* TO 'groperson'@'localhost';

USE groceries;

CREATE TABLE your_groceries(
    gro_id INT AUTO_INCREMENT,
    gro_barcode VARCHAR(50),
    gro_name VARCHAR(20),
    gro_amount INT,
    gro_exp_date DATE,
    PRIMARY KEY(gro_id)
);


-- run once --
-- user setup --------------------------------------------------
CREATE USER 'groperson'@'localhost' IDENTIFIED BY 'gropassword';
ALTER USER 'groperson'@'localhost' IDENTIFIED WITH mysql_native_password by 'gropassword';