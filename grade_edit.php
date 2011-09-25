<?php
  /* grade_edit.php
   * ---------------------
   * grade_edit.php is run when a teacher indicates that she wants to
   * edit a student's grade for an assignment.  Successful form submission
   * updates the student's grade for the assignment and redirects the teacher to
   * grade_edit_success.php.
   */

  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions: only teachers of the course can edit a student's grade
  // for an assignment in that course.
  if (!$is_teacher) {
    redirect('nopermissions.php');
  } else {
    if (isset($_POST['submit'])) {
      $assignment_id = $_SESSION['assignment_id'];
      $course_id = $_SESSION['course_id'];
      $student_id = $_SESSION['student_id'];
      $grade_id = $_SESSION['grade_id'];
    } else {
      $assignment_id = $_GET['assignment_id'];
      $student_id = $_GET['student_id'];
      $course_id = $_GET['course_id'];
    }
    
    // Get assignment name
    $assignment_info = get_assignment_info($dbc, $assignment_id);
    $name = $assignment_info['name'];
    
    // Get course name
    $course_full_name = get_course_full_name($dbc, $course_id);  
    $course_name = $course_full_name['name'];
    $course_semester = $course_full_name['semester'];
    $course_year = $course_full_name['year'];
    
    // Get student name
    $student_name = get_user_full_name($dbc, $student_id);
    $first_name = $student_name['first_name'];
    $last_name = $student_name['last_name'];
    
    // Check that the teacher is teaching the course
    $query = "SELECT * FROM courses_teachers WHERE
                course_id = '$course_id' and teacher_id = '$user_id'";
    $result = mysqli_query($dbc, $query) or redirect('500.php');
    // if not, redirect
    if (mysqli_num_rows($result) == 0) {
      redirect('nopermissions.php');
    }
  } 
  
  // If we get here, we're ok
  
  // Process POST data if form was submitted
  if (isset($_POST['submit'])) {
    // Grab the grade from the POST
    $grade = mysqli_real_escape_string($dbc, trim($_POST['grade']));

    // Validate form data
    $form_errors = array();
    $field_required_string = '<ul><li>This field is required.</li></ul>';
    
    if (empty($grade)) {
      $form_errors['grade'] = $field_required_string;
    }
    
    if (empty($form_errors)) {
      // New grades?
      if ($grade_id == 0) {
        $query = "INSERT INTO grades (assignment_id, student_id, grade)
                  VALUES ('$assignment_id', '$student_id', '$grade')";
      } else {
        $query = "UPDATE grades SET grade = '$grade'
                  WHERE grade_id = '$grade_id'";
      }
      
      $result = mysqli_query($dbc, $query) or redirect('500.php');
  
      // Redirect to success page
      $_SESSION['assignment_id'] = $assignment_id;
      $_SESSION['course_id'] = $course_id;
      $_SESSION['student_id'] = $student_id;
      redirect('grade_edit_success.php');
    } 
  } else {
    // Otherwise, get existing assignment name and due date from the database
    $query = "SELECT grade, grade_id FROM grades
              WHERE student_id=$student_id and assignment_id=$assignment_id";
    $result = mysqli_query($dbc, $query) or redirect('500.php');
    $row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) == 1) {
      $grade = $row['grade'];
      $grade_id = $row['grade_id'];
    } else {
      $grade = '';
      $grade_id = 0;
    }
    
    $_SESSION['assignment_id'] = $assignment_id;
    $_SESSION['course_id'] = $course_id;
    $_SESSION['student_id'] = $student_id;
    $_SESSION['grade_id'] = $grade_id;
  }
  
  // Set page title
  $page_title = 'Edit Grade';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <?php
      echo '<h1>Edit Grade for ';
      echo "$first_name $last_name <br />";
      echo "<span class=\"paren\">";
      echo "($course_name, $course_semester $course_year, $name)</span>";
      echo '</h1>';
    ?>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <!-- Grade Edit Form -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <!-- Grade -->
      <?php echo $form_errors['grade']; ?>
      <label for="grade">grade:</label>
      <input type="text" id="grade" name="grade"
             value="<?php echo $grade; ?>" /><br />
      
      <!-- Submission -->
      <input type="submit" value="input grade" id="submit" name="submit" />
    </form>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


