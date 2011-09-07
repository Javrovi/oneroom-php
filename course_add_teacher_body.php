<?php
  // Get the course id
  $course_id = $_SESSION['course_id'];
  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  echo '<p>To add yourself as a teacher for ';
  echo $name . ', ' . $semester . ' ' . $year . ', ';
  echo 'please enter that course\'s passcode below.</p>';
?>

<!-- Passcode Input Form -->
  <form method="post" action="course_add_user_success.php">
    <label for="passcode">passcode:</label>
    <input type="text" id="passcode" name="passcode" /><br />

    <!-- Submission -->
    <input type="submit" value="enter" id="submit" name="submit" />
  </form>