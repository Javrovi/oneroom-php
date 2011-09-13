<h4>Grades</h4>
<table id="assignment_table" border="1">
  <tr>
    <th>Name</th>
    <th>Grade</th>
  </tr>

<?php
  $query = "SELECT student_id FROM courses_students WHERE
             course_id = $course_id";
  $result = mysqli_query($dbc, $query) or
              die('Error querying database: ' . mysqli_error($dbc));
  while ($row = mysqli_fetch_array($result)) {
    $student_id = $row['student_id'];
    $query = "SELECT first_name, last_name
              FROM oneroom_users
              WHERE id = $student_id";
    $result2 = mysqli_query($dbc, $query) or
                die('Error querying database: ' . mysqli_error($dbc));
    $row2 = mysqli_fetch_array($result2);
    $first_name = $row2['first_name'];
    $last_name = $row2['last_name'];
    echo "<tr><td>$first_name $last_name</td>";
    $query = "SELECT grade, grade_id
              FROM grades
              WHERE student_id=$student_id and assignment_id=$assignment_id";
    $result3 = mysqli_query($dbc, $query) or
                die('Error querying database: ' . mysqli_error($dbc));
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
    $query = "SELECT teacher_id FROM courses_teachers WHERE
              course_id = $course_id";
    $result4 = mysqli_query($dbc, $query) or
              die('Error querying database: ' . mysqli_error($dbc));
    if (mysqli_num_rows($result4) == 1) {
      echo "<a class=\"paren-link\"";
      echo "href=\"grade_edit.php?";
      echo "assignment_id=$assignment_id&course_id=$course_id";
      echo "&student_id=$student_id\"> (edit)";
    }
    echo "</td></tr>";
  }
?>
  
</table>