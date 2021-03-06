<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>OneRoom Grade Tracker | <?php echo $page_title; ?></title>
    <link rel="stylesheet" href="stylesheets/style.css" type="text/css" />
    <?php if (isset($include_script)) {
            echo $include_script;
          }
    ?>
  </head>

  <body>
    <div id="main">
      <!-- Account navigation menu at the top right -->
      <div id="acct_nav">
        <?php if ($logged_in) { ?>
          <a href="acct_manage.php"><?php echo "$username"; ?>'s account</a> |
          <a href="logout.php">logout</a>
        <?php } else { ?>
          <a href="login.php">login</a> |
          <a href="register.php">register</a>
        <?php } ?>
      </div>
        
      <!-- Main navigation menu -->
      <div id="nav">
        <div id="app_name">
          <p>
            <a href="home.php">OneRoom</a>
          </p>
        </div>
        
        <div id="course_nav">
          <a href="home.php">home</a> |
          <?php if ($logged_in) { ?>
            <a href="allcourses.php">all courses</a> |
            <a href="usercourses.php">my courses</a> |
            <a href="search.php">search courses</a>
          <?php } ?>
        </div>
      </div>