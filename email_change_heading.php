<?php
  if ($logged_in) {
    echo '<h1>User Account: Email Change</h1>';
  } else {
    redirect('nopermissions.php');
  }
?>