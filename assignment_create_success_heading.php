<?php
  // Permissions: only teachers who are teaching the course have permission
  // to create an assignment in that course.  Note that the course id has been
  // set as a session variable by assignment_create.php, which redirects to
  // to assignment_create_success.php.
  
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
  echo '<h1>New Assignment Successfuly Added to Course</h1>';
?>