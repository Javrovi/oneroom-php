<?php
  // is_teacher() returns true if the user with $user_id is a teacher
  // and false otherwise.
  function is_teacher($user_id) {
    // DB connection globals
    require_once('connectvars.php');
    
    $is_teacher = false;
    if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      
      // Connect to DB to check if logged-in user is a teacher  
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
            die('Cannot connect to databse.');
      $query = "SELECT * FROM oneroom_users WHERE id = '$user_id'";
      $result = mysqli_query($dbc, $query) or
                die('Query failed: ' . mysqli_error($dbc));
      $row = mysqli_fetch_array($result);

      if ($row['user_type'] == 'teacher') {
        $is_teacher = true;
      }
    }
    mysqli_close($dbc);
    return $is_teacher;
  }