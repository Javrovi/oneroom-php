<?php 
  if ($logged_in) {
    echo '<h1>Account Successfully Updated</h1>';
  } else {
    redirect('nopermissions.php');
  }
?>