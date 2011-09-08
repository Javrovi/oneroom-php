<?php
  $course_id = $_SESSION['course_id'];
  
  // Get course's full name
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Print success message
  echo '<p>You have successfully created ';
  echo "<a href=\"course_page.php?course_id=$course_id\">";
  echo "$name, $semester $year</a>.</p>";
?>