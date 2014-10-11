<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$title}</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />    
    {$pageStyles}
  </head>
  <body>
    <div class="main">
      <div class="top_menu">
        <div class="nav_panel">
          <a href="sign_in.php">Sign In</a><span> | </span>
          <a href="sign_up.php">Sign Up</a><span> | </span>
          <a href="upload_file.php">Upload File</a><span> | </span>
          <a href="get_user_info.php">Get User Info</a><span> | </span>
          <a href="user_list.php">User List</a><span> | </span>
          <a href="file_list.php">File List</a>
        </div>
        <div class="user_box">
          <span>{$userEmail}</span>
          <span> | </span>
          <a href="sign_in.php?log_out=true">Sign Out</a>
        </div>
      </div>
