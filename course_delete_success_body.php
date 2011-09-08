<?php
  // Get the course id
  $course_id = $_SESSION['course_id'];

  // Check that the teacher is teaching the course
  $query = "SELECT * FROM courses_teachers WHERE
            teacher_id = '$user_id' AND course_id = '$course_id'";
  $result = mysqli_query($dbc, $query)
            or die('Error querying database: ' . mysqli_error($dbc));

  if (mysqli_num_rows($result) == 1) {
    // Good -- there is a one-to-one match between the course id and the
    // user id

    // Remove the course from the courses table
    $query = "DELETE FROM courses WHERE course_id = '$course_id'"; 
    mysqli_query($dbc, $query)
      or die('Error querying database: ' . mysqli_error($dbc));
  ?>  
  <p>
    Your course has been deleted.
    Access <a href="usercourses.php">your other courses</a>
    or go back to the <a href="home.php">Home</a> page.
  </p>

<?php    
  } elseif (mysqli_num_rows($result) == 0) {
    // Oops -- looks like the user is not teaching this course
    echo '<p>You are not currently teaching this course, so you cannot ';
    echo 'delete it.</p>';
  } else {
    // Well if there are more than 1 row we're in trouble
    die('Database data error: too many rows returned');
  }
?>

