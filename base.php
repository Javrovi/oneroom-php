<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>OneRoom Grade Tracker | <?php echo $page_title; ?></title>
    <link rel="stylesheet" href="stylesheets/style.css" type="text/css" />
  </head>
  
  <?php
    // Session management
    $authenticated = false; // dummy code
  ?>
    
  <body>
    <div id="main">
        <div id="acct_nav">
          <?php if ($authenticated) { ?>
            <a href="/oneroom/accounts/manage/">my account</a> |
            <a href="/oneroom/accounts/logout/">logout</a>
          <?php } else { ?>
            <a href="/oneroom/accounts/login/">login</a> |
            <a href="/oneroom/accounts/register/">register</a>
          <?php } ?>
        </div>
        
      <div id="nav">
        <div id="app_name">
          <p>
            <a href="/oneroom/gradetracker/">OneRoom</a>
          </p>
        </div>
        
        <div id="course_nav">
          <a href="/oneroom/gradetracker/">home</a> |
          <?php if ($authenticated) { ?>
            <a href="/oneroom/gradetracker/courses/all/">all courses</a> |
            <a href="/oneroom/gradetracker/courses/">my courses</a> |
            <a href="/oneroom/gradetracker/search/">search courses</a>
          <?php } ?>
        </div>
      </div>
      
      <div id="content">
        <div id="content-heading">
          <?php require_once($content_heading); ?>
        </div>
        
        <div id="content-body">
          <?php require_once($content_body); ?>
        </div>
      </div>
      
      <!-- to hide debug details, uncomment the 'display:none' line in
         style.css for #debug -->
      <div id="debug">
        <p>
          debug is on. :)
        </p>
      </div>
    </div>
    
    <div id="footer">
      <p>
        <a href="/oneroom/gradetracker/about/">About</a> |
        <a href="/oneroom/gradetracker/help/">Help</a> |
        &copy; 2011 Yiping Liao
      </p>
    </div>

  </body>
</html>
