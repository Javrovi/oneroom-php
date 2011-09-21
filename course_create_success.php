<?php
  /* course_create_success.php
   * -------------------------
   * course_create_success.php is run when a course has been successfully
   * created by a teacher.  A success message is displayed to the teacher.
   */
  
  // Initialize page
  require_once('init_page.php');
 
  // Set page title
  $page_title = 'Course Create Successful';
  
  // Set main content heading file
  $content_heading = 'course_create_success_heading.php';
  
  // Set main content body file
  $content_body = 'course_create_success_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

