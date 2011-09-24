<?php
  // Initialize page
  require_once('init_page.php');

  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');
  
  // Get the assignment and course ids
  $assignment_id = $_SESSION['assignment_id'];
  $course_id = $_SESSION['course_id'];

  // Permissions: only teachers who are teaching the course have permission
  // to delete an assignment in that course.  Note that the assignment id
  // and the course id have been saved as session variables by
  // assignment_delete.php.
  
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

  // Get assignment's name
  $assignment_info = get_assignment_info($dbc, $assignment_id);
  $name = $assignment_info['name'];
  
  // Get course's full name  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Delete the assignment
  $query = "DELETE FROM assignments WHERE assignment_id = '$assignment_id'"; 
  mysqli_query($dbc, $query) or redirect('500.php');
  
  // Set page title
  $page_title = 'Assignment Deletion Successful';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Assignment Successfuly Deleted</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      // Display success message to user
      echo '<p>You have successfully deleted ' . $name . ' from ';
      echo "<a href=\"course_page.php?course_id=$course_id\">";
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


