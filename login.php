<?php
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Login';
  
  // Set main content heading file
  $content_heading = 'login_heading.php';
  
  // Set main content body file
  $content_body = 'login_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');

  // Close page
  require_once('close_page.php');
?>

