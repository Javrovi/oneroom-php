<?php
  // Initialize page
  require_once('init_page.php');
  
  // Set page title
  $page_title = 'Search Courses';
  
  // Set main content heading file
  $content_heading = 'search_heading.php';
  
  // Set main content body file
  $content_body = 'search_body.php';
  
  // Set Javascript file
  $include_script =
    '<script src="scripts/search.js" type="text/javascript"></script>';
  
  // Render with 'base.php' template, unless it's a ajax request
  if (isset($_GET['ajax'])) {
    require_once($content_body);
  } else {
    require_once('base.php');
  }
  
  // Close page
  require_once('close_page.php');
?>

