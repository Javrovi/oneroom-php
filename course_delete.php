<?php
  /* course_delete.php
   * -----------------
   * course_delete.php is run when a teacher indicates that she wishes to
   * delete one of her courses.  She is prompted to confirm her request.
   * If confirmed, course_delete_success.php is run.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Delete Course';
  
  // Set main content heading file
  $content_heading = 'course_delete_heading.php';
  
  // Set main content body file
  $content_body = 'course_delete_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

