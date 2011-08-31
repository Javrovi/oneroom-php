<?php
  // DB connection globals
  require_once('connectvars.php');

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($username) && !empty($password)) {
        // Look up the username and password in the database
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
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] .
                      dirname($_SERVER['PHP_SELF']) . '/home.php';
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  }
?>

<?php
  // If the session var is empty, show any error message and the log-in form;
  // otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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

<?php
  }
  else {
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
  }
?>

