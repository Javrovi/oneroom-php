<?php
  /* course_grade_edit.php
   * ---------------------
   * course_grade_edit.php is run when a teacher indicates that she wants to
   * edit a student's course grade.  Successful form submission updates the
   * student's course grade and redirects the teacher to
   * course_grade_edit_success.php.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Edit Course Grade';
  
  // Set main content heading file
  $content_heading = 'course_grade_edit_heading.php';
  
  // Set main content body file
  $content_body = 'course_grade_edit_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
// Close page
  require_once('close_page.php');
?>

