<?php
  /* assignment_create.php
   * ---------------------
   * assignment_create.php is run when a teacher of a course clicks a link
   * to create a new assignment.  A form is provided, in which the teacher
   * inputs the name of the assignment and its due date.  A new assignment
   * is created with the input and added to the assignments table if the
   * form has no validation errors.  After assignment creation, the teacher
   * is directed to assignment_create_success.php
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Create Assignment';
  
  // Set main content heading file
  $content_heading = 'assignment_create_heading.php';
  
  // Set main content body file
  $content_body = 'assignment_create_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');

  // Close page
  require_once('close_page.php');
?>

