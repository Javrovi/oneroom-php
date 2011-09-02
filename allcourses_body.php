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
    
  // Grab the course ids and put them into an array
  $user_courses_id_array = array();
  while ($row = mysqli_fetch_array($result)) {
    array_push($user_courses_id_array, $row['course_id']);
  }
   
  // Get all courses from the database
  $query = "SELECT course_id, name, semester, year FROM courses";
  $result = mysqli_query($dbc, $query)
            or die('Error querying database: ' . mysqli_error($dbc));
            
  if (mysqli_num_rows($result) == 0) {
    // If there are no courses yet, say so.
    echo '<p>There are no courses yet.</p>';
  } else {
    // For each course grab detailed course info and display
    // The courses are displayed in an unordered list.
    echo '<ul>';
    while ($row = mysqli_fetch_array($result)) {
      $name = $row['name'];
      $semester = $row['semester'];
      $year = $row['year'];
     
      // Display course info 
      echo '<li>';
      echo $name . ', ' . $semester . ' ' . $year;
        
      // If user is part of the course, display link to course details page
      if (in_array($row['course_id'], $user_courses_id_array)) {
        echo '<a class="paren-link" href="#">';
        echo ' (course web page)</a>';
        echo '</li>';
      } else {
        // display link to add user to course
        echo '<a class="paren-link" href="#">';
        if ($is_teacher) {
          echo ' (teach this course)';
        } else {
          echo ' (take this course)';
        }
        echo '</a></li>';
      }         
    }
    echo '</ul>';
  }
  // Close database connection
  mysqli_close($dbc);
?>