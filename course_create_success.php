<?php
  /* course_create_success.php
   * -------------------------
   * course_create_success.php is run when a course has been successfully
   * created by a teacher.  A success message is displayed to the teacher.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions: only teachers can create courses
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
  $page_title = 'Course Create Successful';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Course Successfully Created</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      // Print success message
      echo '<p>You have successfully created ';
      echo "<a href=\"course_page.php?course_id=$course_id\">";
      echo "$name, $semester $year</a>.</p>";
    ?>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


