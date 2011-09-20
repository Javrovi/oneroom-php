<?php
  /* 500.php
   * -------
   * 500.php is run when an internal server error is encountered, such as when
   * a bad result from the database is received.  The user is alerted of a
   * server error, and is provided with a link back to OneRoom's home page.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Server Error';
  
  // Set main content heading file
  $content_heading = '500_heading.php';
  
  // Set main content body file
  $content_body = '500_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

