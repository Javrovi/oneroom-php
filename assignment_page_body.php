<!-- Assignment Grades Table Heading -->
<h4>Grades</h4>
<table id="assignment_table" border="1">
  <tr>
    <th>Name</th>
    <th>Grade</th>
  </tr>

<?php
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
  while ($row = mysqli_fetch_array($result)) {
    // Grab student's full name
    $student_id = $row['student_id'];
    $query = "SELECT first_name, last_name FROM oneroom_users
              WHERE id = $student_id";
    $result2 = mysqli_query($dbc, $query) or redirect('500.php');
    $row2 = mysqli_fetch_array($result2);
    $first_name = $row2['first_name'];
    $last_name = $row2['last_name'];
    echo "<tr><td>$first_name $last_name</td>";
    
    // Grab student's grade; if no grade is yet assigned, display 'Not Available'
    $query = "SELECT grade, grade_id
              FROM grades
              WHERE student_id=$student_id and assignment_id=$assignment_id";
    $result3 = mysqli_query($dbc, $query) or redirect('500.php');
    echo "<td>";
    if (mysqli_num_rows($result3) == 0) {
      // No grades have been assigned yet
      echo "Not Available";
    } else {
      $row3 = mysqli_fetch_array($result3);
      $grade = $row3['grade'];
      $grade_id = $row3['grade_id'];
      echo "$grade";
    }

    // If the user is a teacher, display link to edit grade
    if ($is_teacher) {
      echo "<a class=\"paren-link\"";
      echo "href=\"grade_edit.php?";
      echo "assignment_id=$assignment_id&course_id=$course_id";
      echo "&student_id=$student_id\"> (edit)";
    }
    echo "</td></tr>";
  }
?>
  
</table>