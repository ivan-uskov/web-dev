<div class="form_container">
    <h4>File List</h4>
    <p>List Of Users</p>
    <hr />
    <div class="user_data">
      <div class="table_conteiner">
        <div class="filter_form">
          <form action="file_list.php" method="GET" enctype="application/x-www-form-urlencoded">
            <div class="form_line">
              <div class="text_input_box">
                <input type="text" name="email" id="email" value="{$email}"/>
              </div>
              <label for="email">User Email:</label>
              <div class="clear"></div>
            </div>
            <div class="form_line">
              <div class="text_input_box">
                <input type="text" name="ext" id="ext" value="{$ext}"/>
              </div>
              <label for="ext">File Ext:</label>
              <div class="clear"></div>
            </div>
            <div class="button_box">
              <input type="submit" value=""/>
            </div>
          </form>
        </div>
        <table>
          <tr><th>Id</th><th>File Name</th><th>User Name</th><th>Email</th><th>Add Date</th></tr>
          {$files}
        </table>
      </div>
    </div>
</div>