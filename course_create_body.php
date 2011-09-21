<?php
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
    // Insert new row into 'courses' table
    $query = "INSERT INTO courses
              (name, year, semester, passcode)
              VALUES
              ('$name', '$year', '$semester', SHA('$passcode1'))";
                 
    $result = mysqli_query($dbc, $query) or redirect('500.php');

    // Grab the new course id and insert a new row into the
    // 'courses_teachers' table
    $course_id = mysqli_insert_id($dbc);
    $query = "INSERT INTO courses_teachers
              (teacher_id, course_id)
              VALUES
              ('$user_id', '$course_id')";
    
    $result = mysqli_query($dbc, $query) or redirect('500.php');
              
    // Redirect to success page
    $_SESSION['course_id'] = $course_id;
    redirect('course_create_success.php');
  }
}
?>

<!-- Course Creation Form -->
<p>Teacher, create a new course below:</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <!-- Course Name -->
  <?php echo $form_errors['name']; ?>
  <label for="name">course name:</label>
  <input type="text" id="name" name="name"
         value="<?php if (!empty($name)) echo $name; ?>" /><br />
         
  <!-- Course Year -->
  <?php echo $form_errors['year']; ?>
  <label for="year">year:</label>
  <input type="text" id="year" name="year"
         value="<?php if (!empty($year)) echo $year; ?>" /><br />
         
  <!-- Course Semester -->
  <?php echo $form_errors['semester']; ?>
  <label for="semester">semester:</label>
  <input type="text" id="semester" name="semester"
         value="<?php if (!empty($semester)) echo $semester; ?>" /><br />
  
  <!-- Passcode -->
  <?php echo $form_errors['passcode1']; ?>
  <label for="passcode1">passcode:</label>
  <input type="password" id="passcode1" name="passcode1" /><br />
  <?php echo $form_errors['passcode2']; ?>
  <label for="password2">password (retype):</label>
  <input type="password" id="passcode2" name="passcode2" /><br />
  
  <!-- Submission -->
  <input type="submit" value="create course" id="submit" name="submit" />
</form>