<?php
  // Only logged in teachers can create courses
  if ($is_teacher) {
    echo '<h1>New Assignment Successfuly Added to Course</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('/nopermissions.php');
  }
?>