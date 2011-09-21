<?php
  // Process POST data if form was submitted
  if (isset($_POST['submit'])) {
    // Grab the email from the POST
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));

    // Validate form data
    $form_errors = array();
    $field_required_string = '<ul><li>This field is required.</li></ul>';
    
    if (empty($email)) {
      $form_errors['email'] = $field_required_string;
    } else {
      if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
        $form_errors['email'] = '<ul><li>Enter a valid e-mail address.</li></ul>';
      }
    }
      
    if (empty($form_errors)) {
      $query = "UPDATE oneroom_users SET email = '$email'
                WHERE id = '$user_id'";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
  
      // Redirect to success page
      redirect('acct_change_success.php');
    }
  } else {
    // get existing email from database
    $query = "SELECT email FROM oneroom_users WHERE id=$user_id";
    $result = mysqli_query($dbc, $query) or redirect('500.php');
    $row = mysqli_fetch_array($result);
    $email = $row['email'];
  }
?>

<!-- Course Edit Form -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <!-- Email -->
  <?php echo $form_errors['email']; ?>
  <label for="email">new email:</label>
  <input type="text" id="email" name="email"
         value="<?php echo $email; ?>" /><br />
  
  <!-- Submission -->
  <input type="submit" value="update email" id="submit" name="submit" />
</form>
