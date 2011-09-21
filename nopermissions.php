<?php
  /* nopermissions.php
   * -----------------
   * nopermissions.php displays a "Access Denied" message when a user
   * tries to access a page she has no permission to access.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Access Denied';
  
  // Set main content heading file
  $content_heading = 'nopermissions_heading.php';
  
  // Set main content body file
  $content_body = 'nopermissions_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

