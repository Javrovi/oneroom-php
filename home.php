<?php
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Home';
  
  // Set main content heading file
  $content_heading = 'home_heading.php';
  
  // Set main content body file
  $content_body = 'home_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

