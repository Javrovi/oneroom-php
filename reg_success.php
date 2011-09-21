<?php
  /* reg_success.php
   * ------------
   * reg_success.php lets the user know that she has successfullty registered.
   */
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Registration Successful';
  
  // Set main content heading file
  $content_heading = 'reg_success_heading.php';
  
  // Set main content body file
  $content_body = 'reg_success_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

