<?php
  // Get the course id and the user id
  $course_id = $_GET['course_id'];
  $user_id = $_GET['user_id'];
  
  // Check that the user is in the course
  if ($is_teacher) {
    $query = "SELECT * FROM courses_teachers WHERE
              teacher_id = '$user_id' AND course_id = '$course_id'";
  } else {
    $query = "SELECT course_id FROM courses_students WHERE
              student_id = '$user_id' AND course_id = '$course_id'";
  }
  $result = mysqli_query($dbc, $query)
            or die('Error querying database: ' . mysqli_error($dbc));

  if (mysqli_num_rows($result) == 1) {
    // Good -- there is a one-to-one match between the course id and the
    // user id
    
    // Get user's full name and course's full name
    $user_full_name = get_user_full_name($user_id);
    $first_name = $user_full_name['first_name'];
    $last_name = $user_full_name['last_name'];
    
    $course_full_name = get_course_full_name($dbc, $course_id);  
    $name = $course_full_name['name'];
    $semester = $course_full_name['semester'];
    $year = $course_full_name['year'];
    
    echo '<p>Are you sure you want to remove ' . $first_name . ' ' . $last_name;
    echo ' from ' . $name . ', ' . $semester . ' ' . $year . '?</p>';
    
    // Save course id for the remove_user_confirmed.php script
    // Note that user_id is already a session variable
    $_SESSION['course_id'] = $course_id;
  ?>  
  <div id="cancel_confirm">
     <p>
      <a href="#">Cancel</a> |
      <a href="course_remove_user_confirmed.php">Confirm</a>
    </p>
  </div>
  <?php
  } elseif (mysqli_num_rows($result) == 0) {
    // Oops -- looks like the user is not part of this course
    echo '<p>You are not currently part of this course, so you cannot';
    echo 'remove yourself from it.</p>';
  } else {
    // Well if there are more than 1 row we're in trouble
    die('Database data error: too many rows returned');
  }

  
?>