<?php
  /* course_remove_user.php
   * -------------------
   * course_remove_user.php is run when a user indicates that she wants to
   * remove herself from a course.  She is presented with a confirmation
   * question.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Remove User From Course';
  
  // Set main content heading file
  $content_heading = 'course_remove_user_heading.php';
  
  // Set main content body file
  $content_body = 'course_remove_user_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

