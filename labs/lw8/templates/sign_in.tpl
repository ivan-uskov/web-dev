  <div class="form_container">
    <h4>Sign In</h4>
    <p>{$info}</p>
    <hr />
    <form action="sign_in.php" method="post" enctype="application/x-www-form-urlencoded">
      <div class="form_line">
        <div class="text_input_box">
          <input type="text" name="email" id="email" required="required" />
        </div>
        <label for="email">Your Email:</label>
        <div class="clear"></div>
      </div>
      <div class="form_line">
        <div class="text_input_box">
          <input type="password" name="password" id="password" required="required" />
        </div>
        <label for="password">New Password:</label>
        <div class="clear"></div>
      </div>
      <div class="button_box">
        <p>Thanks for use as!</p>
        <div class="submit_button">
          <input type="submit" value=""/>
        </div>
      </div>
    </form>
  </div>