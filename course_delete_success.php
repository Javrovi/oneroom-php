<?php
  /* course_delete_success.php
   * -------------------------
   * course_delete_success.php is run when a teacher confirms that she
   * wishes to delete a course.  The course is then removed from the database.
   * A success message is displayed after removal.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions: only teachers teaching the course can delete that course
  $course_id = $_SESSION['course_id'];
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
  // If we get here without being redirected, we're ok -- continue with script
  
  // Remove course from database
  $query = "DELETE FROM courses WHERE course_id = '$course_id'"; 
  mysqli_query($dbc, $query) or redirect('500.php');
  
  // Set page title
  $page_title = 'Course Deletion Successful';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Course Successfuly Deleted</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <p>
      Your course has been deleted.
      Access <a href="usercourses.php">your other courses</a>
      or go back to the <a href="home.php">Home</a> page.
    </p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>

