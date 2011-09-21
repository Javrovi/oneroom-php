<?php
  // Permissions: only teachers can add themselves as teachers to courses.
  if ($is_teacher) {
    echo '<h1>Invalid Course Passcode</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>