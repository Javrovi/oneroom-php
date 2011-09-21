<?php
  // Permissions: only logged in users can change their passwords.
  if ($logged_in) {
    echo '<h1>User Account: Password Change</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>