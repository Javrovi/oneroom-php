<?php
  // Get the assignment id
  $assignment_id = $_GET['assignment_id'];
  
  // Get the corresponding course id
  $query = "SELECT name, due_date, course_id FROM assignments WHERE
            assignment_id = '$assignment_id'";
  $result = mysqli_query($dbc, $query)
            or die('Error querying database: ' . mysqli_error($dbc));
  if (mysqli_num_rows($result) == 1) {
    // Success if only one row is returned
    $row = mysqli_fetch_array($result);
  } else {
      // Something went wrong if the number of rows returned is not 1
    die('Error querying database:
         no assignment with this id or more than one assignment with the same id.');
  }
  $name = $row['name'];
  $course_id = $row['course_id'];
  
  // Check that the teacher is teaching the course
  $query = "SELECT * FROM courses_teachers WHERE
            teacher_id = '$user_id' AND course_id = '$course_id'";
  $result = mysqli_query($dbc, $query)
            or die('Error querying database: ' . mysqli_error($dbc));
  if (mysqli_num_rows($result) == 1) {
    // Good -- there is a one-to-one match between the course id and the
    // user id
    
    // Get course's full name  
    $course_full_name = get_course_full_name($dbc, $course_id);  
    $course_name = $course_full_name['name'];
    $semester = $course_full_name['semester'];
    $year = $course_full_name['year'];
    
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
<?php
  } elseif (mysqli_num_rows($result) == 0) {
    // Oops -- looks like the user is not teaching this course
    echo '<p>You are not currently teaching this course, so you cannot ';
    echo 'delete its assignments .</p>';
  } else {
    // Well if there are more than 1 row we're in trouble
    die('Database data error: too many rows returned');
  }
?>