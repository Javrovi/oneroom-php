<?php
  // Permissions: only logged in users can add themselves to courses.
  if ($logged_in) {
    echo '<h1>Add User To Course</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>