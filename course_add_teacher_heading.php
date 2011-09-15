<?php
  if ($logged_in and $is_teacher) {
    echo '<h1>Enter Course Passcode</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>