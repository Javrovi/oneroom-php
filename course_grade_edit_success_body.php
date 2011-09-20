<?php
  $student_id = $_SESSION['student_id'];
  
  // Get course's full name
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Get student name
  $student_name = get_user_full_name($dbc, $student_id);
  $first_name = $student_name['first_name'];
  $last_name = $student_name['last_name'];
    
  // Print success message
  echo '<p>You have successfully inputted a course grade for ';
  echo "<a href=\"grades_page.php?course_id=$course_id&";
  echo "student_id=$student_id\">";
  echo "$first_name $last_name </a>";
  echo "in <a href=\"course_page.php?course_id=$course_id\">";
  echo "$course_name, $semester $year</a>.</p>";
?>