<!-- Search Query Input Form -->
<!-- Note: this form submission is via GET -->
  <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="search_query">enter a keyword:</label>
    <input type="text" id="search_query" name="search_query" /><br />

    <!-- Submission -->
    <input type="submit" value="search" id="submit" name="submit" />
  </form>
  
<?php
  $show_results = false;
  
  if (isset($_GET['search_query'])) {
    $show_results = true;
    
    // Grab search term from the query
    $search_query = mysqli_real_escape_string($dbc, trim($_GET['search_query']));
    
    
    // Search the DB
    $query = "SELECT course_id, name, semester, year FROM courses
              WHERE name LIKE '%$search_query%'";
    $result = mysqli_query($dbc, $query)
      or die('Error querying database: ' . mysqli_error($dbc));
  }

  if ($show_results) {
    // List the results
    echo '<ul>';
    while ($row = mysqli_fetch_array($result)) {
      $name = $row['name'];
      $semester = $row['semester'];
      $year = $row['year'];
      $course_id = $row['course_id'];
      
      // Display course info, including link to the course web page
      echo '<li>';
      echo $name . ', ' . $semester . ' ' . $year;
      echo '<a class="paren-link" ';
      echo "href=\"course_page.php?course_id=$course_id\">";
      echo ' (course web page)</a>';
      echo '</li>';
    }
    echo '</ul>';
  }
?>