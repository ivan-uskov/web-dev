CREATE DATABASE people;

CREATE TABLE users
(
    user_id SERIAL,
    first_name VARCHAR(255) NULL,
    last_name VARCHAR(255) NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    gender VARCHAR(30) NULL,
    birthday DATETIME NULL,
    reg_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id)
);

CREATE TABLE user_files
(
    file_id SERIAL,
    user_id BIGINT UNSIGNED NOT NULL,
    add_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    file_ext VARCHAR(255) NOT NULL,
    real_name VARCHAR(255) NULL,
    PRIMARY KEY(file_id),
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
