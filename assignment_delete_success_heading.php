<?php
  // Permissions: only teachers who are teaching the course have permission
  // to delete an assignment in that course.  Note that the assignment id
  // and the course id have been saved as session variables by
  // assignment_delete.php.
  
  // Get the assignment and course ids
  $assignment_id = $_SESSION['assignment_id'];
  $course_id = $_SESSION['course_id'];

  if (!$logged_in) {
    // no permission if not logged in
    redirect('nopermissions.php');
  } else {
    if ($is_teacher) {
      // is the teacher teaching the class?
      $query = "SELECT * FROM courses_teachers WHERE
                course_id = '$course_id' and teacher_id = '$user_id'";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
      
      // if not, redirect
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      }
    } else {
      // students cannot edit courses
      redirect('nopermissions.php');
    }
  }

  // if we get here without being redirected, we're ok
  echo '<h1>Assignment Successfuly Deleted</h1>';
?>