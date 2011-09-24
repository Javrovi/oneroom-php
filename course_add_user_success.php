<?php
  /* course_add_user_success.php
   * ---------------------------
   * course_add_user_success.php is run when the user confirms that she
   * wants to add herself to a course.  If the user is a teacher, the
   * passcode that she entered is checked.  If the passcode matches, or if the
   * user is a student, the user is added to the course.
   */

  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions: only logged in users can add themselves to courses.
  if (!$logged_in) {
    redirect('nopermissions.php');
  }
  
  // Get the course id 
  $course_id = $_SESSION['course_id'];
 
  // Process the request to add user
  if ($is_teacher) {
    // check passcode if the user is tacher
    $passcode = $_SESSION['passcode'];
    
    $query = "SELECT * FROM courses
              WHERE course_id = '$course_id' AND passcode = SHA('$passcode')";
    $result = mysqli_query($dbc, $query) or redirect('500.php');
    
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
  $result = mysqli_query($dbc, $query2) or redirect('500.php');
  if (mysqli_num_rows($result) == 0) {
    mysqli_query($dbc, $query) or redirect('500.php');
  }
  
  $user_full_name = get_user_full_name($dbc, $user_id);
  $first_name = $user_full_name['first_name'];
  $last_name = $user_full_name['last_name'];
  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  // Set page title
  $page_title = 'Addition of User Successful';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>User Successfully Added To Course</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php
      echo '<p>You have successfully added ';
      echo "<a href=\"course_page.php?course_id=$course_id\">";
      echo $name . ', ' . $semester . ' ' . $year . '</a> ';
      echo 'to <a href="usercourses.php">your courses</a>.</p>';
    ?>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


