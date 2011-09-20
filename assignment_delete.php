<?php
  /* assignment_delete.php
   * ---------------------
   * assignment_delete.php is run when a teacher clicks on a link on the course
   * page to delete an assignment. The teacher is asked to confirm that she
   * really wants to delete the assignment.  If confirmed, she is redirected to
   * assignment_delete_success.php.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Delete Assignment';
  
  // Set main content heading file
  $content_heading = 'assignment_delete_heading.php';
  
  // Set main content body file
  $content_body = 'assignment_delete_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

