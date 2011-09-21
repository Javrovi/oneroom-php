<?php
  /* course_add_user.php
   * -------------------
   * course_add_user.php is run when a user indicates that she wants to
   * add herself to a course.  She is presented with a confirmation question.
   */
  
  // Initialize page
  require_once('init_page.php');
 
  // Set page title
  $page_title = 'Add User To Course';
  
  // Set main content heading file
  $content_heading = 'course_add_user_heading.php';
  
  // Set main content body file
  $content_body = 'course_add_user_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

