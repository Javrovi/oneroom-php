<?php
  // Get assignment's name
  $assignment_info = get_assignment_info($dbc, $assignment_id);
  $name = $assignment_info['name'];
  
  // Get course's full name  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Delete the assignment
  $query = "DELETE FROM assignments WHERE assignment_id = '$assignment_id'"; 
  mysqli_query($dbc, $query) or redirect('500.php');
  
  // Display success message to user
  echo '<p>You have successfully deleted ' . $name . ' from ';
  echo "<a href=\"course_page.php?course_id=$course_id\">";
  echo "$course_name, $semester $year</a>.</p>";
?>

