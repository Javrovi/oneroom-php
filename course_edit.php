<?php
  /* course_edit.php
   * ---------------
   * course_edit.php is run when a teacher indicates that she wants to edit a
   * course.  A course edit form is presented, the form fields filled in
   * with the current course information.  Successful form submission updates
   * the course in the database, and the teacher is redirected to
   * course_edit_success.php.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // When first run, course_edit.php is called with course id as
  // a GET parameter.  Form submission is via POST, so once the form is
  // submitted, course_edit.php has POST variables.
  if (isset($_POST['submit'])) {
    $course_id = $_SESSION['course_id'];
  } else {
    $course_id = $_GET['course_id'];
  }
  
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
  
  // Process POST data if form was submitted
  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $year = mysqli_real_escape_string($dbc, trim($_POST['year']));
    $semester = mysqli_real_escape_string($dbc, trim($_POST['semester']));
    $passcode1 = mysqli_real_escape_string($dbc, trim($_POST['passcode1']));
    $passcode2 = mysqli_real_escape_string($dbc, trim($_POST['passcode2']));
    
    // Validate form data
    $form_errors = array();
    $field_required_string = '<ul><li>This field is required.</li></ul>';
    
    if (empty($name)) {
      $form_errors['name'] = $field_required_string;
    }
    if (empty($year)) {
      $form_errors['year'] = $field_required_string;
    }
    if (empty($semester)) {
      $form_errors['semester'] = $field_required_string;
    }
    if (empty($passcode1)) {
          $form_errors['passcode1'] = $field_required_string;
    }
    if (empty($passcode2)) {
      $form_errors['passcode2'] = $field_required_string;
    } else {
      if ($passcode1 != $passcode2) {
        $form_errors['passcode2'] = '<ul><li>Course passcodes do not match.</li></ul>';
      }
    }
    
    // If there are no form errors, proceed to add new course to database
    if (empty($form_errors)) {
      // Update table with new data
      $query = "UPDATE courses SET
                name = '$name', year = '$year', semester = '$semester',
                passcode = SHA('$passcode1')
                WHERE
                course_id = '$course_id'";
                   
      $result = mysqli_query($dbc, $query) or redirect('500.php');

      // Report success to the user
      $_SESSION['course_id'] = $course_id;
      redirect('course_edit_success.php');
    }
  } else {
    // Get course's full name to populate form
    $course_full_name = get_course_full_name($dbc, $course_id);  
    $name = $course_full_name['name'];
    $semester = $course_full_name['semester'];
    $year = $course_full_name['year'];
      
    $_SESSION['course_id'] = $course_id;
  }
    
  // Set page title
  $page_title = 'Edit Course';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Edit Course</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <!-- Course Edit Form -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <!-- Course Name -->
      <?php echo $form_errors['name']; ?>
      <label for="name">course name:</label>
      <input type="text" id="name" name="name"
             value="<?php echo $name; ?>" /><br />
             
      <!-- Course Year -->
      <?php echo $form_errors['year']; ?>
      <label for="year">year:</label>
      <input type="text" id="year" name="year"
             value="<?php echo $year; ?>" /><br />
             
      <!-- Course Semester -->
      <?php echo $form_errors['semester']; ?>
      <label for="semester">semester:</label>
      <input type="text" id="semester" name="semester"
             value="<?php echo $semester; ?>" /><br />
      
      <!-- Passcode -->
      <?php echo $form_errors['passcode1']; ?>
      <label for="passcode1">passcode:</label>
      <input type="password" id="passcode1" name="passcode1" /><br />
      <?php echo $form_errors['passcode2']; ?>
      <label for="password2">password (retype):</label>
      <input type="password" id="passcode2" name="passcode2" /><br />
      
      <!-- Submission -->
      <input type="submit" value="update course" id="submit" name="submit" />
    </form>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


