<?php
  $course_id = $_SESSION['course_id'];
    
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  echo '<p>To add yourself as a teacher for ';
  echo $name . ', ' . $semester . ' ' . $year . ', ';
  echo 'please enter that course\'s passcode below.</p>';
    
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
?>

<!-- Passcode Input Form -->
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php echo $form_errors['passcode']; ?>
    <label for="passcode">passcode:</label>
    <input type="text" id="passcode" name="passcode" /><br />

    <!-- Submission -->
    <input type="submit" value="enter" id="submit" name="submit" />
  </form>