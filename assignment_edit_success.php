<?php
  /* assignment_edit_success.php
   * ---------------------------
   * assignment_edit_success.php is run when an assignment is successfully
   * updated.  The teacher is informed that the assignment has been updated.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // course id and assignment id have been saved as session variables
  // by assignment_edit.php
  $course_id = $_SESSION['course_id'];
  $assignment_id = $_SESSION['assignment_id'];
  
  // Permissions: only teachers of the course to which the assignment belongs
  // can edit the assignment.
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

  // if we get here without being redirected, we're ok; continue with script
  
  // Get assignment's name
  $assignment_info = get_assignment_info($dbc, $assignment_id);
  $name = $assignment_info['name'];
  
  // Get course's full name
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Set page title
  $page_title = 'Assignment Update Successful';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Assignment Successfully Updated</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      // Print success message
      echo '<p>You have successfully updated ';
      echo "<a href=\"assignment_page.php?assignment_id=$assignment_id\">$name </a>";
      echo "in <a href=\"course_page.php?course_id=$course_id\">";
      echo "$course_name, $semester $year</a>.</p>";
    ?>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>
