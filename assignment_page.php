<?php
  // Do preliminary setup
  require_once("init_page.php");
  
  // Set page title
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
  
  $page_title = $course_name . ' ' . $name;
  
  // Set main content heading file
  $content_heading = 'assignment_page_heading.php';
  
  // Set main content body file
  $content_body = 'assignment_page_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
?>

