<?php
if (isset($_POST['submit'])) {
  // Grab the profile data from the POST
  $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
  $year = mysqli_real_escape_string($dbc, trim($_POST['year']));
  $semester = mysqli_real_escape_string($dbc, trim($_POST['semester']));
  $passcode1 = mysqli_real_escape_string($dbc, trim($_POST['passcode1']));
  $passcode2 = mysqli_real_escape_string($dbc, trim($_POST['passcode2']));
  
  if (!empty($name) && !empty($year) && !empty($semester) &&
      !empty($passcode1) && !empty($passcode2) &&
      ($passcode1 == $passcode2)) {
    // Insert new row into 'courses' table
    $query = "INSERT INTO courses
              (name, year, semester, passcode)
              VALUES
              ('$name', '$year', '$semester', SHA('$passcode1'))";
                 
    $result = mysqli_query($dbc, $query)
                or die('Error querying database: ' . mysqli_error($dbc));

    // Grab the new course id and insert a new row into the
    // 'courses_teachers' table
    $course_id = mysqli_insert_id($dbc);
    $query = "INSERT INTO courses_teachers
              (teacher_id, course_id)
              VALUES
              ('$user_id', '$course_id')";
    
    $result = mysqli_query($dbc, $query)
              or die('Error querying database: ' . mysqli_error($dbc));
              
    // Redirect to success page
    $_SESSION['course_id'] = $course_id;
    redirect('course_create_success.php');
  }
  else {
    echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
  }
}
?>

<!-- Course Creation Form -->
<p>Teacher, create a new course below:</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <!-- Course Name -->
  <label for="name">course name:</label>
  <input type="text" id="name" name="name"
         value="<?php if (!empty($name)) echo $name; ?>" /><br />
         
  <!-- Course Year -->
  <label for="year">year:</label>
  <input type="text" id="year" name="year"
         value="<?php if (!empty($year)) echo $year; ?>" /><br />
         
  <!-- Course Semester -->
  <label for="semester">semester:</label>
  <input type="text" id="semester" name="semester"
         value="<?php if (!empty($semester)) echo $semester; ?>" /><br />
  
  <!-- Passcode -->
  <label for="passcode1">passcode:</label>
  <input type="password" id="passcode1" name="passcode1" /><br />
  <label for="password2">password (retype):</label>
  <input type="password" id="passcode2" name="passcode2" /><br />
  
  <!-- Submission -->
  <input type="submit" value="create course" id="submit" name="submit" />
</form>