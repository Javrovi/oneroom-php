<?php
  session_start();
  echo '<h1>Hello! ' . $_SESSION['course_id'] . '</h1>';
?>