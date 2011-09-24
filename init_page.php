<?php
  // DB connection
  require_once('connectvars.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
          redirect('500.php');
   
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
    $username = $_SESSION['username'];
    $is_teacher = is_teacher($dbc, $user_id);
  }
?>