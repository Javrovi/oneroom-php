<?php
  // Process POST data if form was submitted
  if (isset($_POST['submit'])) {
    // Grab the email from the POST
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));

    if (!empty($email)) {
      $query = "UPDATE oneroom_users SET email = '$email'
                WHERE id = '$user_id'";
      $result = mysqli_query($dbc, $query)
                  or die('Error querying database: ' . mysqli_error($dbc));
  
      // Redirect to success page
      redirect('acct_change_success.php');
    } else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    }
  } else {
    // get existing email from database
    $query = "SELECT email FROM oneroom_users WHERE id=$user_id";
    $result = mysqli_query($dbc, $query) or
                die('Error querying database: ' . mysqli_error($dbc));
    $row = mysqli_fetch_array($result);
    $email = $row['email'];
  }
?>

<!-- Course Edit Form -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <!-- Email -->
  <label for="email">new email:</label>
  <input type="text" id="email" name="email"
         value="<?php echo $email; ?>" /><br />
  
  <!-- Submission -->
  <input type="submit" value="update email" id="submit" name="submit" />
</form>
