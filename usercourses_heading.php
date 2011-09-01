<?php
  // Only logged in users can see their personal courses
  if ($logged_in) {
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    // Get first name and last name from the database
    $query = "SELECT first_name, last_name FROM oneroom_users WHERE
              id = '$user_id'";
    $result = mysqli_query($dbc, $query)
                or die('Error querying database: ' . mysqli_error($dbc));
    if (mysqli_num_rows($result) == 1) {
      // Success if only one row is returned
      $row = mysqli_fetch_array($result);
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
    } else {
      die('Error querying database:
           no user with this id or more than one user with the same id.');
    }
   
    echo '<h1>' . $first_name . ' ' . $last_name .'\'s Courses ';
    // Display a link to course creation script if the logged-in user is a teacher
    if ($is_teacher) {
      echo '<a class="paren-link" href="course_create.php">';
      echo '(create a new course)</a>';
    }
    echo '</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('/nopermissions.php');
  }
?>