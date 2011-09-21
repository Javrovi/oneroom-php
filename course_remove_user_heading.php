<?php
  // Permissions:
  // - a student can remove herself from a course
  // - a teacher can remove herself from a course
  // - a teacher can remove a student from a course that the teacher is
  //   teaching
  // - a teacher CANNOT remove another teacher from a course that the
  //   teacher is teaching
  $course_id = $_GET['course_id'];
  $remove_user_id = $_GET['remove_user_id'];

  if (!$logged_in) {
    redirect('nopermissions.php');
  } else {
    // you can always remove yourself
    if ($user_id == $remove_user_id) {
      goto ok;
    }
    
    if ($is_teacher) {
      // if logged in user is a teacher, ok if she's teaching the course
      // and the user to be removed is a student
      
      // is the user teaching the class?
      $query = "SELECT * FROM courses_teachers WHERE
                course_id = '$course_id' and teacher_id = '$user_id'";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
      // if not, redirect
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      }
      // if so, okay if user to be removed is a student
      // (a teacher cannot remove a co-teacher)
      if (!is_teacher($dbc, $remove_user_id)) {
        goto ok;
      } 
    }
    // if we haven't gone to 'ok', redirect
    redirect('nopermissions.php');
  }

  ok:
  echo '<h1>Remove User From Course</h1>';
?>