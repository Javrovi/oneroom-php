<?php
  // Only teachers can remove courses
  if ($is_teacher) {
    echo '<h1>Delete Course</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('/nopermissions.php');
  }
?>