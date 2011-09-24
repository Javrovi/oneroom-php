<?php
  /* acct_manage.php
   * ---------------
   * acct_manage.php is run when a user access a link to manage her
   * OneRoom account.  Two choices are presented to the user: to update
   * her email address or to change her password.
   */

  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions: only logged-in users can manage their accounts
  if (!$logged_in) {
    redirect('nopermissions.php');
  }
  
  // Set page title
  $page_title = 'Account Management';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Manage Your Account</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <p>
      <a href="email_change.php">Change Email</a> |
      <a href="password_change.php">Change Password</a>
    </p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


