CREATE DATABASE groceries;
USE groceries;

CREATE TABLE your_groceries(
    gro_id INT,
    gro_name VARCHAR(20),
    gro_amount INT,
    gro_exp_date DATE,
    PRIMARY KEY(gro_id)
);