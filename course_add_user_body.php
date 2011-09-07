<?php
  // Get the course id and the user id
  $course_id = $_GET['course_id'];
  $user_id = $_GET['user_id'];
  
  // Get course's full name
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  echo '<p>Are you sure you want to ';
  if ($is_teacher) {
    echo 'teach ';
  } else {
    echo 'take ';
  }
  echo $name . ', ' . $semester . ' ' . $year . '?</p>';
  
  // Save course id for the php scripts that will actually add the user
  // Note that user_id is already a session variable
  $_SESSION['course_id'] = $course_id;
?>

<div id="cancel_confirm">
   <p>
    <a href="#">Cancel</a> |
    <a href="<?php if ($is_teacher) {
                      echo 'course_add_teacher.php';
                    } else {
                      echo 'course_add_user_success.php';
                    } ?>">Confirm</a>
  </p>
</div>
  