<?php
  /* course_add_user.php
   * -------------------
   * course_add_user.php is run when a user indicates that she wants to
   * add herself to a course.  She is presented with a confirmation question.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions: only logged in users can add themselves to courses.
  if (!$logged_in) {
    redirect('nopermissions.php');
  }
  
  // Get the course id and the user id
  $course_id = $_GET['course_id'];
  $user_id = $_GET['user_id'];
  
  // Get course's full name
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Set page title
  $page_title = 'Add User To Course';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Add User To Course</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      echo '<p>Are you sure you want to ';
      if ($is_teacher) {
        echo 'teach ';
      } else {
        echo 'take ';
      }
      echo $name . ', ' . $semester . ' ' . $year . '?</p>';
      
      // Save course id for the php scripts that will actually add the user
      // Note that user_id is already a session variable
      $_SESSION['course_id'] = $course_id;
    ?>

    <div id="cancel_confirm">
       <p>
        <a href="allcourses.php">Cancel</a> |
        <a href="<?php if ($is_teacher) {
                          echo 'course_add_teacher.php';
                        } else {
                          echo 'course_add_user_success.php';
                        } ?>">Confirm</a>
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


