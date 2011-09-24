<?php
  /* assignment_page.php
   * -------------------
   * assignment_page.php is accessed through a link on the course page
   * (course_page.php).  Each assignment has its own assignment page.
   * The assignment id is passed in as a GET parameter.
   *
   * On the assignment page itself, a list of students and their grades
   * for the assignment are displayed.  Note that student users will only
   * see their own grade.  Teacher users will see a list of all the students
   * and their grades and are provided with links to edit the grades.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Get assignment and course info
  $assignment_id = $_GET['assignment_id'];
  $assignment_info = get_assignment_info($dbc, $assignment_id);
  $name = $assignment_info['name'];
  $due_date = $assignment_info['due_date'];
  $month = $due_date['month'];
  $day = $due_date['day'];
  $year = $due_date['year'];
  
  $course_id = $assignment_info['course_id'];  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $course_semester = $course_full_name['semester'];
  $course_year = $course_full_name['year'];
  
  // Permissions: only users who are part of the course can see the assignment
  // page.
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
  
  // if we get here without being redirected, we're okay; continue with script
  
  // Get a list of all the students in the course if the user is a teacher;
  // Otherwise, simply grab the student in the course whose id is the user's
  // id.
  if ($is_teacher) {
    $query = "SELECT student_id FROM courses_students WHERE
              course_id = $course_id";
  } else {
    $query = "SELECT student_id FROM courses_students WHERE
              course_id = $course_id AND student_id = $user_id";
  }
  $result = mysqli_query($dbc, $query) or redirect('500.php');
  
  // For each student, get the full name of the student, and the student's
  // grade for the assignment
  $table_rows = array();
  while ($row = mysqli_fetch_array($result)) {
    $table_row = "";
    // Grab student's full name
    $student_id = $row['student_id'];
    $query = "SELECT first_name, last_name FROM oneroom_users
              WHERE id = $student_id";
    $result2 = mysqli_query($dbc, $query) or redirect('500.php');
    $row2 = mysqli_fetch_array($result2);
    $first_name = $row2['first_name'];
    $last_name = $row2['last_name'];
    $table_row .= "<tr><td>$first_name $last_name</td>";
    
    // Grab student's grade; if no grade is yet assigned, display 'Not Available'
    $query = "SELECT grade, grade_id
              FROM grades
              WHERE student_id=$student_id and assignment_id=$assignment_id";
    $result3 = mysqli_query($dbc, $query) or redirect('500.php');
    $table_row .= "<td>";
    if (mysqli_num_rows($result3) == 0) {
      // No grades have been assigned yet
      $table_row .= "Not Available";
    } else {
      $row3 = mysqli_fetch_array($result3);
      $grade = $row3['grade'];
      $grade_id = $row3['grade_id'];
      $table_row .= "$grade";
    }

    // If the user is a teacher, display link to edit grade
    if ($is_teacher) {
      $table_row .= "<a class=\"paren-link\"";
      $table_row .= "href=\"grade_edit.php?";
      $table_row .= "assignment_id=$assignment_id&course_id=$course_id";
      $table_row .= "&student_id=$student_id\"> (edit)";
    }
    $table_row .= "</td></tr>";
    array_push($table_rows, $table_row);
  }

  // Set page title
  $page_title = $course_name . ' ' . $name;
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <?php
      echo "<h1>";
      echo $name . "<br />";
      echo "<a class=\"paren-link\" href=\"course_page.php?course_id=$course_id\">";
      echo "$course_name, $course_semester $course_year</a><br />";
      // get rid of leading 0's in single-digit days in the due date
      $day = drop_leading_zero($day);
      echo "<span class=\"paren\">$month $day, $year</span>";
      echo "</h1>";
    ?>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <h4>Grades</h4>
    <table id="assignment_table" border="1">
      <tr>
        <th>Name</th>
        <th>Grade</th>
      </tr>
    <?php
      foreach ($table_rows as $table_row) {
        echo $table_row;
      }
    ?>
    </table>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>



  