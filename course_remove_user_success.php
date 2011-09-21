<?php
  /* course_remove_user_success.php
   * ---------------------------
   * course_remove_user_success.php is run when the user confirms that she
   * wants to add herself to a course.  
   */

  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Removal of User Successful';
  
  // Set main content heading file
  $content_heading = 'course_remove_user_success_heading.php';
  
  // Set main content body file
  $content_body = 'course_remove_user_success_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

