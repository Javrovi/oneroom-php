<?php
  /* course_add_teacher.php
   * ----------------------
   * course_add_teacher.php is run when a teacher confirms that she wants
   * to teach an existing course.  She is prompted for that course's course
   * passcode.  Next, the passcode is processed by course_add_user_success.php.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions: a user can only add herself as a teacher to a course
  // if she is of the 'teacher' user type.
  if (!$is_teacher) {
    redirect('nopermissions.php');
  }
  
  // Set page title
  $page_title = 'Enter Course Passcode';
  
  // Get course information
  $course_id = $_SESSION['course_id']; 
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Process form submission
  if (isset($_POST['submit'])) {
    $passcode = mysqli_real_escape_string($dbc, trim($_POST['passcode']));
    
    // Validate form data
    $form_errors = array();
    $field_required_string = '<ul><li>This field is required.</li></ul>';
      
    if (empty($passcode)) {
        $form_errors['passcode'] = $field_required_string;
    }  
    
    if (empty($form_errors)) {
      $_SESSION['passcode'] = $passcode;
      $_SESSION['course_id'] = $course_id;
      redirect('course_add_user_success.php');
    }
  }
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Enter Course Passcode</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      echo '<p>To add yourself as a teacher for ';
      echo $name . ', ' . $semester . ' ' . $year . ', ';
      echo 'please enter that course\'s passcode below.</p>';
    ?>
  
    <!-- Passcode Input Form -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <?php echo $form_errors['passcode']; ?>
      <label for="passcode">passcode:</label>
      <input type="text" id="passcode" name="passcode" /><br />
  
      <!-- Submission -->
      <input type="submit" value="enter" id="submit" name="submit" />
    </form>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


