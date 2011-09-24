<?php
  /* course_grade_edit.php
   * ---------------------
   * course_grade_edit.php is run when a teacher indicates that she wants to
   * edit a student's course grade.  Successful form submission updates the
   * student's course grade and redirects the teacher to
   * course_grade_edit_success.php.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions: only teachers of the course can edit a student's course
  // grade.
  if ($is_teacher) {
    if (isset($_POST['submit'])) {
      $course_id = $_SESSION['course_id'];
      $student_id = $_SESSION['student_id'];
      $course_grade_id = $_SESSION['course_grade_id'];
    } else {
      $student_id = $_GET['student_id'];
      $course_id = $_GET['course_id'];
    }
       
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
  } else {
    redirect('nopermissions.php');
  }
  
  // If we get here, we're ok; go on with script
  
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
        $query = "INSERT INTO course_grades (course_id, student_id, grade)
                  VALUES ('$course_id', '$student_id', '$grade')";
      } else {
        $query = "UPDATE course_grades SET grade = '$grade'
                  WHERE course_grade_id = '$course_grade_id'";
      }
      
      $result = mysqli_query($dbc, $query) or redirect('500.php');
  
      // Redirect to success page
      $_SESSION['course_id'] = $course_id;
      $_SESSION['student_id'] = $student_id;
      redirect('course_grade_edit_success.php');
    } 
  } else {
    // Otherwise, get existing course grade from the database
    $query = "SELECT grade, course_grade_id FROM course_grades
              WHERE student_id=$student_id and course_id=$course_id";
    $result = mysqli_query($dbc, $query) or redirect('500.php');
    $row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) == 1) {
      $grade = $row['grade'];
      $course_grade_id = $row['course_grade_id'];
    } else {
      $grade = '';
      $course_grade_id = 0;
    }
    
    $_SESSION['course_id'] = $course_id;
    $_SESSION['student_id'] = $student_id;
    $_SESSION['course_grade_id'] = $course_grade_id;
  }

  // Set page title
  $page_title = 'Edit Course Grade';
  
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
      echo "($course_name, $course_semester $course_year)</span>";
      echo '</h1>';
    ?>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    
  <!-- Course Edit Form -->
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


