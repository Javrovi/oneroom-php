<?php
  // Permissions: only logged in users can change their emails.
  if ($logged_in) {
    echo '<h1>User Account: Email Change</h1>';
  } else {
    redirect('nopermissions.php');
  }
?>