<?php
  /* course_page.php
   * ---------------
   * course_page.php displays course information for a course: teachers,
   * students, and assignments.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Get course's full name
  $course_id = $_GET['course_id'];
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];

  // Permissions: only users who are teaching or taking the course can
  // see the course page.
  if (!$logged_in) {
    redirect('nopermissions.php');
  } else {
    if ($is_teacher) {
      // for teachers, check that the logged in user is teaching the course
      $query = "SELECT * FROM courses_teachers WHERE
                course_id = '$course_id' and teacher_id = '$user_id'";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
      
      // if the teacher is not teaching the course, redirect
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      }
    } else {
      // for students, check that the logged in user is a student in the course
      $query = "SELECT * FROM courses_students WHERE
                course_id = '$course_id' and student_id = '$user_id'";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
      
      // if the student is not in the course, redirect
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      }
    }
  }
  
  // If we get here without being redirected, we're okay; proceed
  
  // Set course id in $_SESSION for follow-up scripts
  $_SESSION['course_id'] = $course_id;
  
  // Get list of teacher info
  $query = "SELECT oneroom_users.first_name, oneroom_users.last_name
            FROM oneroom_users, courses_teachers 
            WHERE courses_teachers.course_id = '$course_id' AND
            oneroom_users.id = courses_teachers.teacher_id";
  $result = mysqli_query($dbc, $query) or redirect('500.php');

  $teacher_list_items = array();
  while ($row = mysqli_fetch_array($result)) {
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    array_push($teacher_list_items,
               '<li>' . $first_name . ' ' . $last_name . '</li>');
  }

  // Get list of student info
  $query = "SELECT oneroom_users.first_name, oneroom_users.last_name,
            oneroom_users.id
            FROM oneroom_users, courses_students 
            WHERE courses_students.course_id = '$course_id' AND
            oneroom_users.id = courses_students.student_id";
  $result = mysqli_query($dbc, $query) or redirect('500.php');
 
  $student_list_items = array();
  while ($row = mysqli_fetch_array($result)) {
    $student_list_item = "";
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $student_id = $row['id'];
    $student_list_item .= '<li>' . $first_name . ' ' . $last_name;
    // teachers are provided with links to the student's grades and to
    // student-removal scripts
    if ($is_teacher) {
      $student_list_item .= "<a class=\"paren-link\" href=\"grades_page.php?course_id=$course_id&";
      $student_list_item .= "student_id=$student_id\"> (grades)</a>";
      $student_list_item .= '<a class="paren-link" href="course_remove_user.php?course_id=' .
             $course_id . '&remove_user_id=' . $student_id . '">';
      $student_list_item .= ' (remove)</a>';
    }
    $student_list_item .= "</li>";
    array_push($student_list_items, $student_list_item);
  }

  // Get list of assignment info
  $query = "SELECT name, assignment_id
            FROM assignments 
            WHERE course_id = '$course_id'";
  $result = mysqli_query($dbc, $query) or redirect('500.php');
  
  $assignment_list_items = array();
  while ($row = mysqli_fetch_array($result)) {
    $assignment_list_item = "";
    $name = $row['name'];
    $assignment_id = $row['assignment_id'];
    $assignment_list_item .= '<li>';
    $assignment_list_item .= "<a href=\"assignment_page.php?assignment_id=$assignment_id\">$name</a>";
    // teachers are provided with links to edit and delete assignments
    if ($is_teacher) {
      $assignment_id = $row['assignment_id'];
      $assignment_list_item .= "<a class=\"paren-link\" href=\"assignment_edit.php?assignment_id=$assignment_id\">";
      $assignment_list_item .= " (edit)</a>";
      $assignment_list_item .= "<a class=\"paren-link\" href=\"assignment_delete.php?assignment_id=$assignment_id\">";
      $assignment_list_item .= ' (delete)</a>';
    }
    $assignment_list_item .= "</li>";
    array_push($assignment_list_items, $assignment_list_item);
  }
 
  // Set page title
  $page_title = $course_name;
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <?php
      echo "<h1>$course_name, $semester $year</h1>";
      
      if ($is_teacher) {        
        // teachers can edit or delete courses
        echo "<h2><a href=\"course_edit.php?course_id=$course_id\">";
        echo "(edit course)</a>";
        echo "<a href=\"course_delete.php?course_id=$course_id\">";
        echo '(delete course)</a></h2>';
      } else {
        // students are provided with a link to their grades for the course
        echo '<h2>';
        echo "<a class=\"paren-link\" href=\"grades_page.php?course_id=$course_id&";
        echo "student_id=$user_id\"> (my grades)</a>";
        echo "</h2>";
      }
    ?>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <!-- List Teachers -->
    <h4>Teacher(s):</h4>
    <ul class="small_list">
      <?php
        foreach ($teacher_list_items as $teacher_list_item) {
          echo $teacher_list_item;
        }
      ?>
    </ul>
    
    
    <!-- List Students -->
    <h4>Students:</h4>
    <ul class="small_list">
      <?php
        foreach ($student_list_items as $student_list_item) {
          echo $student_list_item;
        }
      ?>
    </ul>    
    
    <!-- List Assignments -->
    <h4>
      Assignments and Tests:
      <!-- teachers can create assignments -->
      <?php if ($is_teacher) { ?>
        <a class="paren-link"
          href="assignment_create.php">(add a new assignment/test)</a>
      <?php } ?>
    </h4>
    <ul class="small_list">
      <?php
        foreach ($assignment_list_items as $assignment_list_item) {
          echo $assignment_list_item;
        }
      ?>
    </ul>    
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>
 


