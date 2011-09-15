<?php
  if (!$logged_in) {
    redirect('nopermissions.php');
  } else {
    if ($is_teacher) {
      // check that the teacher is teaching the class
      $query = "SELECT * FROM courses_teachers WHERE
                course_id = '$course_id' and teacher_id = '$user_id'";
      $result = mysqli_query($dbc, $query);
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      } 
    } else {
      // check if logged in user is the student whose grades
      // are requested in the GET request
      if ($user_id != $student_id) {
        redirect('nopermissions.php');
      }
    }
  }
  
  // If we get to this point without being redirected, we have
  // good permissions
  echo "<h1> Grades for $first_name $last_name <br />";
  echo "<a class=\"paren-link\" href=\"course_page.php?course_id=$course_id\">";
  echo "($course_name, $course_semester $course_year)</a></h1>";
?>