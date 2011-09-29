<?php
  /* about.php
   * ---------
   * about.php displays information about the OneRoom application.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Set page title
  $page_title = 'About OneRoom';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>About OneRoom</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <p>
      OneRoom is a simple course management application that I wrote for my
      <a href="http://yipingliao.weebly.com">programming portfolio</a>
      in summer 2011.  This version of OneRoom is written
      using the <a href="http://en.wikipedia.org/wiki/LAMP_(software_bundle)">
      LAMP stack</a> (PHP and MySQL). There is another version of OneRoom
      written using the <a href="http://www.djangoproject.com">Django</a>
      web application framework. I coded OneRoom as a simple (but useful) web
      app that I can try out different frameworks with for comparison and
      contrast.  (You can check out the Django version
      <a href="http://yipingliao.webfactional.com/oneroom/">here</a>. It should look
      and feel exactly like this version.)
    </p>
    
    <h3>What does OneRoom do?</h3>
    <p>
      OneRoom is an application that allows teachers and students to track
      grades. Teachers can input grades for assignments and students can view
      their grades.  Users can also search for courses. For more details,
      please go to the <a href="help.php">Help</a> page.
    </p>
    
    <h3>What languages/frameworks/standards are used in OneRoom?</h3>
    <p>
      In this version of OneRoom, I used PHP as the server-side scripting
      language and MySQL as the backend database.  There is also a little
      bit of Ajax for the search function (the search is a live search).  I also
      used CSS for formatting the HTML pages.
    </p>
    
    <h3>What resources did you use in coding and designing OneRoom?</h3>
    <p>
      Besides the online resources, I also used:
    </p>
      <ul>
        <li><a class="italic" href="http://www.amazon.com/PHP-MySQL-Web-Development-4th/dp/0672329166/ref=sr_1_1?ie=UTF8&qid=1317165061&sr=8-1">PHP and MySQL Web Development</a>
            by Luke Welling and Laura Thomson
        </li>
        <li><a class="italic" href="http://www.amazon.com/Head-First-MySQL-Lynn-Beighley/dp/0596006306/ref=sr_1_1?s=books&ie=UTF8&qid=1317165130&sr=1-1">Head First PHP and MySQL</a>
            by Lynn Beighley and Michael Morrison
        </li>
        <li><a class="italic" href="http://www.amazon.com/CSS-Missing-David-Sawyer-McFarland/dp/0596802447/ref=sr_1_1?ie=UTF8&qid=1310079749&sr=8-1">CSS: the Missing Manual</a>
            by David McFarland
        </li>
        <li>The color scheme for OneRoom's web pages is based on the
            <a class="italic" href="http://www.colourlovers.com/palette/92095/Giant_Goldfish">
              Giant Goldfish</a> color palette.  It is the most "loved" palette
              on <a href="http://www.colourlovers.com/">ColourLovers</a>.
        </li>
      </ul>
    
    <h3>Where is the code for OneRoom?</h3>
    <p>
      Click <a href="http://github.com/yipingliao/oneroom-php">here</a> to go to
      OneRoom (PHP)'s repository on github.
    </p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>

