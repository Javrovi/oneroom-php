<?php
  /* assignment_delete.php
   * ---------------------
   * assignment_delete.php is run when a teacher clicks on a link on the course
   * page to delete an assignment. The teacher is asked to confirm that she
   * really wants to delete the assignment.  If confirmed, she is redirected to
   * assignment_delete_success.php.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Get the assignment id, info, and course id
  $assignment_id = $_GET['assignment_id'];
  $assignment_info = get_assignment_info($dbc, $assignment_id);
  $name = $assignment_info['name'];
  $course_id = $assignment_info['course_id'];
 
  // Permissions: only teachers who are teaching the course have permission
  // to delete an assignment in that course.  Note that the assignment id
  // is a GET parameter. 

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

  // If we get here without being redirected, we're ok; continue with script
  
  // Get course's full name  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Save assignment and course ids for the assignment_delete_success.php script
  $_SESSION['assignment_id'] = $assignment_id;
  $_SESSION['course_id'] = $course_id;
  
  // Set page title
  $page_title = 'Delete Assignment';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Delete Assignment</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      // Display confirmation question
      echo '<p>Are you sure you want to delete ' . $name;
      echo ' in ' . $course_name . ', ' . $semester . ' ' . $year . '?</p>';
    ?>
    <div id="cancel_confirm">
      <p>
        <a href="course_page.php?course_id=<?php echo $course_id; ?>">Cancel</a> |
        <a href="assignment_delete_success.php">Confirm</a>
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


