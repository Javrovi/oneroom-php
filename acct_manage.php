<?php
  /* acct_manage.php
   * ---------------
   * acct_manage.php is run when a user access a link to manage her
   * OneRoom account.  Two choices are presented to the user: to update
   * her email address or to change her password.
   */

  // Initialize page
  require_once('init_page.php');
 
  // Set page title
  $page_title = 'Account Management';
  
  // Set main content heading file
  $content_heading = 'acct_manage_heading.php';
  
  // Set main content body file
  $content_body = 'acct_manage_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

