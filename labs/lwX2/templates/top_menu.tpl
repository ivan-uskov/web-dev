<div class="top_menu">
  <div class="logo"><a href="sign_in.php">Web Users</a></div>
  <div class="nav_panel">
    <ul class="menu">
      <li>
        <a href="sign_in.php">Sign</a>
        <span>|</span>
        <ul>
          <li><a href="sign_in.php">Sign In</a></li>
          <li><a href="sign_up.php">Sign Up</a></li>
        </ul>
      </li>
      <li>
        <a href="upload_file.php">Upload File</a>
        <span>|</span>
      </li>
      <li>
        <a href="get_user_info.php">Get User Info</a>
        <span>|</span>
      </li>
      <li>
        <a href="user_list.php">Lists</a>
        <ul>
          <li><a href="user_list.php">User List</a></li>
          <li><a href="file_list.php">File List</a></li>
        </ul>
      </li>
    </ul>
    <div class="user_box">
      <span>{$userEmail}</span>
      <span> | </span>
      <a href="sign_in.php?log_out=true">Sign Out</a>
    </div>
  </div>
</div>