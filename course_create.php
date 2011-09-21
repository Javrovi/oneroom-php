<?php
  /* course_create.php
   * -----------------
   * course_create.php is run when a teacher clicks on a link to create
   * a new course.  A course creation form is displayed.  If the form is
   * filled out without errors, a new course is created and the teacher is
   * redirected to course_create_success.php.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Create Course';
  
  // Set main content heading file
  $content_heading = 'course_create_heading.php';
  
  // Set main content body file
  $content_body = 'course_create_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');

  // Close page
  require_once('close_page.php');
?>

