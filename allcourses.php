<?php
  /* allcourses.php
   * --------------
   * allcourses.php is run when the user clicks on a link that accesses the
   * course index and displays a list of all the courses that have been created 
   * in OneRoom.
   *
   * Only logged-in users are allowed to see the course index.
   *
   * In the list of courses, if the user is already in the course (as either
   * a teacher or student), a link to the course page is displayed next to the
   * course.  If the user is not part of the course, a link to take or teach
   * the course is displayed next to the course.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions:   only logged in users can see the course index
  if (!$logged_in) {
    redirect('nopermissions.php');
  }
  
  // Set page title
  $page_title = 'All Courses';
  
  // Get user's courses from database
  $user_course_ids = get_user_courses($dbc, $user_id, $is_teacher);
   
  // Get all courses from the database
  $query = "SELECT course_id, name, semester, year FROM courses";
  $result = mysqli_query($dbc, $query) or redirect('500.php');
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <?php
      echo '<h1>All Courses ';
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
      if (mysqli_num_rows($result) == 0) {
        // If there are no courses yet, say so.
        echo '<p>There are no courses yet.</p>';
      } else {
        // For each course grab detailed course info and display;
        // The courses are displayed in an unordered list.
        echo '<ul>';
        while ($row = mysqli_fetch_array($result)) {
          $name = $row['name'];
          $semester = $row['semester'];
          $year = $row['year'];
          $course_id = $row['course_id'];
          
          // Display course info 
          echo '<li>';
          echo $name . ', ' . $semester . ' ' . $year;
            
          // If user is part of the course, display link to course details page
          if (in_array($course_id, $user_course_ids)) {
            echo '<a class="paren-link" ';
            echo "href=\"course_page.php?course_id=$course_id\">";
            echo ' (course web page)</a>';
            echo '</li>';
          } else {
            // display link to add user to course, passing course id and user
            // id as GET parameters
            echo '<a class="paren-link" href="course_add_user.php?course_id=' .
                 $course_id . '&user_id=' . $user_id . '">';
            if ($is_teacher) {
              echo ' (teach this course)';
            } else {
              echo ' (take this course)';
            }
            echo '</a></li>';
          }         
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
