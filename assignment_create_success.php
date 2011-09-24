<?php
  /* assignment_create_success.php
   * -----------------------------
   * assignment_create_success.php is run after an assignment has been
   * successfully created.  A link back to the course in which the assignment
   * has been created is provided to the user.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Get course info
  $course_id = $_SESSION['course_id'];
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Permissions: only teachers who are teaching the course have permission
  // to create an assignment in that course.  Note that the course id has been
  // set as a session variable by assignment_create.php, which redirects to
  // to assignment_create_success.php.

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

  // if we get here without being redirected, we're ok; continue with script
  
  // Set page title
  $page_title = 'Assignment Addition Successful';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>New Assignment Successfuly Added to Course</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      // Print success message
      echo '<p>You have successfully added a new assignment to ';
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


