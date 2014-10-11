<div class="form_container">
  <h4>Upload File</h4>
  <p>Please match file</p>
  <hr />
  <form action="upload_file.php" method="post" enctype="multipart/form-data">
    <div class="form_line">
      <div class="text_input_box">
        <input type="file" name="user_file" id="file" required="required" />
      </div>
      <label for="file">File:</label>
      <div class="clear"></div>
    </div>
    <div class="button_box">
      <input type="submit" value=""/>
    </div>
  </form>
</div>
