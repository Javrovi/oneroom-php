<?php
  /*
   * is_teacher() returns true if the user with $user_id is a teacher
   *  and false otherwise.
   */
  function is_teacher($dbc, $user_id) {
    $is_teacher = false;
    if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
 
      $query = "SELECT * FROM oneroom_users WHERE id = '$user_id'";
      $result = mysqli_query($dbc, $query) or
                die('Query failed: ' . mysqli_error($dbc));
      $row = mysqli_fetch_array($result);

      if ($row['user_type'] == 'teacher') {
        $is_teacher = true;
      }
    }
    return $is_teacher;
  }
  
  /*
   * redirect() redirects to the script name in $script_name
   */
  function redirect($script_name) {
    $redirect_url = 'http://' . $_SERVER['HTTP_HOST'] .
                    dirname($_SERVER['PHP_SELF']) . '/' .
                    $script_name;
    header('Location: ' . $redirect_url);
  }
  
  
  /*
   * get_user_courses() returns an array of course ids of the courses
   *  that the user is taking or teaching.
   */
  function get_user_courses($dbc, $user_id, $is_teacher) {    
    if ($is_teacher) {
      $query = "SELECT course_id FROM courses_teachers WHERE
                teacher_id = '$user_id'";
    } else {
      $query = "SELECT course_id FROM courses_students WHERE
                student_id = '$user_id'";
    }
    $result = mysqli_query($dbc, $query)
              or die('Error querying database: ' . mysqli_error($dbc));
    
    // Grab the course ids and put them into an array
    $user_course_ids = array();
    while ($row = mysqli_fetch_array($result)) {
      array_push($user_course_ids, $row['course_id']);
    }

    return $user_course_ids;  
  }
  
  /*
   * get_user_full_name() returns an associative array of the user's first
   *  and last name.  $user_id is passed in.
   *  The keys in the returned array are 'first_name' and 'last_name'.
   *
   *  Example usage: $user_full_name = get_user_full_name($dbc, 2);
   *                 $first_name = $user_full_name['first_name'];
   *                 $last_name = $user_full_name['last_name'];
   */
  function get_user_full_name($dbc, $user_id) {
    // Get first name and last name from the database
    $query = "SELECT first_name, last_name FROM oneroom_users WHERE
              id = '$user_id'";
    $result = mysqli_query($dbc, $query)
                or die('Error querying database: ' . mysqli_error($dbc));
    if (mysqli_num_rows($result) == 1) {
      // Success if only one row is returned
      $row = mysqli_fetch_array($result);
    } else {
      die('Error querying database:
           no user with this id or more than one user with the same id.');
    }
   
    $user_full_name = array();
    $user_full_name['first_name'] = $row['first_name'];
    $user_full_name['last_name'] = $row['last_name'];
    
    return $user_full_name;
  }
  
  /*
   * get_course_full_name() returns an associative array of the course's
   *  name, semester, and year.  $course_id is passed in.
   *  The keys in the returned array are 'name', 'semester', and 'year'.
   *
   *  Example usage: $course_full_name = get_course_full_name($dbc, 3);
   *                 $name = $course_full_name['name'];
   *                 $semester = $course_full_name['semester'];
   *                 $year = $course_full_name['year'];
   */
  function get_course_full_name($dbc, $course_id) {
    $query = "SELECT name, semester, year FROM courses WHERE
              course_id = '$course_id'";
    $result = mysqli_query($dbc, $query)
              or die('Error querying database: ' . mysqli_error($dbc));
    if (mysqli_num_rows($result) == 1) {
        // Success if only one row is returned
        $row = mysqli_fetch_array($result);
    } else {
      // Something went wrong if the number of rows returned is not 1
      die('Error querying database:
           no course with this id or more than one course with the same id.');
    }
    
    $course_full_name = array();
    $course_full_name['name'] = $row['name'];
    $course_full_name['semester'] = $row['semester'];
    $course_full_name['year'] = $row['year'];
    
    return $course_full_name;
  }