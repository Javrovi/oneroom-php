<?php
  // Process POST data if form was submitted
  if (isset($_POST['submit'])) {
    // Grab the grade from the POST
    $grade = mysqli_real_escape_string($dbc, trim($_POST['grade']));

    if (!empty($grade)) {
      // new grades? insert new row
      if ($grade_id == 0) {
        $query = "INSERT INTO grades (assignment_id, student_id, grade)
                  VALUES ('$assignment_id', '$student_id', '$grade')";
      } else {
        $query = "UPDATE grades SET grade = '$grade'
                  WHERE grade_id = '$grade_id'";
      }
      
      $result = mysqli_query($dbc, $query)
                  or die('Error querying database: ' . mysqli_error($dbc));
  
      // Redirect to success page
      $_SESSION['assignment_id'] = $assignment_id;
      $_SESSION['course_id'] = $course_id;
      $_SESSION['student_id'] = $student_id;
      redirect('grade_edit_success.php');
    } else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    }
  } else {
    // Otherwise, get existing assignment name and due date from the database
    $query = "SELECT grade, grade_id FROM grades
              WHERE student_id=$student_id and assignment_id=$assignment_id";
    $result = mysqli_query($dbc, $query) or
                die('Error querying database: ' . mysqli_error($dbc));
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
?>

<!-- Course Edit Form -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <!-- Grade -->
  <label for="grade">grade:</label>
  <input type="text" id="grade" name="grade"
         value="<?php echo $grade; ?>" /><br />
  
  <!-- Submission -->
  <input type="submit" value="input grade" id="submit" name="submit" />
</form>
