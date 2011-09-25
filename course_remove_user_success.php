<?php
  /* course_remove_user_success.php
   * ---------------------------
   * course_remove_user_success.php is run when the user confirms that she
   * wants to add herself to a course.  
   */

  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  $course_id = $_SESSION['course_id'];
  $remove_user_id = $_SESSION['remove_user_id'];

  // Permissions:
  // - a student can remove herself from a course
  // - a teacher can remove herself from a course
  // - a teacher can remove a student from a course that the teacher is
  //   teaching
  // - a teacher CANNOT remove another teacher from a course that the
  //   teacher is teaching
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
      // (a teacher cannot remove a co-teacher
      if (!is_teacher($dbc, $remove_user_id)) {
        goto ok;
      } 
    }
    // if we haven't gone to 'ok', redirect
    redirect('nopermissions.php');
  }

  // If we get here, we're okay
  ok:
  
  // Remove the relationship between the user and the course
  // in the courses_teachers or courses_students junction table
  if (is_teacher($dbc, $remove_user_id)) {
    $query = "DELETE FROM courses_teachers WHERE
              teacher_id = '$remove_user_id' AND course_id = '$course_id'";
  } else {
    $query = "DELETE FROM courses_students WHERE
              student_id = '$remove_user_id' AND course_id = '$course_id'";
  }
  mysqli_query($dbc, $query) or redirect('500.php');
  
  // For students only: remove assignment grades and course grades
  if (!is_teacher($dbc, $remove_user_id)) {  
    // Remove any assignment grades
    $query = "SELECT assignment_id FROM assignments WHERE
              course_id = '$course_id'";
    $result = mysqli_query($dbc, $query) or redirect('500.php');;
                
    $assignment_ids = array();
    while ($row = mysqli_fetch_array($result)) {
      array_push($assignment_ids, $row['assignment_id']);
    }
    
    foreach ($assignment_ids as $assignment_id) {
      $query = "DELETE FROM grades WHERE
                student_id = '$remove_user_id' AND assignment_id = '$assignment_id'";
      mysqli_query($dbc, $query) or redirect('500.php');;
    }
    
    // Remove any course grades
    $query = "DELETE FROM course_grades WHERE
              student_id = '$remove_user_id' AND course_id = '$course_id'";
    mysqli_query($dbc, $query) or redirect('500.php');;
  }
  
  $user_full_name = get_user_full_name($dbc, $remove_user_id);
  $first_name = $user_full_name['first_name'];
  $last_name = $user_full_name['last_name'];
  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Set page title
  $page_title = 'Removal of User Successful';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Removal of User Successful</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      echo '<p>You have successfully removed ';
      echo $first_name . ' ' . $last_name;
      echo ' from ' . $name . ', ' . $semester . ' ' . $year . '.</p>';
    ?>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>

