<?php
  // Process POST data if form was submitted
  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $year = mysqli_real_escape_string($dbc, trim($_POST['year']));
    $semester = mysqli_real_escape_string($dbc, trim($_POST['semester']));
    $passcode1 = mysqli_real_escape_string($dbc, trim($_POST['passcode1']));
    $passcode2 = mysqli_real_escape_string($dbc, trim($_POST['passcode2']));
    $course_id = $_SESSION['course_id'];
    
    if (!empty($name) && !empty($year) && !empty($semester) &&
        !empty($passcode1) && !empty($passcode2) &&
        ($passcode1 == $passcode2)) {
      // Update table with new data
      $query = "UPDATE courses SET
                name = '$name', year = '$year', semester = '$semester',
                passcode = SHA('$passcode1')
                WHERE
                course_id = '$course_id'";
                   
      $result = mysqli_query($dbc, $query)
                  or die('Error querying database: ' . mysqli_error($dbc));

      // Report success to the user
      redirect('course_edit_success.php');
      } else {
        echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
      }
    } else {
    // Otherwise, grab the course id from the GET request
      $course_id = $_GET['course_id'];
      $_SESSION['course_id'] = $course_id;
      
      // Get course's full name to populate form
      $course_full_name = get_course_full_name($dbc, $course_id);  
      $name = $course_full_name['name'];
      $semester = $course_full_name['semester'];
      $year = $course_full_name['year'];
    }
?>

<!-- Course Edit Form -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <!-- Course Name -->
  <label for="name">course name:</label>
  <input type="text" id="name" name="name"
         value="<?php echo $name; ?>" /><br />
         
  <!-- Course Year -->
  <label for="year">year:</label>
  <input type="text" id="year" name="year"
         value="<?php echo $year; ?>" /><br />
         
  <!-- Course Semester -->
  <label for="semester">semester:</label>
  <input type="text" id="semester" name="semester"
         value="<?php echo $semester; ?>" /><br />
  
  <!-- Passcode -->
  <label for="passcode1">passcode:</label>
  <input type="password" id="passcode1" name="passcode1" /><br />
  <label for="password2">password (retype):</label>
  <input type="password" id="passcode2" name="passcode2" /><br />
  
  <!-- Submission -->
  <input type="submit" value="update course" id="submit" name="submit" />
</form>
