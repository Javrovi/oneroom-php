<?php
  // Get course's full name  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  echo '<p>Are you sure you want to delete this course ';
  echo '(' . $name . ', ' . $semester . ' ' . $year . ')?</p>';
  
  // Save course id for the course_delete_success.php script
  $_SESSION['course_id'] = $course_id;
  ?>  
  <div id="cancel_confirm">
     <p>
      <a href="course_page.php?course_id=<?php echo $course_id; ?>">Cancel</a> |
      <a href="course_delete_success.php">Confirm</a>
    </p>
  </div>
