<?php
  /* course_delete.php
   * -----------------
   * course_delete.php is run when a teacher indicates that she wishes to
   * delete one of her courses.  She is prompted to confirm her request.
   * If confirmed, course_delete_success.php is run.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');
  
  // Permissions: only teachers teaching the course can delete that course
  $course_id = $_GET['course_id'];
  if (!$logged_in) {
    redirect('nopermissions.php');
  } else {
    if ($is_teacher) {
      // if logged in user is a teacher, ok if she's teaching the course
  
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
  // If we get here without being redirected, we're ok; continue with script
  
  // Get course's full name  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Save course id for the course_delete_success.php script
  $_SESSION['course_id'] = $course_id;
  
  // Set page title
  $page_title = 'Delete Course';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Delete Course</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      // Print confirmation question
      echo '<p>Are you sure you want to delete this course ';
      echo '(' . $name . ', ' . $semester . ' ' . $year . ')?</p>';
    ?>
    <div id="cancel_confirm">
      <p>
        <a href="course_page.php?course_id=<?php echo $course_id; ?>">Cancel</a> |
        <a href="course_delete_success.php">Confirm</a>
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


