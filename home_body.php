<?php if (isset($_SESSION['user_id'])) { ?>
  <p>
    Click <a href="usercourses.php">here</a> to access your courses.
  </p>
  <p>
    To see all courses, click on the <a href="allcourses.php">course index</a>.
  </p>
<?php } else { ?>
  <p>
    Welcome anonymous user!
    You need to <a href="login.php">login</a> before you can access your
    courses. (New users: please click <a href="register.php">here</a>
    to register)
  </p>
<?php } ?>