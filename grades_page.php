<?php
  /* grades_page.php
   * ---------
   * grades_page.php displays in a table the grades for a student for a
   * particular course, including that student's course grade.  This page is
   * accessible to the student whose grades are displayed and to any teacher
   * of the course.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');
 
  // Get course and student info
  $course_id = $_GET['course_id'];  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $course_semester = $course_full_name['semester'];
  $course_year = $course_full_name['year'];
  
  $student_id = $_GET['student_id'];
  $student_name = get_user_full_name($dbc, $student_id);
  $first_name = $student_name['first_name'];
  $last_name = $student_name['last_name'];
  
  // Permissions: only the students whose grades are displayed and teachers
  // who are teaching the course in which the grades are displayed can view
  if (!$logged_in) {
    redirect('nopermissions.php');
  } else {
    if ($is_teacher) {
      // check that the teacher is teaching the class
      $query = "SELECT * FROM courses_teachers WHERE
                course_id = '$course_id' and teacher_id = '$user_id'";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
      if (mysqli_num_rows($result) == 0) {
        redirect('nopermissions.php');
      } 
    } else {
      // check if logged in user is the student whose grades
      // are requested in the GET request
      if ($user_id != $student_id) {
        redirect('nopermissions.php');
      }
    }
  }
  
  // If we get to this point without being redirected, we have
  // good permissions
  
  // Set page title
  $page_title = $course_name;
  
  // Get table rows
  $table_rows = array();
  $query = "SELECT name, assignment_id FROM assignments WHERE
             course_id = $course_id";
  $result = mysqli_query($dbc, $query) or redirect('500.php');
  while ($row = mysqli_fetch_array($result)) {
    $table_row = "";
    $name = $row['name'];
    $table_row .= "<tr><td>$name</td><td>";
    
    $assignment_id = $row['assignment_id'];
    $query2 = "SELECT grade FROM grades WHERE
               assignment_id = $assignment_id AND
               student_id = $student_id";
    $result2 = mysqli_query($dbc, $query2) or redirect('500.php');
    if (mysqli_num_rows($result2) == 0) {
      // No grades have been assigned yet
      $table_row .= "Not Available";
    } else {
      $row2 = mysqli_fetch_array($result2);
      $grade = $row2['grade'];
      $table_row .= "$grade";
    }
    $query3 = "SELECT teacher_id FROM courses_teachers WHERE
              course_id = $course_id AND teacher_id = $user_id";
    $result3 = mysqli_query($dbc, $query) or redirect('500.php');
    if (mysqli_num_rows($result3) == 1) {
      $table_row .= "<a class=\"paren-link\"";
      $table_row .= "href=\"grade_edit.php?";
      $table_row .= "assignment_id=$assignment_id&course_id=$course_id";
      $table_row .= "&student_id=$student_id\"> (edit)";
    }
    $table_row .= "</td></tr>";
    array_push($table_rows, $table_row);
  }
  
  // Get course grade
  $query = "SELECT grade FROM course_grades WHERE
            course_id = $course_id AND student_id = $student_id";
  $result = mysqli_query($dbc, $query) or redirect('500.php');
  if (mysqli_num_rows($result) == 0) {
      // No course grade has been assigned yet
      $course_grade = "Not Available";
  } else {
      $row = mysqli_fetch_array($result);
      $course_grade = $row['grade'];
  }
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <?php
      echo "<h1> Grades for $first_name $last_name <br />";
      echo "<a class=\"paren-link\" href=\"course_page.php?course_id=$course_id\">";
      echo "($course_name, $course_semester $course_year)</a></h1>";
    ?>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <!-- Grades for Assignments and Tests -->
    <table id="grades_table" border="1">
      <tr>
        <th>Assignment</th>
        <th>Grade</th>
      </tr>
      <?php
        foreach ($table_rows as $table_row) {
          echo $table_row;
        }
      ?> 
    </table>
    <br />
    
    <!-- Course Grade -->
    <p>
      Course Grade: <span class="course_grade"><?php echo $course_grade; ?></span>
      <?php
        if ($is_teacher) {
          echo "<a class=\"paren-link\"";
          echo "href=\"course_grade_edit.php?";
          echo "course_id=$course_id&student_id=$student_id\"> (edit)";
        }
      ?>
    </p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


