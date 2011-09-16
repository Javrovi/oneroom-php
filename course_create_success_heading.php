<?php
  // Only logged in teachers can create courses
  if ($is_teacher) {
    echo '<h1>Course Successfully Created</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>