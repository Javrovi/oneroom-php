<?php
  // Permissions: only users who are part of the course can see the assignment
  // page.
  if (!$logged_in) {
    redirect('nopermissions.php');
  } else {   
    if ($is_teacher) {
      // for teachers, check that the logged in user is teaching the course
      $query = "SELECT * FROM courses_teachers WHERE
                course_id = '$course_id' and teacher_id = '$user_id'";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
      
      // if the teacher is not teaching the course, redirect
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      }
    } else {
      // for students, check that the logged in user is a student in the course
      $query = "SELECT * FROM courses_students WHERE
                course_id = '$course_id' and student_id = '$user_id'";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
      
      // if the student is not in the course, redirect
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      }
    }
  }
  
  // if we get here without being redirected, we're okay
  echo "<h1>";
  echo $name . "<br />";
  echo "<a class=\"paren-link\" href=\"course_page.php?course_id=$course_id\">";
  echo "$course_name, $course_semester $course_year</a><br />";
  // get rid of leading 0's in single-digit days in the due date
  $day = drop_leading_zero($day);
  echo "<span class=\"paren\">$month $day, $year</span>";
  echo "</h1>";
?>