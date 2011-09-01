<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
  // DB connection globals
  require_once('connectvars.php');
  
  // Utility functions
  require_once('utils.php');

  // Session management
  session_start();
  
  /*
    Set up the variables that are frequently used across scripts
     ------------------------------------------------------------
    $logged_in: true if a user is logged in; false otherwise
    $user_id: id of the logged-in user
    $username: username of the logged-in user
    $is_teacher: true if the logged-in user is a teacher; false otherwise
  */
  $logged_in = isset($_SESSION['user_id']);
  if ($logged_in) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['user_name'];
    $is_teacher = is_teacher($user_id);
  }
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>OneRoom Grade Tracker | <?php echo $page_title; ?></title>
    <link rel="stylesheet" href="stylesheets/style.css" type="text/css" />
  </head>

  <body>
    <div id="main">
      <!-- Account navigation menu at the top right -->
      <div id="acct_nav">
        <?php if ($logged_in) { ?>
          <a href="acct_manage.php">my account</a> |
          <a href="logout.php">logout</a>
        <?php } else { ?>
          <a href="login.php">login</a> |
          <a href="register.php">register</a>
        <?php } ?>
      </div>
        
      <!-- Main navigation menu -->
      <div id="nav">
        <div id="app_name">
          <p>
            <a href="home.php">OneRoom</a>
          </p>
        </div>
        
        <div id="course_nav">
          <a href="home.php">home</a> |
          <?php if ($logged_in) { ?>
            <a href="allcourses.php">all courses</a> |
            <a href="usercourses.php">my courses</a> |
            <a href="search.php">search courses</a>
          <?php } ?>
        </div>
      </div>
      
      <!-- Main content -->
      <div id="content">
        <!-- Content heading -->
        <div id="content-heading">
          <?php require_once($content_heading); ?>
        </div>
        
        <!-- Content body -->
        <div id="content-body">
          <?php require_once($content_body); ?>
        </div>
      </div>
      
      <!-- to hide debug details, uncomment the 'display:none' line in
         style.css for #debug -->
      <div id="debug">
        <p>
          debug is on. :)
        </p>
      </div>
    </div>
    
    <div id="footer">
      <p>
        <a href="about.html">About</a> |
        <a href="help.html">Help</a> |
        &copy; 2011 Yiping Liao
      </p>
    </div>

  </body>
</html>
