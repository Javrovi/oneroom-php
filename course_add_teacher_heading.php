<?php
  // Permissions: a user can only add herself as a teacher to a course
  // if she is of the 'teacher' user type.
  if ($is_teacher) {
    echo '<h1>Enter Course Passcode</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>