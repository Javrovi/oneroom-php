<?php
  /* usercourses.php
   * ---------------
   * usercourses.php displays the courses that the logged-in user is taking
   * or taking.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions:  only logged in users can see their courses
  if (!$logged_in) {
    redirect('nopermissions.php');
  }
  
  // Set page title
  $page_title = 'Courses';
  
  // Get user's courses from database
  $user_course_ids = get_user_courses($dbc, $user_id, $is_teacher);
  
  // Get user's full name
  $user_full_name = get_user_full_name($dbc, $user_id);
  $first_name = $user_full_name['first_name'];
  $last_name = $user_full_name['last_name'];
  
  // Grab the course's full names and put them in an associative array;
  // the key is the course id
  $course_names = array();
  foreach ($user_course_ids as $course_id) {
    $course_full_name = get_course_full_name($dbc, $course_id);  
    $course_names[$course_id] = $course_full_name;
  }
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <?php
      echo '<h1>' . $first_name . ' ' . $last_name .'\'s Courses ';
      // Display a link to course creation script if the logged-in user is a teacher
      if ($is_teacher) {
        echo '<a class="paren-link" href="course_create.php">';
        echo '(create a new course)</a>';
      }
      echo '</h1>';
    ?>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <?php 
      // Iterate over the courses, printing each one out 
      if (count($user_course_ids) == 0) {
        // If user is not in any courses yet, print out a message.
        echo '<p>You are not yet part of any courses.</p>';
      } else {
        // Otherwise, print out a list of the user's courses
        
        // For each course in the array, grab detailed course info and display
        // The courses are displayed in an unordered list.
        echo '<ul>';
        foreach ($user_course_ids as $course_id) {
          $course_full_name = $course_names[$course_id];
          $name = $course_full_name['name'];
          $semester = $course_full_name['semester'];
          $year = $course_full_name['year'];
          
          // Display course info with link to course details page
          echo '<li>';
          echo "<a href=\"course_page.php?course_id=$course_id\">";
          echo $name . ', ' . $semester . ' ' . $year . '</a>';
            
          // If user is a student, display link to her grades in the course
          if (!$is_teacher) {
            echo "<a class=\"paren-link\" href=\"grades_page.php?course_id=$course_id&";
            echo "student_id=$user_id\"> (grades)</a>";
          }
            
          // Display link to remove self from course, passing course id and
          // user id as GET parameters
          echo '<a class="paren-link" href="course_remove_user.php?course_id=' .
                 $course_id . '&remove_user_id=' . $user_id . '">';
          echo ' (remove self from course)</a>';
          echo '</li>';  
        }
        echo '</ul>';
      }
    ?>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>