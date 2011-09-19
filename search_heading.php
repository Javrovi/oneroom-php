<?php
  if ($logged_in) {
    echo '<h1>Search for courses</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>