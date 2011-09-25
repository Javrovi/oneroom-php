<?php
  /* home.php
   * ---------
   * home.php is OneRoom's home page.  Different welcome messages are
   * displayed for anonymous users and logged-in users.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Set page title
  $page_title = 'Home';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>
      Welcome to OneRoom, where teachers and students track grades with one
      easy app.
    </h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php if ($logged_in) { ?>
      <p>
        Click <a href="usercourses.php">here</a> to access your courses.
      </p>
      <p>
        To see all courses, click on the <a href="allcourses.php">course index</a>.
      </p>
    <?php } else { ?>
      <p>
        Welcome anonymous user!
        You need to <a href="login.php">login</a> before you can access your
        courses. (New users: please click <a href="register.php">here</a>
        to register)
      </p>
    <?php } ?>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>

