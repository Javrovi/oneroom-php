<?php
  /* course_page.php
   * ---------------
   * course_page.php displays course information for a course: teachers,
   * students, and assignments.
   */
  
  // Do preliminary setup
  require_once("init_page.php");
  
  // Set page title
  $course_id = $_GET['course_id'];
  
  // Get course's full name
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $name = $course_full_name['name'];
  $semester = $course_full_name['semester'];
  $year = $course_full_name['year'];
  
  $page_title = $name;
  
  // Set main content heading file
  $content_heading = 'course_page_heading.php';
  
  // Set main content body file
  $content_body = 'course_page_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
?>

