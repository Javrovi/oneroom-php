<?php
  /* search.php
   * ----------
   * search.php allows the user to search courses.  If Ajax is supported,
   * the search request is processed via Ajax.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Permissions:   only logged in users can see the course index
  if (!$logged_in) {
    redirect('nopermissions.php');
  }
  
  // Perform search:
  $results_html = "";
  if (isset($_GET['search_query'])) {
    // Grab search term from the query
    $search_query = mysqli_real_escape_string($dbc, trim($_GET['search_query']));
    
    // Search the DB if query is not empty
    if (!empty($search_query)) {
      $query = "SELECT course_id, name, semester, year FROM courses
                WHERE name LIKE '%$search_query%'";
      $result = mysqli_query($dbc, $query) or redirect('500.php');
    
      $results_html .= '<ul>';
      while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $semester = $row['semester'];
        $year = $row['year'];
        $course_id = $row['course_id'];
        
        // Display course info, including link to the course web page
        $results_html .= '<li>';
        $results_html .= $name . ', ' . $semester . ' ' . $year;
        $results_html .= '<a class="paren-link" ';
        $results_html .= "href=\"course_page.php?course_id=$course_id\">";
        $results_html .= ' (course web page)</a>';
        $results_html .= '</li>';
      }
      $results_html .= '</ul>';
    }
  }
  
  // If Ajax, just output the results and exit
  if (isset($_GET['ajax'])) {
    echo $results_html;
    exit();
  }
      
  // Set Javascript file
  $include_script =
    '<script src="scripts/search.js" type="text/javascript"></script>';
  
  // Set page title
  $page_title = 'Search Courses';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Search for courses</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <!-- Search Query Input Form (note: this form submission is via GET) -->
    <form method="GET" id="search_form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="search_query">enter a keyword:</label>
      <input type="text" id="search_query" name="search_query" /><br />
  
      <!-- Submission -->
      <input type="submit" value="search" id="submit" name="submit" />
    </form>
  
    <div id="search_results">
      <?php echo $results_html; ?>
    </div>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>


