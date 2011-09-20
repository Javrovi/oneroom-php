<?php
  // Only logged in teachers can edit courses
  if ($is_teacher) {
    if (isset($_POST['submit'])) {
      $course_id = $_SESSION['course_id'];
      $student_id = $_SESSION['student_id'];
      $course_grade_id = $_SESSION['course_grade_id'];
    } else {
      $student_id = $_GET['student_id'];
      $course_id = $_GET['course_id'];
    }
       
    // Get course name
    $course_full_name = get_course_full_name($dbc, $course_id);  
    $course_name = $course_full_name['name'];
    $course_semester = $course_full_name['semester'];
    $course_year = $course_full_name['year'];
    
    // Get student name
    $student_name = get_user_full_name($dbc, $student_id);
    $first_name = $student_name['first_name'];
    $last_name = $student_name['last_name'];
    
    // Check that the teacher is teaching the course
    $query = "SELECT * FROM courses_teachers WHERE
                course_id = '$course_id' and teacher_id = '$user_id'";
    $result = mysqli_query($dbc, $query);
    // if not, redirect
    if (mysqli_num_rows($result) == 0) {
      redirect('nopermissions.php');
    }
    
    // If we get here, we're ok
    echo '<h1>Edit Grade for ';
    echo "$first_name $last_name <br />";
    echo "<span class=\"paren\">";
    echo "($course_name, $course_semester $course_year)</span>";
    echo '</h1>';
  } else {
  // Redirect to a page informing the user that he doesn't have the permissions.
  redirect('nopermissions.php');
  }
?>