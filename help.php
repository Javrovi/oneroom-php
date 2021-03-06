<?php
  /* help.php
   * ---------
   * help.php is OneRoom's help page.  This page describes the features of
   * OneRoom and provides example users for users to try out.
   */
  
  // PHP initialization (utility functions, session start, etc.)
  require_once('init_page.php');

  // Set page title
  $page_title = 'Help';
  
  // Display header
  require_once('oneroom_header.php');
?>

<!-- Content -->
<div id="content">
  <!-- Content heading -->
  <div id="content-heading">
    <h1>Help</h1>
  </div>
        
  <!-- Content body -->
  <div id="content-body">
    <p>
      OneRoom is a simple course management application. To get started,
      <a href="register.php">register</a> as a new user.  During the
      registration process, you'll be asked whether you're a Teacher or a
      Student.
    </p>
    
    <h3>Teachers</h3>
    <p>
      As a teacher, you can create courses, add assignments to your courses,
      and input grades for the students in your courses.
      <br /><br />
      When you create a course, you will be asked to enter a passcode for that
      course.
      <br /><br />
      You can sign yourself up to teach a course that was created by another
      teacher.
      When you do this, you will be asked to provide that course's passcode.
      <br /><br />
      All teachers for a course can add/edit assignments and input grades for that
      course.  Teachers can also remove students from their courses.
      <br /><br />
      However, teachers cannot add students to their courses.  It is the students'
      responsibility to sign up for courses.
      <br />
    </p>
    
    <h3>Students</h3>
    <p>
      As a student, you can sign up to study any course.  Note that teachers can
      remove students from their courses, so you may be removed from a course
      based on the course's teacher's acceptance criteria.
      <br /><br />
      Once you've signed up for a course, you can access that course's course
      web page, where you can view all your grades.
      <br />
    </p>
    
    <h3>Examples</h3>
    <p>
      OneRoom has a few examples courses and a few example users that you can
      play around with to get a feel for how OneRoom works.  There are two
      example teachers: John Smith (username: jsmith) and Jane Winthrop (username:
       jwin).  There are also two example students: Butter Fly (username: butterfly)
       and Cater Pillar (username: caterpillar).  The user passwords for all
       the example users are the same: "oneroom".  The course passcodes for all
       the example courses are the same: "1234".
       <br />
    </p>
    
    <h3>Questions?</h3>
    <p>
      Contact me <a href="http://yipingliao.weebly.com/contact.html">here</a>.
    </p>
  </div>
</div>

<?php
  // Display footer
  require_once('oneroom_footer.php');
  
  // PHP end-script (close MySQL connection)
  require_once('close_page.php');
?>

