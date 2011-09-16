<?php
  // Get user's courses from database
  $user_course_ids = get_user_courses($dbc, $user_id, $is_teacher);
  
  // Iterate over the courses, printing each one out 
  if (count($user_course_ids) == 0) {
    // If user is not in any courses yet, print out a message.
    echo '<p>You are not yet part of any courses.</p>';
  } else {
    // Otherwise, print out a list of the user's courses
    
    // For each course in the array, grab detailed course info and display
    // The courses are displayed in an unordered list.
    echo '<ul>';
    foreach ($user_course_ids as $course_id) {
      $course_full_name = get_course_full_name($dbc, $course_id);  
      $name = $course_full_name['name'];
      $semester = $course_full_name['semester'];
      $year = $course_full_name['year'];
      
      // Display course info with link to course details page
      echo '<li>';
      echo "<a href=\"course_page.php?course_id=$course_id\">";
      echo $name . ', ' . $semester . ' ' . $year . '</a>';
        
      // If user is a student, display link to her grades in the course
      if (!$is_teacher) {
        echo "<a class=\"paren-link\" href=\"grades_page.php?course_id=$course_id&";
        echo "student_id=$user_id\"> (grades)</a>";
      }
        
      // Display link to remove self from course, passing course id and
      // user id as GET parameters
      echo '<a class="paren-link" href="course_remove_user.php?course_id=' .
             $course_id . '&remove_user_id=' . $user_id . '">';
      echo ' (remove self from course)</a>';
      echo '</li>';  
    }
    echo '</ul>';
  }
?>