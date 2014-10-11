  <div class="form_container">
    <h4>Sign Up</h4>
    <p>{$info}</p>
    <hr />
    <form action="sign_up.php" method="post" enctype="application/x-www-form-urlencoded" id="reg_form">
      <div class="form_line">
        <p class="error">Wrong!, you should write min 1 symbol of a-z A-Z or '.', ' ','-'</p>
        <div class="text_input_box">
          <input type="text" name="first_name" id="first_name" />
        </div>
        <label for="first_name">First Name:</label>
        <div class="clear"></div>
      </div>
      <div class="form_line">
        <p class="error">Wrong!, you should write min 1 symbol of a-z A-Z or '.', ' ','-'</p>
        <div class="text_input_box">
          <input type="text" name="last_name" id="last_name" />
        </div>
        <label for="last_name">Last Name:</label>
        <div class="clear"></div>
      </div>
      <div class="form_line">
        <p class="error">Wrong!, you should write correct email</p>
        <div class="text_input_box">
          <input type="text" name="email" id="email" />
        </div>
        <label for="email">Your Email:</label>
        <div class="clear"></div>
      </div>
      <div class="form_line">
        <p class="error">Wrong!, you should write correct email</p>
        <div class="text_input_box">
          <input type="text" name="re_email" id="re_email" />
        </div>
        <label for="re_email">Re-enter Email:</label>
        <div class="clear"></div>
      </div>
      <div class="form_line">
        <p class="error">
          Wrong!, you should write min 6 symbol of english alphabet.
        </p>
        <div class="text_input_box">
          <input type="password" name="password" id="password" />
        </div>
        <label for="password">New Password:</label>
        <div class="clear"></div>
        <p>Strength:<span id="password_strength">0</span></p>
      </div>
      <div class="form_line select_box">
        <div class="text_input_box select_sex_box">
          <select name="i_am" id="i_am">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="Not Selected" selected="selected" hidden>Select Sex:</option>
          </select>
        </div>
        <label for="i_am">I am:</label>
        <div class="clear"></div>
      </div>
      <div class="form_line select_box">
        <div class="text_input_box select_year_box">
          <select name="year" id="year">
            {$genYears}            
            <option value="Not Selected" selected="selected" hidden>Year:</option>
          </select>
        </div>
        <div class="text_input_box select_day_box">
          <select name="day" id="day">
            {$genDays}
            <option value="Not Selected" selected="selected" hidden>Day:</option>
          </select>
        </div>
        <div class="text_input_box select_month_box">
          <select name="month" id="month">
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
            <option value="Not Selected" selected="selected" hidden>Month:</option>
          </select>
        </div>
        <label for="month">Birthday:</label>
        <div class="clear"></div>
      </div>
      <div class="button_box">
        <p>Why do I need to provide this?</p>
        <p class="divergent_email" id="divergent_email">Email should match!</p>
        <div class="submit_button">
          <input type="submit" value=""/>
        </div>
      </div>
    </form>
  </div>