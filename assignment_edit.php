<?php
  /* assignment_edit.php
   * -------------------
   * assignment_edit.php is run when a teacher clicks on a link on
   * course_page.php to edit an assignment.  The teacher is presented with a
   * form, in which the assignment's old data is pre-filled in.  After form
   * submission, the teacher is redirected to assignment_edit_success.php
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Edit Assignment';
  
  // Set main content heading file
  $content_heading = 'assignment_edit_heading.php';
  
  // Set main content body file
  $content_body = 'assignment_edit_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
// Close page
  require_once('close_page.php');
?>

