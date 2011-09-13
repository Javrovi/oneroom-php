<?php
  // Set course id in $_SESSION for follow-up scripts
  $_SESSION['course_id'] = $course_id;
?>

<!-- List Teachers -->
<h4>Teacher(s):</h4>
<?php
  $query = "SELECT oneroom_users.first_name, oneroom_users.last_name
            FROM oneroom_users, courses_teachers 
            WHERE courses_teachers.course_id = '$course_id' AND
            oneroom_users.id = courses_teachers.teacher_id";
  $result = mysqli_query($dbc, $query) or
              die('Error querying database: ' . mysqli_error($dbc));
  echo '<ul class="small_list">';
  while ($row = mysqli_fetch_array($result)) {
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    echo '<li>' . $first_name . ' ' . $last_name;
  }
  echo '</ul>';
?>

<!-- List Students -->
<h4>Students:</h4>
<?php
  $query = "SELECT oneroom_users.first_name, oneroom_users.last_name,
            oneroom_users.id
            FROM oneroom_users, courses_students 
            WHERE courses_students.course_id = '$course_id' AND
            oneroom_users.id = courses_students.student_id";
  $result = mysqli_query($dbc, $query) or
              die('Error querying database: ' . mysqli_error($dbc));
  echo '<ul class="small_list">';
  while ($row = mysqli_fetch_array($result)) {
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    echo '<li>' . $first_name . ' ' . $last_name;
    if ($is_teacher) {
      echo '<a class="paren-link" href="#"> (grades)</a>';
      echo '<a class="paren-link" href="#"> (remove)</a>';
    }
  }
  echo '</ul>';
?>

<!-- List Assignments -->
<h4>
  Assignments and Tests:
  <?php if ($is_teacher) {
    ?>
    <a class="paren-link"
       href="assignment_create.php">(add a new assignment/test)</a>
  <?php }?>
</h4>
<?php
  $query = "SELECT name, assignment_id
            FROM assignments 
            WHERE course_id = '$course_id'";
  $result = mysqli_query($dbc, $query) or
              die('Error querying database: ' . mysqli_error($dbc));
  echo '<ul class="small_list">';
  while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    $assignment_id = $row['assignment_id'];
    echo '<li>';
    echo "<a href=\"assignment_page.php?assignment_id=$assignment_id\">$name</a>";
    if ($is_teacher) {
      $assignment_id = $row['assignment_id'];
      echo "<a class=\"paren-link\" href=\"assignment_edit.php?assignment_id=$assignment_id\">";
      echo " (edit)</a>";
      echo "<a class=\"paren-link\" href=\"assignment_delete.php?assignment_id=$assignment_id\">";
      echo ' (delete)</a>';
    }
  }
  echo '</ul>';
?>