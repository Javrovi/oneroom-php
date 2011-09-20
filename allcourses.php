<?php
  /* allcourses.php
   * --------------
   * allcourses.php is run when the user clicks on a link that accesses the
   * course index and displays a list of all the courses that have been created 
   * in OneRoom.
   *
   * Only logged-in users are allowed to see the course index.
   *
   * In the list of courses, if the user is already in the course (as either
   * a teacher or student), a link to the course page is displayed next to the
   * course.  If the user is not part of the course, a link to take or teach
   * the course is displayed next to the course.
   */
  
  // Initialize page
  require_once('init_page.php');
  
  // Set page title
  $page_title = 'All Courses';
  
  // Set main content heading file
  $content_heading = 'allcourses_heading.php';
  
  // Set main content body file
  $content_body = 'allcourses_body.php';
  
  // Render with 'base.php' template
  require_once('base.php');
  
  // Close page
  require_once('close_page.php');
?>

