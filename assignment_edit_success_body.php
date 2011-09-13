<?php
  $course_id = $_SESSION['course_id'];
  $assignment_id = $_SESSION['assignment_id'];
  
  // Get assignment's name
  $query = "SELECT name FROM assignments WHERE
              assignment_id = '$assignment_id'";
  $result = mysqli_query($dbc, $query);
  if (mysqli_num_rows($result) == 1) {
    // Success if only one row is returned
    $row = mysqli_fetch_array($result);
  } else {
    // Something went wrong if the number of rows returned is not 1
    die('Error querying database:
         no assignment with this id or more than one assignment with the same id.');
  }
  $name = $row['name'];
  
  // Get course's full name
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Print success message
  echo '<p>You have successfully updated ';
  echo "<a href=\"assignment_page.php?assignment_id=$assignment_id\">$name </a>";
  echo "in <a href=\"course_page.php?course_id=$course_id\">";
  echo "$course_name, $semester $year</a>.</p>";
?>