<?php
  if (!$logged_in) {
    redirect('nopermissions.php');
  } else {
    echo "<h1>$name, $semester $year</h1>";
    
    if ($is_teacher) {
      // for teachers, check that the logged in user is teaching the course
      $query = "SELECT * FROM courses_teachers WHERE
                course_id = '$course_id' and teacher_id = '$user_id'";
      $result = mysqli_query($dbc, $query);
      
      // if the teacher is not teaching the course, redirect
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      }
      
      // otherwise, print proper heading
      echo "<h2><a href=\"course_edit.php?course_id=$course_id\">";
      echo "(edit course)</a>";
      echo "<a href=\"course_delete.php?course_id=$course_id\">";
      echo '(delete course)</a></h2>';
    } else {
      // for students, check that the logged in user is a student in the course
      $query = "SELECT * FROM courses_students WHERE
                course_id = '$course_id' and student_id = '$user_id'";
      $result = mysqli_query($dbc, $query);
      
      // if the student is not in the course, redirect
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      }
      
      // otherwise, print proper heading
      echo '<h2>';
      echo "<a class=\"paren-link\" href=\"grades_page.php?course_id=$course_id&";
      echo "student_id=$user_id\"> (my grades)</a>";
      echo "</h2>";
    }
  }
?>