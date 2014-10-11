-- dvd
INSERT INTO dvd
  (title, production_year)
VALUES
  ('a', '2010');

INSERT INTO dvd
  (title, production_year)
VALUES
  ('c', '2010');

INSERT INTO dvd
  (title, production_year)
VALUES
  ('b', '2010');

INSERT INTO dvd
  (title, production_year)
VALUES
  ('d', '2005');

INSERT INTO dvd
  (title, production_year)
VALUES
  ('a', '2008');

-- customer
INSERT INTO customer
  (first_name, last_name, passport_code)
VALUES
  ('petya', 'iv', '8811073190');

INSERT INTO customer
  (first_name, last_name, passport_code)
VALUES
  ('kolya', 'ov', '8811073190');

INSERT INTO customer
  (first_name, last_name, passport_code)
VALUES
  ('sasha', 'mu', '8811073190');

INSERT INTO customer
  (first_name, last_name, passport_code)
VALUES
  ('vasya', 'k', '8811073190');

INSERT INTO customer
  (first_name, last_name, passport_code)
VALUES
  ('masha', 'sk', '8811073190');

-- offer
INSERT INTO offer
  (dvd_id, customer_id, offer_date, return_date)
VALUES
  (1, 1, '2014-03-07 19:22:13', '2014-12-07 19:22:13'),
  (2, 3, '2014-03-07 19:22:13', '2015-03-07 19:22:13'),
  (3, 2, '2012-03-07 19:22:13', '2013-03-07 19:22:13'),
  (4, 5, '2014-03-07 19:22:13', '2015-03-07 19:22:13'),
  (5, 4, '2014-03-07 19:22:13', '2014-03-07 19:22:13');
