<?php
  /* reg_success.php
   * ------------
   * reg_success.php lets the user know that she has successfullty registered.
   */
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Set page title
  $page_title = 'Registration Successful';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Thank you for registering with OneRoom!</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <p>
      Your registration with OneRoom was successful.
      Now you can access <a href="usercourses.php">your courses </a>
      or go back to the <a href="home.php">Home</a> page.
    </p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>
