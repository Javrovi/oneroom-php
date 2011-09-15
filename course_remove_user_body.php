<?php
  // Get user's full name and course's full name
  $user_full_name = get_user_full_name($dbc, $remove_user_id);
  $first_name = $user_full_name['first_name'];
  $last_name = $user_full_name['last_name'];
  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  echo '<p>Are you sure you want to remove ' . $first_name . ' ' . $last_name;
  echo ' from ' . $name . ', ' . $semester . ' ' . $year . '?</p>';
  
  // Save course id and student id for the next script
  $_SESSION['course_id'] = $course_id;
  $_SESSION['remove_user_id'] = $remove_user_id;
  ?>  
  <div id="cancel_confirm">
     <p>
      <a href="course_page.php?course_id=<?php echo $course_id; ?>">Cancel</a> |
      <a href="course_remove_user_success.php">Confirm</a>
    </p>
  </div>
