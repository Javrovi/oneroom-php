<?php
  /* grade_edit_success.php
   * -----------------------------
   * grade_edit_success.php is run when a grade has been
   * successfully edited by a teacher.  A success message is displayed.
   */
  // Initialize page
  require_once('init_page.php');
 
  // Set page title
  $page_title = 'Grade Input Successful';
  
  // Set main content heading file
  $content_heading = 'grade_edit_success_heading.php';
  
  // Set main content body file
  $content_body = 'grade_edit_success_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

