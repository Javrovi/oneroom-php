<?php
  if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
    
    // Validate form data
    $form_errors = array();
    $login_error = '<ul><li>Your username and password didn\'t match.
                    Please try again.';
    
    if (empty($username) or (empty($password))) {
      $form_errors['login'] = $login_error;
    } else {
      $query = "SELECT id, username FROM oneroom_users WHERE
                username = '$username' AND password = SHA('$password')";
      $data = mysqli_query($dbc, $query);

      if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars
          // and redirect to the home page
        $row = mysqli_fetch_array($data);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
          
        // Redirect
        redirect('home.php');
      } else {
        $form_errors['login'] = $login_error;
      }
    }
  }
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <?php echo $form_errors['login']; ?>
  <label for="username">username:</label>
  <input type="text" id="username" name="username"
         value="<?php if (!empty($username)) echo $username; ?>" /><br />
  <label for="password">password:</label>
  <input type="password" id="password" name="password" /><br />
  <input type="submit" id="submit" value="login" name="submit" />
</form>
<br />
<p>
  If you are not yet a registered user, click <a href="register.php">here</a>
  to register.
</p>

