<?php
 // Get assignment's name
  $assignment_info = get_assignment_info($dbc, $assignment_id);
  $name = $assignment_info['name'];
  
  // Get course's full name
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Print success message
  echo '<p>You have successfully updated ';
  echo "<a href=\"assignment_page.php?assignment_id=$assignment_id\">$name </a>";
  echo "in <a href=\"course_page.php?course_id=$course_id\">";
  echo "$course_name, $semester $year</a>.</p>";
?>