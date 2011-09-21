<?php
  /* grade_edit.php
   * ---------------------
   * grade_edit.php is run when a teacher indicates that she wants to
   * edit a student's grade for an assignment.  Successful form submission
   * updates the student's grade for the assignment and redirects the teacher to
   * grade_edit_success.php.
   */
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Edit Grade';
  
  // Set main content heading file
  $content_heading = 'grade_edit_heading.php';
  
  // Set main content body file
  $content_body = 'grade_edit_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
// Close page
  require_once('close_page.php');
?>

