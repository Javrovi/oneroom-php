<?php
  /* course_add_teacher_bad_passcode.php
   * -----------------------------------
   * course_add_teacher_bad_passcode.php is run when a teacher attempts to
   * add herself to a course but inputs an incorrect passcode for that course.
   * The user is provided with a link to try again.
   */
  
  // Initialize page
  require_once('init_page.php');
 
  // Set page title
  $page_title = 'Invalid Course Passcode';
  
  // Set main content heading file
  $content_heading = 'course_add_teacher_bad_passcode_heading.php';
  
  // Set main content body file
  $content_body = 'course_add_teacher_bad_passcode_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

