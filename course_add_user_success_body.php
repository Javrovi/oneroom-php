<?php
  // Get the course id and the user id
  $course_id = $_SESSION['course_id'];
  $user_id = $_SESSION['user_id'];
 
  if ($is_teacher) {
    // check passcode
    $passcode = mysqli_real_escape_string($dbc, trim($_POST['passcode']));
    
    $query = "SELECT * FROM courses
              WHERE course_id = '$course_id' AND passcode = SHA('$passcode')";
    $result = mysqli_query($dbc, $query)
      or die('Error querying database: ' . mysqli_error($dbc));
    
    if (mysqli_num_rows($result) == 1) {
      // add teacher to courses_teachers junction table
      $query = "INSERT INTO courses_teachers (teacher_id, course_id)
                VALUES ('$user_id', '$course_id')";
    } else {
      redirect('course_add_teacher_bad_passcode.php');
    }
  } else {
    // student to courses_students junction table
    $query = "INSERT INTO courses_students (student_id, course_id)
              VALUES ('$user_id', '$course_id')";
  }
  
  // Now, we're going to check if the user is already in the course
  // We only add the user if the user is not already in the course
  if ($is_teacher) {
    $query2 = "SELECT * from courses_teachers WHERE
              course_id = '$course_id' and teacher_id = '$user_id'";
  } else {
    $query2 = "SELECT * from courses_students WHERE
              course_id = '$course_id' and student_id = '$user_id'";
  }
  $result = mysqli_query($dbc, $query2)
      or die('Error querying database: ' . mysqli_error($dbc));
  if (mysqli_num_rows($result) == 0) {
    mysqli_query($dbc, $query)
      or die('Error querying database: ' . mysqli_error($dbc));
  }
  
  $user_full_name = get_user_full_name($dbc, $user_id);
  $first_name = $user_full_name['first_name'];
  $last_name = $user_full_name['last_name'];
  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  echo '<p>You have successfully added <a href="#"> ';
  echo $name . ', ' . $semester . ' ' . $year . '</a> ';
  echo 'to <a href="usercourses.php">your courses</a>.</p>';
?>