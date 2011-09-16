<?php
  if ($logged_in) {
    echo "<h1>";
    echo $name . "<br />";
    echo "<a class=\"paren-link\" href=\"course_page.php?course_id=$course_id\">";
    echo "$course_name, $course_semester $course_year</a><br />";
    echo "<span class=\"paren\">$month $day $year</span>";
    echo "</h1>";
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>