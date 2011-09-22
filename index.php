<?php
  $redirect_url = 'http://' . $_SERVER['HTTP_HOST'] .
                    dirname($_SERVER['PHP_SELF']) . '/' .
                    'home.php';
  header('Location: ' . $redirect_url);
?>