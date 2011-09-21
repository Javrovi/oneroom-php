<?php
  /* course_delete_success.php
   * -------------------------
   * course_delete_success.php is run when a teacher confirms that she
   * wishes to delete a course.  The course is then removed from the database.
   * A success message is displayed after removal.
   */
  
  // Initialize page
  require_once('init_page.php');

  // Set page title
  $page_title = 'Course Deletion Successful';
  
  // Set main content heading file
  $content_heading = 'course_delete_success_heading.php';
  
  // Set main content body file
  $content_body = 'course_delete_success_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

