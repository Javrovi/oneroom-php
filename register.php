<?php
  /* register.php
   * ------------
   * register.php registers a new user for OneRoom.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Process POST request if the login form has been submitted
  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $usertype = mysqli_real_escape_string($dbc, trim($_POST['usertype']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    
    // Validate form data
    $form_errors = array();
    $field_required_string = '<ul><li>This field is required.</li></ul>';
    
    if (empty($first_name)) {
      $form_errors['first_name'] = $field_required_string;
    }
    if (empty($last_name)) {
      $form_errors['last_name'] = $field_required_string;
    }
    if (empty($username)) {
      $form_errors['username'] = $field_required_string;
    } else {
      $query = "SELECT * FROM oneroom_users WHERE username = '$username'";
      $data = mysqli_query($dbc, $query) or redirect('500.php');
      if (mysqli_num_rows($data) > 0) {
        $form_errors['username'] =
          '<ul><li>Username is already taken.</li></ul>';
      }
    }
    if (empty($email)) {
      $form_errors['email'] = $field_required_string;
    } else {
      if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
        $form_errors['email'] = '<ul><li>Enter a valid e-mail address.</li></ul>';
      }
    }
    if (empty($password1)) {
      $form_errors['password1'] = $field_required_string;
    }
    if (empty($password2)) {
      $form_errors['password2'] = $field_required_string;
    } else {
      if ($password1 != $password2) {
        $form_errors['password2'] = '<ul><li>Passwords do not match.</li></ul>';
      }
    }
    
    if (empty($form_errors)) {
      $query = "INSERT INTO oneroom_users
                (first_name, last_name, username, email, user_type, password)
                VALUES
                ('$first_name', '$last_name', '$username', '$email',
                '$usertype', SHA('$password1'))";
                         
      $result = mysqli_query($dbc, $query) or redirect('500.php');

      // Log in the newly-registered user
      $_SESSION['user_id'] = mysqli_insert_id($dbc);
      $_SESSION['username'] = $username;
   
      // Redirect to 'registration successful' page
      redirect('reg_success.php');
    }
  }
  
  // If there is no POST request, or if there are form errors, render the
  // form.
  
  // Set page title
  $page_title = 'User Registration';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>User Registration</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <!-- User Registration Form -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <!-- First Name -->
      <?php echo $form_errors['first_name']; ?>
      <label for="first_name">first name:</label>
      <input type="text" id="first_name" name="first_name"
             value="<?php if (!empty($first_name)) echo $first_name; ?>" /><br />
             
      <!-- Last Name -->
      <?php echo $form_errors['last_name']; ?>
      <label for="last_name">last name:</label>
      <input type="text" id="last_name" name="last_name"
             value="<?php if (!empty($last_name)) echo $last_name; ?>" /><br />
             
      <!-- Username -->
      <?php echo $form_errors['username']; ?>
      <label for="username">username:</label>
      <input type="text" id="username" name="username"
             value="<?php if (!empty($username)) echo $username; ?>" /><br />
             
      <!-- Email -->
      <?php echo $form_errors['email']; ?>
      <label for="email">email:</label>
      <input type="text" id="email" name="email"
             value="<?php if (!empty($email)) echo $email; ?>" /><br />
             
      <!-- User type (Teacher or Student) -->
      <label for="usertype">user type:</label>
      <select id="usertype" name="usertype">
        <option value="teacher">Teacher</option>
        <option value="student">Student</option>
      </select><br />
      
      <!-- Password -->
      <?php echo $form_errors['password1']; ?>
      <label for="password1">password:</label>
      <input type="password" id="password1" name="password1" /><br />
      <?php echo $form_errors['password2']; ?>
      <label for="password2">password (retype):</label>
      <input type="password" id="password2" name="password2" /><br />
      
      <!-- Submission -->
      <input type="submit" value="register" id="submit" name="submit" />
    </form>

  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>



