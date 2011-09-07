<?php
  // Get the course id and the user id
  $course_id = $_SESSION['course_id'];
  $user_id = $_SESSION['user_id'];
 
  // Remove the relationship between the user and the course
  // in the courses_teachers or courses_students junction table
  if ($is_teacher) {
    $query = "DELETE FROM courses_teachers WHERE
              teacher_id = '$user_id' AND course_id = '$course_id'";
  } else {
    $query = "DELETE FROM courses_students WHERE
              student_id = '$user_id' AND course_id = '$course_id'";
  }
  mysqli_query($dbc, $query)
    or die('Error querying database: ' . mysqli_error($dbc));
  
  // For students only: remove assignment grades and course grades
  if (!$is_teacher) {  
    // Remove any assignment grades
    $query = "SELECT assignment_id FROM assignments WHERE
              course_id = '$course_id'";
    $result = mysqli_query($dbc, $query);
                
    $assignment_ids = array();
    while ($row = mysqli_fetch_array($result)) {
      array_push($assignment_ids, $row['assignment_id']);
    }
    
    foreach ($assignment_ids as $assignment_id) {
      $query = "DELETE FROM grades WHERE
                student_id = '$user_id' AND assignment_id = '$assignment_id'";
      mysqli_query($dbc, $query);
    }
    
    // Remove any course grades
    $query = "DELETE FROM course_grades WHERE
              student_id = '$user_id' AND course_id = '$course_id'";
    mysqli_query($dbc, $query);
  }
  
  $user_full_name = get_user_full_name($dbc, $user_id);
  $first_name = $user_full_name['first_name'];
  $last_name = $user_full_name['last_name'];
  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  echo '<p>You have successfully removed ';
  echo $first_name . ' ' . $last_name;
  echo ' from ' . $name . ', ' . $semester . ' ' . $year . '.</p>';
?>