<?php
  // Get the course id
  $course_id = $_SESSION['course_id'];
  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  echo '<p>You did not enter the right course code for ';
  echo $name . ', ' . $semester . ' ' . $year . '. ';
?>

<a href="course_add_teacher.php">Try again</a>, or go back to
<a href="usercourses.php">your courses</a>.</p>