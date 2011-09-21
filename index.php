<?php
  /* index.php
   * ---------
   * index.php is OneRoom's home page.  Different welcome messages are
   * displayed for anonymous users and logged-in users.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Home';
  
  // Set main content heading file
  $content_heading = 'index_heading.php';
  
  // Set main content body file
  $content_body = 'index_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

