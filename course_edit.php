<?php
  /* course_edit.php
   * ---------------
   * course_edit.php is run when a teacher indicates that she wants to edit a
   * course.  A course edit form is presented, the form fields filled in
   * with the current course information.  Successful form submission updates
   * the course in the database, and the teacher is redirected to
   * course_edit_success.php.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Edit Course';
  
  // Set main content heading file
  $content_heading = 'course_edit_heading.php';
  
  // Set main content body file
  $content_body = 'course_edit_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
// Close page
  require_once('close_page.php');
?>

