<?php
  // Process POST data if form was submitted
  if (isset($_POST['submit'])) {
    // grab assignment and course ids
    $assignment_id = $_SESSION['assignment_id'];
    $course_id = $_SESSION['course_id'];
    
    // Grab the profile data from the POST
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

    // If no form errors, proceed to edit assignment and save to database
    if (empty($form_errors)) {
      // Convert due date to MySQL's YYYY-MM-DD format
      $due_date = $matches[3] . '-' .
                  $matches[1] . '-' .
                  $matches[2];
                  
      // Update 'assignments' table
      $query = "UPDATE assignments SET
                name = '$name', due_date = '$due_date'
                WHERE
                assignment_id = '$assignment_id'";
      
      $result = mysqli_query($dbc, $query) or redirect('500.php');
  
      // Redirect to success page
      $_SESSION['assignment_id'] = $assignment_id;
      $_SESSION['course_id'] = $course_id;
      redirect('assignment_edit_success.php');
    }
  } else {
  // Otherwise, if we have a GET request, grab old assignment data, and
  // save assignment id and course id for when we process the POST request
    $name = $assignment_info['name'];
    $due_date_string = $assignment_info['due_date_string'];
    
    $_SESSION['assignment_id'] = $assignment_id;
    $_SESSION['course_id'] = $course_id;
  }
?>

<!-- Assignment Edit Form -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <!-- Assignment Name -->
  <?php echo $form_errors['name']; ?>
  <label for="name">assignment name:</label>
  <input type="text" id="name" name="name"
         value="<?php echo $name; ?>" /><br />
         
  <!-- Assignment Due Date -->
  <?php echo $form_errors['due_date']; ?>
  <label for="due_date">due date:</label>
  <input type="text" id="due_date" name="due_date"
         value="<?php echo $due_date_string; ?>" /><br />
  
  <!-- Submission -->
  <input type="submit" value="update assignment" id="submit" name="submit" />
</form>
