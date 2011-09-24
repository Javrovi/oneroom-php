<?php
  /* acct_change_success.php
   * -----------------------
   * acct_change_success.php is run when a user has successfully updated
   * her OneRoom account (e.g., updated her email or password).  A message
   * of successful update is displayed to the user.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Set page title
  $page_title = 'Update Successful';

  // Permissions: only logged-in users can manage their accounts
  if (!$logged_in) {
    redirect('nopermissions.php');
  }
 
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Account Successfully Updated</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <p>
      Your account has been successfully updated.  Access 
      <a href="usercourses.php">your courses</a> or go back to the
      <a href="home.php">Home</a> page.
    </p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>
