<?php
  /* login.php
   * ---------
   * login.php logs in a user.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Process POST request if the login form has been submitted
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
      $data = mysqli_query($dbc, $query) or redirect('500.php');

      if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars
          // and redirect to the home page
        $row = mysqli_fetch_array($data);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
          
        // Redirect to home
        redirect('home.php');
      } else {
        $form_errors['login'] = $login_error;
      }
    }
  }
  
  // If there is no POST request, or if there are form errors, render the
  // form.
  
  // Set page title
  $page_title = 'Login';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>User Login</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <?php echo $form_errors['login']; ?>
      <label for="username">username:</label>
      <input type="text" id="username" name="username"
             value="<?php if (!empty($username)) echo $username; ?>" /><br />
      <label for="password">password:</label>
      <input type="password" id="password" name="password" /><br />
      <input type="submit" id="submit" value="login" name="submit" />
    </form><br />
    <p>
      If you are not yet a registered user, click <a href="register.php">here</a>
      to register.
    </p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>

