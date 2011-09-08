
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
<h4>Assignments and Tests:</h4>
<?php
  $query = "SELECT name, assignment_id
            FROM assignments 
            WHERE course_id = '$course_id'";
  $result = mysqli_query($dbc, $query) or
              die('Error querying database: ' . mysqli_error($dbc));
  echo '<ul class="small_list">';
  while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    echo '<li>' . $name;
    if ($is_teacher) {
      echo '<a class="paren-link" href="#"> (edit)</a>';
      echo '<a class="paren-link" href="#"> (delete)</a>';
    }
  }
  echo '</ul>';
?>