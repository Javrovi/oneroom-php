<?php
  // Set page title
  $page_title = 'User Registration';
  
  // Connect to the database
  require_once('connectvars.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
          die('Cannot connect to databse.');
  
  // Set main content heading file
  $content_heading = 'register_heading.php';
  
  // Set main content body file
  $content_body = 'register_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  mysqli_close($dbc);
?>

