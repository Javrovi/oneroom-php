<?php
  /* assignment_create.php
   * ---------------------
   * assignment_create.php is run when a teacher of a course clicks a link
   * to create a new assignment.  A form is provided, in which the teacher
   * inputs the name of the assignment and its due date.  A new assignment
   * is created with the input and added to the assignments table if the
   * form has no validation errors.  After assignment creation, the teacher
   * is directed to assignment_create_success.php
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions: only teachers who are teaching the course have permission
  // to create an assignment in that course.  Note that the course id has been
  // set as a session variable by course_page.php, which contains the link
  // to assignment_create.php.
  
  $course_id = $_SESSION['course_id'];
 
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
  
  // Process form submission
  if (isset($_POST['submit'])) {
    // Grab the assignment data from the POST
    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $due_date = mysqli_real_escape_string($dbc, trim($_POST['due_date']));
  
    // Validate form data
    $form_errors = array();
    $field_required_string = '<ul><li>This field is required.</li></ul>';
    
    if (empty($name)) {
      $form_errors['name'] = $field_required_string;
    }
    if (empty($due_date)) {
      $form_errors['due_date'] = $field_required_string;
    } else {
      // Due date must be in the format: MM/DD/YYYY
      $matches = array();
      if (!preg_match('/(^\d{1,2})\/(\d{1,2})\/(\d{4})$/', $due_date, $matches)) {
        $form_errors['due_date'] = '<ul><li>Enter a valid date.</li></ul>'; 
      }
    }

    // If no form errors, proceed to add assignment to database
    if (empty($form_errors)) {
      // Convert due date to MySQL's YYYY-MM-DD format
      $due_date = $matches[3] . '-' .
                  $matches[1] . '-' .
                  $matches[2];
                  
      // Insert new row into 'assignments' table
      $query = "INSERT INTO assignments
                (name, due_date, course_id)
                VALUES
                ('$name', '$due_date', '$course_id')";
    
      $result = mysqli_query($dbc, $query) or redirect('500.php');
  
      // Redirect to success page
      $_SESSION['course_id'] = $course_id;
      redirect('assignment_create_success.php');
    }
  }
  
  // Set page title
  $page_title = 'Create Assignment';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Create a New Assignment</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <!-- Assignment Creation Form -->
    <p>Teacher, create a new assignment below:</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <!-- Assignment Name -->
      <?php echo $form_errors['name']; ?>
      <label for="name">assignment name:</label>
      <input type="text" id="name" name="name"
             value="<?php if (!empty($name)) echo $name; ?>" /><br />
             
      <!-- Assignment Due Date -->
      <?php echo $form_errors['due_date']; ?>
      <label for="due_date">due date:</label>
      <input type="text" id="due_date" name="due_date"
             value="<?php if (!empty($due_date)) echo $due_date; ?>" /><br />
             
      <!-- Submission -->
      <input type="submit" value="create assignment" id="submit" name="submit" />
    </form>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


