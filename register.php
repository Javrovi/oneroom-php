<?php
  // Set page title
  $page_title = 'User Registration';
  
  // Set up any globals
  require_once('connectvars.php');
  
  // Set main content heading file
  $content_heading = 'register_heading.php';
  
  // Set main content body file
  $content_body = 'register_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  mysqli_close($dbc);
?>

