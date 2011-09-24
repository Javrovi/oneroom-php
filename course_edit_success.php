<?php
  /* course_edit_success.php
   * -----------------------
   * course_edit_success.php is run when a course has been successfully
   * edited by one of its teacher.  A success message is displayed.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Get course info
  $course_id = $_SESSION['course_id'];
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];

  // Permissions: only teachers of a course can edit that course's information.
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
  
  // Set page title
  $page_title = 'Course Update Success';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Course Successfully Updated</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      // Print success message
      echo '<p>You have successfully updated ';
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


