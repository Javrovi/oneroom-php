<?php
  /* course_edit_success.php
   * -----------------------
   * course_edit_success.php is run when a course has been successfully
   * edited by one of its teacher.  A success message is displayed.
   */
  
  // Initialize page
  require_once('init_page.php');
 
  // Set page title
  $page_title = 'Course Update Successful';
  
  // Set main content heading file
  $content_heading = 'course_edit_success_heading.php';
  
  // Set main content body file
  $content_body = 'course_edit_success_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

