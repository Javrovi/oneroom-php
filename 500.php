<?php
  /* 500.php
   * -------
   * 500.php is run when an internal server error is encountered, such as when
   * a bad result from the database is received.  The user is alerted of a
   * server error, and is provided with a link back to OneRoom's home page.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Set page title
  $page_title = 'Server Error';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Server Error</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <p>
      The server has encountered an error while trying to fulfill your request.
      Please click <a href="home.php">here</a> to go back to OneRoom's home.
  </p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>
