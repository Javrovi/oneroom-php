<?php
  /* password_change.php
   * ----------------
   * password_change.php processes a user's request to update her email.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Process form submission
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
  
  // Set page title
  $page_title = 'User Account: Password Change';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>User Account: Password Change</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
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
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>

