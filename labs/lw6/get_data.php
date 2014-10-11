<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/form_styles.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/show_data_styles.css" media="all" />
  </head>
  <body>
    <div class="form_container">
      <h4>Show Data</h4>
      <p>Please enter Email</p>
      <hr />
      <form action="show_data.php" method="get" enctype="application/x-www-form-urlencoded">
        <div class="form_line">
          <div class="text_input_box">
            <input type="text" name="email" id="email" required="required" />
          </div>
          <label for="email">Your Email:</label>
          <div class="clear"></div>
        </div>
        <div class="button_box">
          <input type="submit" value=""/>
        </div>
      </form>
    </div>
  </body>
</html>