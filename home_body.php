<?php if ($authenticated) { ?>
    <p>
        Click <a href="/oneroom/gradetracker/courses/">here</a>
        to access your courses.
    </p>
    <p>
        To see all courses, click on the
        <a href="/oneroom/gradetracker/courses/all/">course index</a>.
    </p>
<?php } else { ?>
    <p>
        Welcome anonymous user!
        You need to <a href="/oneroom/accounts/login/">login</a>
        before you can access your courses.
        (New users: please click <a href="/oneroom/accounts/register/">here</a>
         to register)
    </p>
<?php } ?>