<?php
  if ($logged_in) {
    echo "<h1>$name, $semester $year</h1>";
    if ($is_teacher) {
      echo "<h2><a href=\"course_edit.php?course_id=$course_id\">";
      echo "(edit course)</a>";
      echo "<a href=\"course_delete.php?course_id=$course_id\">";
      echo '(delete course)</a></h2>';
    } else {
      echo '<h2>';
      echo "<a class=\"paren-link\" href=\"grades_page.php?course_id=$course_id&";
      echo "student_id=$user_id\"> (my grades)</a>";
      echo "</h2>";
    }
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('/nopermissions.php');
  }
?>