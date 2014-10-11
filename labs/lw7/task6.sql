SELECT offer_id, customer.first_name, customer.last_name, dvd.title FROM customer, dvd, offer
WHERE
  (YEAR(offer_date) = YEAR(CURRENT_TIMESTAMP)) AND
  (offer.dvd_id = dvd.dvd_id) AND
  (offer.customer_id = customer.customer_id);