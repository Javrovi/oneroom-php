<?php
  // Only teachers can delete courses
  if ($is_teacher) {
    echo '<h1>Assignment Successfuly Deleted</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('/nopermissions.php');
  }
?>