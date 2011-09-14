<?php
  // Do preliminary setup
  require_once("init_page.php");
  
  // Set page title
  $course_id = $_GET['course_id'];  
  $course_full_name = get_course_full_name($dbc, $course_id);  
  $course_name = $course_full_name['name'];
  $course_semester = $course_full_name['semester'];
  $course_year = $course_full_name['year'];
  
  $student_id = $_GET['student_id'];
  $student_name = get_user_full_name($dbc, $student_id);
  $first_name = $student_name['first_name'];
  $last_name = $student_name['last_name'];
  
  $page_title = $course_name;
  
  // Set main content heading file
  $content_heading = 'grades_page_heading.php';
  
  // Set main content body file
  $content_body = 'grades_page_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
?>

