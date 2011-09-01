<?php
  require_once('utils.php');
  
  // If the user is logged in, delete the session vars to log them out
  session_start();
  if (isset($_SESSION['user_id'])) {
    // Delete the session vars by clearing the $_SESSION array
    $_SESSION = array();

    // Delete the session cookie by setting its expiration to an hour ago
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 3600);
    }

    // Destroy the session
    session_destroy();
  }

  // Redirect to the home page
  redirect('home.php');
?>
