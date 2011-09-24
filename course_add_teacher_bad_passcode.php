<?php
  /* course_add_teacher_bad_passcode.php
   * -----------------------------------
   * course_add_teacher_bad_passcode.php is run when a teacher attempts to
   * add herself to a course but inputs an incorrect passcode for that course.
   * The user is provided with a link to try again.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions: a user can only add herself as a teacher to a course
  // if she is of the 'teacher' user type.
  if (!$is_teacher) {
    redirect('nopermissions.php');
  }
  
  // Get course information
  $course_id = $_SESSION['course_id'];
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Set page title
  $page_title = 'Invalid Course Passcode';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Invalid Course Passcode</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      echo '<p>You did not enter the right course code for ';
      echo $name . ', ' . $semester . ' ' . $year . '. ';
    ?>
    <a href="course_add_teacher.php">Try again</a>, or go back to
    <a href="usercourses.php">your courses</a>.</p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


