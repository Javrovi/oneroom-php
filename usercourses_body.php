<?php
  // Get user's courses from database
  if ($is_teacher) {
    $query = "SELECT course_id FROM courses_teachers WHERE
              teacher_id = '$user_id'";
  } else {
    $query = "SELECT course_id FROM courses_students WHERE
              student_id = '$user_id'";
  }
  $result = mysqli_query($dbc, $query)
            or die('Error querying database: ' . mysqli_error($dbc));

  // Iterate over the courses, printing each one out 
  if (mysqli_num_rows($result) == 0) {
    // If user is not in any courses yet, print out a message.
    echo '<p>You are not yet part of any courses.</p>';
  } else {
    // Otherwise, print out a list of the user's courses
    
    // Grab the course ids and put them into an array
    $course_id_array = array();
    while ($row = mysqli_fetch_array($result)) {
      array_push($course_id_array, $row['course_id']);
    }
    
    // For each course in the array, grab detailed course info and display
    // The courses are displayed in an unordered list.
    echo '<ul>';
    foreach ($course_id_array as $course_id) {
      $query = "SELECT name, semester, year FROM courses WHERE
                course_id = '$course_id'";
      $result = mysqli_query($dbc, $query)
                or die('Error querying database: ' . mysqli_error($dbc));
      if (mysqli_num_rows($result) == 1) {
        // Success if only one row is returned
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
        $semester = $row['semester'];
        $year = $row['year'];
        
        // Display course info with link to course details page
        echo '<li>';
        echo '<a href="#">';
        echo $name . ', ' . $semester . ' ' . $year . '</a>';
        
        // If user is a student, display link to her grades in the course
        if (!$is_teacher) {
          echo '<a class="paren-link" href="#">';
          echo ' (grades)';
        }
        
        // Display link to remove self from course
        echo '<a class="paren-link" href="#">';
        echo ' (remove self from course)</a>';
        echo '</li>';
      } else {
        // Something went wrong if the number of rows returned is not 1
        die('Error querying database:
             no course with this id or more than one course with the same id.');
      }         
    }
    echo '</ul>';
  }
  // Close database connection
  mysqli_close($dbc);
?>