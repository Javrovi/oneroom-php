<?php
  if (isset($_POST['submit'])) {
    // Processing after form submission
    
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
?>

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