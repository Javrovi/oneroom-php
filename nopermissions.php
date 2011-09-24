<?php
  /* nopermissions.php
   * -----------------
   * nopermissions.php displays a "Access Denied" message when a user
   * tries to access a page she has no permission to access.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Set page title
  $page_title = 'Access Denied';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Access Denied</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <p>
      You do not have permission to access this page.
    </p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>
