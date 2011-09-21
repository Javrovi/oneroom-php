<?php
  /* utils.php
   * ---------
   * utils.php contains the utility functions for the OneRoom PHP web
   * application.
   */
  
  /*
   * is_teacher() returns true if the user with $user_id is a teacher
   *  and false otherwise.
   */
  function is_teacher($dbc, $user_id) {
    $is_teacher = false;

    $query = "SELECT * FROM oneroom_users WHERE id = '$user_id'";
    $result = mysqli_query($dbc, $query) or redirect('500.php');
    $row = mysqli_fetch_array($result);

    if ($row['user_type'] == 'teacher') {
      $is_teacher = true;
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
    $result = mysqli_query($dbc, $query) or redirect('500.php');
    
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
    $result = mysqli_query($dbc, $query) or redirect('500.php');
    if (mysqli_num_rows($result) == 1) {
      // Success if only one row is returned
      $row = mysqli_fetch_array($result);
    } else {
      redirect('500.php');
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
    $result = mysqli_query($dbc, $query) or redirect('500.php');
    if (mysqli_num_rows($result) == 1) {
        // Success if only one row is returned
        $row = mysqli_fetch_array($result);
    } else {
      // Something went wrong if the number of rows returned is not 1
      redirect('500.php');
    }
    
    $course_full_name = array();
    $course_full_name['name'] = $row['name'];
    $course_full_name['semester'] = $row['semester'];
    $course_full_name['year'] = $row['year'];
    
    return $course_full_name;
  }
  
  /*
   * get_assignment_info() returns the name, due date, and associated course id
   * of the assignment whose id, $assignment_id, is passed in.  An associative
   * array is returned.  The keys in the returned array are 'name', 'due_date',
   * 'due_date_string', and 'course_id'. The 'due_date' field in the associated
   * array is itself an associative array.  The keys in that array are 'month'
   * (e.g., 'Jan.'), 'day' (e.g., '15'), and 'year' (e.g., '2011'). The
   * 'due_date_string' field is a string representing the due date in the
   * MM/DD/YYYY format (e.g., '1/15/2011').
   *
   *  Example usage: $assignment_info = get_assignment_info($dbc, 3);
   *                 $name = $assignment_info['name'];
   *                 $due_date = $assignment_info['due_date'];
   *                 $course_id = $assignment_info['course_id'];
   *                 $due_date_month = $due_date['month'];
   *                 $due_date_day = $due_date['day'];
   *                 $due_date_year = $due_date['year'];
   */
  function get_assignment_info($dbc, $assignment_id) {
    $query = "SELECT name, due_date, course_id FROM assignments WHERE
              assignment_id = '$assignment_id'";
    $result = mysqli_query($dbc, $query) or redirect('500.php');
    if (mysqli_num_rows($result) == 1) {
        // Success if only one row is returned
        $row = mysqli_fetch_array($result);
    } else {
      // Something went wrong if the number of rows returned is not 1
      redirect('500.php');
    }
    
    $assignment_info = array();
    $assignment_info['name'] = $row['name'];
    $assignment_info['course_id'] = $row['course_id'];
    
    // Process the due date retrieved from the database, which is in the
    // YYYY-MM-DD format, into an associative array, $due_date, where
    // $due_date['month'] contains a string representing the month
    // (e.g., 'Jan.'), $due_date['day'] contains a string representing the day,
    // (e.g., '15'), and $due_day['year'] contains a string representing the
    // year (e.g., '2011').
    $due_date = array();
    $due_date_exploded = explode('-', $row['due_date']);
    $assignment_info['due_date_string'] = $due_date_exploded[1] . '/' .
                                          $due_date_exploded[2] . '/' .
                                          $due_date_exploded[0];
    $due_date['year'] = $due_date_exploded[0];
    $due_date['day'] = $due_date_exploded[2];
    $month = $due_date_exploded[1];
    
    switch ($month) {
      case 1:
        $due_date['month'] = 'Jan.';
        break;
      case 2:
        $due_date['month'] = 'Feb.';
        break;
      case 3:
        $due_date['month'] = 'Mar.';
        break;
      case 4:
        $due_date['month'] = 'Apr.';
        break;
      case 5:
        $due_date['month'] = 'May';
        break;
      case 6:
        $due_date['month'] = 'Jun.';
        break;
      case 7:
        $due_date['month'] = 'Jul.';
        break;
      case 8:
        $due_date['month'] = 'Aug.';
        break;
      case 9:
        $due_date['month'] = 'Sep.';
        break;
      case 10:
        $due_date['month'] = 'Oct.';
        break;
      case 11:
        $due_date['month'] = 'Nov.';
        break;
      case 2:
        $due_date['month'] = 'Dec.';
        break;
    }
    $assignment_info['due_date'] = $due_date;
    
    return $assignment_info;
  }
  
  /*
   * drop_leading_zero returns the passed-in $day as is, unless $day is
   * a single digit number written with a leading-zero (e.g., '01').  In that
   * case, the leading-zero is dropped (e.g., '1' is returned).
   */
  function drop_leading_zero($day) {
    switch ($day) {
      case '01':
        return '1';
        break;
      case '02':
        return '2';
        break;
      case '03';
        return '3';
        break;
      case '04':
        return '4';
        break;
      case '05':
        return '5';
        break;
      case '06':
        return '6';
        break;
      case '07':
        return '7';
        break;
      case '08':
        return '8';
        break;
      case '09':
        return '9';
        break;
      default:
        return $day;
        break;
    }
  }