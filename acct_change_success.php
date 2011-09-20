<?php
  /* acct_change_success.php
   * -----------------------
   * acct_change_success.php is run when a user has successfully updated
   * her OneRoom account (e.g., updated her email or password).  A message
   * of successful update is displayed to the user.
   */
  
  // Initialize page
  require_once('init_page.php');
 
  // Set page title
  $page_title = 'Update Successful';
  
  // Set main content heading file
  $content_heading = 'acct_change_success_heading.php';
  
  // Set main content body file
  $content_body = 'acct_change_success_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

