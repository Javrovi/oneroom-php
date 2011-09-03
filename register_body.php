<?php 
  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $usertype = mysqli_real_escape_string($dbc, trim($_POST['usertype']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    
    if (!empty($first_name) && !empty($last_name) && !empty($username) &&
        !empty($email) && !empty($usertype) &&
        !empty($password1) && !empty($password2) &&
        ($password1 == $password2)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM oneroom_users WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO oneroom_users
                  (first_name, last_name, username, email, user_type, password)
                  VALUES
                  ('$first_name', '$last_name', '$username', '$email',
                   '$usertype', SHA('$password1'))";
                         
        $result = mysqli_query($dbc, $query)
                    or die('Error querying database: ' . mysqli_error($dbc));

        // Log in the newly-registered user
        $_SESSION['user_id'] = mysqli_insert_id($dbc);
        $_SESSION['username'] = $username;
   
        // Redirect to 'registration successful' page
        redirect('reg_success.php');
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">Username is already taken.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    }
  }


?>

  <!-- User Registration Form -->
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <!-- First Name -->
    <label for="first_name">first name:</label>
    <input type="text" id="first_name" name="first_name"
           value="<?php if (!empty($first_name)) echo $first_name; ?>" /><br />
           
    <!-- Last Name -->
    <label for="last_name">last name:</label>
    <input type="text" id="last_name" name="last_name"
           value="<?php if (!empty($last_name)) echo $last_name; ?>" /><br />
           
    <!-- Username -->
    <label for="username">username:</label>
    <input type="text" id="username" name="username"
           value="<?php if (!empty($username)) echo $username; ?>" /><br />
           
    <!-- Email -->
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
    <label for="password1">password:</label>
    <input type="password" id="password1" name="password1" /><br />
    <label for="password2">password (retype):</label>
    <input type="password" id="password2" name="password2" /><br />
    
    <!-- Submission -->
    <input type="submit" value="register" id="submit" name="submit" />
  </form>
