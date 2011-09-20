<?php
  // Permissions: only teachers who are teaching the course have permission
  // to delete an assignment in that course.  Note that the assignment id
  // is a GET parameter.
  
  // Get the assignment id, info, and course id
  $assignment_id = $_GET['assignment_id'];
  $assignment_info = get_assignment_info($dbc, $assignment_id);
  $name = $assignment_info['name'];
  $course_id = $assignment_info['course_id'];
 
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
  echo '<h1>Delete Assignment</h1>';
?>