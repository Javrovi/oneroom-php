<?php
  // Get user's courses from database
  $user_course_ids = get_user_courses($dbc, $user_id, $is_teacher);
   
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
      if (in_array($row['course_id'], $user_course_ids)) {
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
?>