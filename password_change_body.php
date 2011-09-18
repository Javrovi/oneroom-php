<?php
  if (isset($_POST['submit'])) {
    // Grab the passwords from the POST
    $old_pwd = mysqli_real_escape_string($dbc, trim($_POST['old_pwd']));
    
    // Check old password
    $query = "SELECT * FROM oneroom_users
              WHERE id = '$user_id' AND password= SHA('$old_pwd')";
    $result = mysqli_query($dbc, $query)
      or die('Error querying database: ' . mysqli_error($dbc));
    
    if (mysqli_num_rows($result) == 1) {
      $new_pwd1 = mysqli_real_escape_string($dbc, trim($_POST['new_pwd1']));
      $new_pwd2 = mysqli_real_escape_string($dbc, trim($_POST['new_pwd2']));
      if (!empty($new_pwd1) && !empty($new_pwd2)) {  
        if ($new_pwd1 != $new_pwd2) {
          echo '<p>New passwords do not match.</p>';
        } else {
          $query = "UPDATE oneroom_users SET password = SHA('$new_pwd1')
                    WHERE id = '$user_id'";
          $result = mysqli_query($dbc, $query)
                    or die('Error querying database: ' . mysqli_error($dbc));
    
        // Redirect to success page
        redirect('acct_change_success.php');
        }
      } else {
        echo '<p>All fields must be filled out.</p>';
      }
    } else {
      echo '<p>Incorrect password.</p>';
    }
  }
?>

<!-- Passcode Input Form -->
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="old_pwd">current password:</label>
    <input type="password" id="old_pwd" name="old_pwd" /><br />

    <label for="new_pwd1">new password:</label>
    <input type="password" id="new_pwd1" name="new_pwd1" /><br />

    <label for="new_pwd2">new password (retype):</label>
    <input type="password" id="new_pwd2" name="new_pwd2" /><br />

    <!-- Submission -->
    <input type="submit" value="update" id="submit" name="submit" />
  </form>