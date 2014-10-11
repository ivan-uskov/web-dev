SELECT title FROM dvd
WHERE dvd_id IN
  (
    SELECT dvd_id FROM offer
    WHERE
      (offer_date < CURRENT_TIMESTAMP()) AND (return_date > CURRENT_TIMESTAMP())
  ) ORDER BY title;
