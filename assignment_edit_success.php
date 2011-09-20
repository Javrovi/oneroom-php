<?php
  /* assignment_edit_success.php
   * ---------------------------
   * assignment_edit_success.php is run when an assignment is successfully
   * updated.  The teacher is informed that the assignment has been updated.
   */
  
  // Initialize page
  require_once('init_page.php');
 
  // Set page title
  $page_title = 'Assignment Update Successful';
  
  // Set main content heading file
  $content_heading = 'assignment_edit_success_heading.php';
  
  // Set main content body file
  $content_body = 'assignment_edit_success_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

