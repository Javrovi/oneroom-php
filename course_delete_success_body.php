<?php
  $query = "DELETE FROM courses WHERE course_id = '$course_id'"; 
  mysqli_query($dbc, $query)
    or die('Error querying database: ' . mysqli_error($dbc));
?>  
  <p>
    Your course has been deleted.
    Access <a href="usercourses.php">your other courses</a>
    or go back to the <a href="home.php">Home</a> page.
  </p>


