<?php
  /* register.php
   * ------------
   * register.php registers a new user for OneRoom.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'User Registration';
  
  // Set main content heading file
  $content_heading = 'register_heading.php';
  
  // Set main content body file
  $content_body = 'register_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
// Close page
  require_once('close_page.php');
?>

