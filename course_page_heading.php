<?php
  // Only logged in users can remove themselves from courses
  if ($logged_in) {
    echo "<h1>$name, $semester $year</h1>";
    if ($is_teacher) {
      echo "<h2><a href=\"course_edit.php?course_id=$course_id\">";
      echo "(edit course)</a>";
      echo '<a href="#">(delete course)</a></h2>';
    } else {
      echo '<h2><a href="#">(my grades)</a>';
    }
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('/nopermissions.php');
  }
?>