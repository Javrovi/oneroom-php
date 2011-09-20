<?php
  /* assignment_create_success.php
   * -----------------------------
   * assignment_create_success.php is run after an assignment has been
   * successfully created.  A link back to the course in which the assignment
   * has been created is provided to the user.
   */
  
  // Initialize page
  require_once('init_page.php');
 
  // Set page title
  $page_title = 'Assignment Addition Successful';
  
  // Set main content heading file
  $content_heading = 'assignment_create_success_heading.php';
  
  // Set main content body file
  $content_body = 'assignment_create_success_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

