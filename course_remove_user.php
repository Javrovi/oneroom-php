<?php
  /* course_remove_user.php
   * -------------------
   * course_remove_user.php is run when a user indicates that she wants to
   * remove herself from a course.  She is presented with a confirmation
   * question.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

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

  // If we get here, we have good permissions: continue with script
  ok:
  
  // Get user's full name and course's full name
  $user_full_name = get_user_full_name($dbc, $remove_user_id);
  $first_name = $user_full_name['first_name'];
  $last_name = $user_full_name['last_name'];
  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Save course id and student id for the next script
  $_SESSION['course_id'] = $course_id;
  $_SESSION['remove_user_id'] = $remove_user_id;
  
  // Set page title
  $page_title = 'Remove User From Course';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Remove User From Course</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      echo '<p>Are you sure you want to remove ' . $first_name . ' ' . $last_name;
      echo ' from ' . $name . ', ' . $semester . ' ' . $year . '?</p>';
    ?>
    <div id="cancel_confirm">
      <p>
        <a href="course_page.php?course_id=<?php echo $course_id; ?>">Cancel</a> |
        <a href="course_remove_user_success.php">Confirm</a>
      </p>
    </div>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


