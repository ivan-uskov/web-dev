-- #1
CREATE TABLE dvd
(
  dvd_id SERIAL,
  title VARCHAR(255) NOT NULL,
  production_year YEAR NULL,
  PRIMARY KEY (dvd_id)
);

-- #2
CREATE TABLE customer
(
  customer_id SERIAL,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  passport_code VARCHAR(255) NOT NULL,
  registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (customer_id)
);

-- #3
CREATE TABLE offer
(
  offer_id SERIAL,
  dvd_id BIGINT UNSIGNED,
  customer_id BIGINT UNSIGNED,
  offer_date TIMESTAMP NOT NULL,
  return_date TIMESTAMP NULL,
  PRIMARY KEY (offer_id)
);

