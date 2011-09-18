<table id="grades_table" border="1">
  <tr>
    <th>Assignment</th>
    <th>Grade</th>
  </tr>

<?php
  $query = "SELECT name, assignment_id FROM assignments WHERE
             course_id = $course_id";
  $result = mysqli_query($dbc, $query) or
              die('Error querying database: ' . mysqli_error($dbc));
  while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    echo "<tr><td>$name</td><td>";
    
    $assignment_id = $row['assignment_id'];
    $query2 = "SELECT grade FROM grades WHERE
               assignment_id = $assignment_id AND
               student_id = $student_id";
    $result2 = mysqli_query($dbc, $query2) or
                die('Error querying database: ' . mysqli_error($dbc));
    if (mysqli_num_rows($result2) == 0) {
      // No grades have been assigned yet
      echo "Not Available";
    } else {
      $row2 = mysqli_fetch_array($result2);
      $grade = $row2['grade'];
      echo "$grade";
    }
    echo "</td></tr>";
  }
?>
  
</table>
<br />

<!-- Course Grade -->
<?php
  $query = "SELECT grade FROM course_grades WHERE
            course_id = $course_id AND student_id = $student_id";
  $result = mysqli_query($dbc, $query) or
              die('Error querying database: ' . mysqli_error($dbc));
  if (mysqli_num_rows($result) == 0) {
      // No course grade has been assigned yet
      $course_grade = "Not Available";
  } else {
      $row = mysqli_fetch_array($result);
      $course_grade = $row['grade'];
  }
?>

<p>
  Course Grade: <span class="course_grade">
  <?php echo $course_grade; ?>
  </span>
</p>