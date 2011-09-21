<?php
  /* course_add_teacher.php
   * ----------------------
   * course_add_teacher.php is run when a teacher confirms that she wants
   * to teach an existing course.  She is prompted for that course's course
   * passcode.  Next, the passcode is processed by course_add_user_success.php.
   */
  
  // Initialize page
  require_once('init_page.php');
  
  // Set page title
  $page_title = 'Enter Course Passcode';
  
  // Set main content heading file
  $content_heading = 'course_add_teacher_heading.php';
  
  // Set main content body file
  $content_body = 'course_add_teacher_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

