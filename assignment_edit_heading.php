<?php
  if (isset($_POST['submit'])) {
    // grab assignment and course ids
    $assignment_id = $_SESSION['assignment_id'];
    $course_id = $_SESSION['course_id'];
  } else {
    $assignment_id = $_GET['assignment_id'];
    $assignment_info = get_assignment_info($dbc, $assignment_id);
    $course_id = $assignment_info['course_id'];
  }
  
  if (!$logged_in) {
    redirect('nopermissions.php');
  } else {
    if ($is_teacher) {
      // if logged in user is a teacher, ok if she's teaching the course
  
      // is the user teaching the class?
      $query = "SELECT * FROM courses_teachers WHERE
                course_id = '$course_id' and teacher_id = '$user_id'";
      $result = mysqli_query($dbc, $query);
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
  echo '<h1>Edit Assignment</h1>';
?>