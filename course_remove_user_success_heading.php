<?php
  $course_id = $_SESSION['course_id'];
  $remove_user_id = $_SESSION['remove_user_id'];

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
      $result = mysqli_query($dbc, $query);
      // if not, redirect
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      }
      // if so, okay if user to be removed is a student
      // (a teacher cannot remove a co-teacher
      if (!is_teacher($dbc, $remove_user_id)) {
        goto ok;
      } 
    }
    // if we haven't gone to 'ok', redirect
    redirect('nopermissions.php');
  }

  ok:
    echo '<h1>Removal of User Successful</h1>';
?>