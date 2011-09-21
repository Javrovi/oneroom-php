<?php
  // When first run, assignment_edit.php is called with assignment id as
  // a GET parameter.  Form submission is via POST, so once the form is
  // submitted, assignment_edit.php has POST variables.
  if (isset($_POST['submit'])) {
    // grab assignment and course ids
    $assignment_id = $_SESSION['assignment_id'];
    $course_id = $_SESSION['course_id'];
  } else {
    $assignment_id = $_GET['assignment_id'];
    $assignment_info = get_assignment_info($dbc, $assignment_id);
    $course_id = $assignment_info['course_id'];
  }
  
  // Permissions: only teachers of the course that contains the assignment
  // can edit the assignment.
  if (!$logged_in) {
    redirect('nopermissions.php');
  } else {
    if ($is_teacher) {
      // is the user teaching the class?
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
  echo '<h1>Edit Assignment</h1>';
?>