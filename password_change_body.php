<?php
  if (isset($_POST['submit'])) {
    // Grab the passwords from the POST
    $old_pwd = mysqli_real_escape_string($dbc, trim($_POST['old_pwd']));
    $new_pwd1 = mysqli_real_escape_string($dbc, trim($_POST['new_pwd1']));
    $new_pwd2 = mysqli_real_escape_string($dbc, trim($_POST['new_pwd2']));
    
    // Validate form data
    $form_errors = array();
    $field_required_string = '<ul><li>This field is required.</li></ul>';
    
    if (empty($old_pwd)) {
      $form_errors['old_pwd'] = $field_required_string;
    } else {
      $query = "SELECT * FROM oneroom_users
              WHERE id = '$user_id' AND password= SHA('$old_pwd')";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
      if (mysqli_num_rows($result) == 0) {
        $form_errors['old_pwd'] = '<ul><li>Incorrect old password.</li></ul>';
      }
    }
    if (empty($new_pwd1)) {
      $form_errors['new_pwd1'] = $field_required_string;
    }
    if (empty($new_pwd2)) {
      $form_errors['new_pwd2'] = $field_required_string;
    } else {
      if ($new_pwd1 != $new_pwd2) {
        $form_errors['new_pwd2'] = '<ul><li>New passwords do not match.</li></ul>';
      }
    }
  
    if (empty($form_errors)) {
      $query = "UPDATE oneroom_users SET password = SHA('$new_pwd1')
                WHERE id = '$user_id'";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
    
      // Redirect to success page
      redirect('acct_change_success.php');
    }
  }
?>

<!-- Passcode Input Form -->
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php echo $form_errors['old_pwd']; ?>
    <label for="old_pwd">current password:</label>
    <input type="password" id="old_pwd" name="old_pwd" /><br />

    <?php echo $form_errors['new_pwd1']; ?>
    <label for="new_pwd1">new password:</label>
    <input type="password" id="new_pwd1" name="new_pwd1" /><br />

    <?php echo $form_errors['new_pwd2']; ?>
    <label for="new_pwd2">new password (retype):</label>
    <input type="password" id="new_pwd2" name="new_pwd2" /><br />

    <!-- Submission -->
    <input type="submit" value="update" id="submit" name="submit" />
  </form>