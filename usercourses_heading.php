<?php
  // Only logged in users can see their personal courses
  if ($logged_in) {  
    $user_full_name = get_user_full_name($dbc, $user_id);
    $first_name = $user_full_name['first_name'];
    $last_name = $user_full_name['last_name'];
    
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