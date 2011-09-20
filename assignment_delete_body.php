<?php
  // Get course's full name  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Display confirmation question
  echo '<p>Are you sure you want to delete ' . $name;
  echo ' in ' . $course_name . ', ' . $semester . ' ' . $year . '?</p>';
  
  // Save assignment and course ids for the assignment_delete_success.php script
  $_SESSION['assignment_id'] = $assignment_id;
  $_SESSION['course_id'] = $course_id;
?>
  
  <div id="cancel_confirm">
     <p>
      <a href="course_page.php?course_id=<?php echo $course_id; ?>">Cancel</a> |
      <a href="assignment_delete_success.php">Confirm</a>
    </p>
  </div>