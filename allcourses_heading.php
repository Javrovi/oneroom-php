<?php
  // Only logged in users can see the course index
  if ($logged_in) {
    echo '<h1>All Courses ';
    // Display a link to course creation script if the logged-in user is a teacher
    if ($is_teacher) {
      echo '<a class="paren-link" href="course_create.php">';
      echo '(create a new course)</a>';
    }
    echo '</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>