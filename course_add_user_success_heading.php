<?php
  // Only logged in users can remove themselves from courses
  if ($logged_in) {
    echo '<h1>User Successfully Added To Course</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>