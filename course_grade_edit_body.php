<?php
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
?>

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
