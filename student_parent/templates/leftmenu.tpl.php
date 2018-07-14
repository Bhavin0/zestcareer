<?php 
    $edit_mod = $db->getRow("SELECT * FROM es_modules_alloted  WHERE id=1");
    $max_students=$edit_mod['max_no_students'];
    $max_courses=$edit_mod['max_no_courses'];
    $modules_permissions=$edit_mod['modules_permissions'];
    $top_level_permissions= explode(',', $modules_permissions);


?>

<div id="wrapper" class="clearfix">
    <aside id="aside">
        <nav id="sideNav">
        <?php if ($_SESSION['eschools']['login_type']=="student"){ ?>
            <ul class="nav nav-list">
                <li class="active">
                    <a href="?pid=2&action=dashboard" class="dashboard">
                        <i class="main-icon fa fa-tachometer"></i><span>Dashboard</span>
                    </a>
                </li>

                <?php if (in_array('18_p', $top_level_permissions) ){?>
                <li>
                    <a href="?pid=3&action=stud_report">
                        <i class="main-icon fa fa-check-square"></i><span>Attendance</span>
                    </a>
                </li>
                <?php }?>

                <?php if (in_array('7_p', $top_level_permissions) ){?>
                <li>
                    <a href="?pid=12&action=myassignment">
                        <i class="main-icon et-book-open"></i><span>Assignment</span>
                    </a>
                </li>
                <?php }?>

                <?php if (in_array('7_p', $top_level_permissions) ){?>
                <li>
                    <a href="?pid=62&action=test">
                        <i class="main-icon et-clipboard"></i><span>Test</span>
                    </a>
                </li>
                <?php }?>
                <?php if (in_array('7_p', $top_level_permissions) ){?>
                <li>
                    <a href="?pid=12&action=myassignment">
                        <i class="main-icon et-book-open"></i><span>Assignment</span>
                    </a>
                </li>
                <?php }?>

                <?php if (in_array('6_p', $top_level_permissions) ){?>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon et-printer"></i><span>Fee</span>
                    </a>
                    <ul>
                        <li><a href="?pid=10&action=viewfeedetails">View Fee Details</a></li>
                        <li><a href="?pid=10&action=finedetails">View Misc. Fines </a></li>
                    </ul>
                </li>

                <?php }?>

                <?php if (in_array('17_p', $top_level_permissions) ){?>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon et-documents"></i><span>Examination</span>
                    </a>
                    <ul>
                        <li><a href="?pid=53&action=student_exportexamd">Export Exam</a></li>
                        <li><a href="?pid=53&action=classwiseviewresult">View Result</a></li>
                    </ul>
                </li>
                <?php }?>

                <?php if (in_array('15_p', $top_level_permissions) ){?>
                <li>
                    <a href="?pid=52&action=viewtimetable1">
                        <i class="main-icon et-clock"></i><span>Time Table</span>
                    </a>
                </li>
                <?php }?>

                <?php if (in_array('8_p', $top_level_permissions) ){?>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon glyphicon glyphicon-book"></i><span>Study Material</span>
                    </a>
                    <ul>
                        <a href="?pid=34&action=mymaterial">
                        <i class="main-icon et-book-open"></i><span>Material</span>
                    </a>
                    </ul>
                </li>
                <?php }?>

                <?php if (in_array('14_p', $top_level_permissions) ){ ?>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-bus"></i><span>Transport</span>
                    </a>
                    <ul>
                        <li><a href="?pid=42&action=mydetails">My Route/Board Details</a></li>
                        <li><a href="?pid=43&action=alldetails">View All Routes/Boards</a></li>
                    </ul>
                </li>
                <?php }?>

                <?php if (in_array('22_p', $top_level_permissions) ){ ?>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-exclamation-triangle"></i><span>Notice</span>
                    </a>
                    <ul>
                        <li><a href="?pid=30&action=mails_received">Received Notices</a></li>
                        <li><a href="?pid=30&action=sentmails">Replied Notices</a></li>
                    </ul>
                </li>
                <?php }?>

                <?php if (in_array('20_p', $top_level_permissions) ){ ?>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-envelope"></i><span>Message</span>
                    </a>
                    <ul class="categoryitems">
                        <li><a href="?pid=27&action=mailbox">Message Inbox</a></li>
                       <!--  <li><a href="?pid=27&action=sentmails">Sent Messages</a></li>
                        <li><a href="?pid=27&action=mailtoadmin">Compose Message</a></li> -->
                    </ul>
                </li>
                <?php }?>
                

                <?php if (in_array('20_p', $top_level_permissions) ){ ?>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa-envelope"></i><span>Inventory</span>
                    </a>
                    <ul class="categoryitems">
                        <li><a href="?pid=27&action=mails_received">Message Inbox</a></li>
                        <li><a href="?pid=27&action=sentmails">Sent Messages</a></li>
                        <li><a href="?pid=27&action=mailtoadmin">Compose Message</a></li>
                    </ul>
                </li>
                <?php }?>

                <?php if (in_array('30_p', $top_level_permissions) ){ ?>
                <li>
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon et-newspaper"></i><span>Knowledge Base</span>
                    </a>
                    <ul>
                        <li><a href="?pid=4&action=know_categ">Search Articles</a></li>
                    </ul>
                </li>
                <?php }?>

                <?php if (in_array('27_p', $top_level_permissions) ){ ?>
                <li>
                    <a href="?pid=29&action=holidayslist">
                        <i class="main-icon fa fa-thumbs-up"></i><span>Holidays</span>
                    </a>
                </li>
                <?php }?>

                <?php if (in_array('35_p', $top_level_permissions) ){ ?>
                <li>
                    <a href="?pid=49">
                        <i class="main-icon fa fa-external-link"></i><span>Helpful Links</span>
                    </a>
                </li>
                <?php }?>

                <?php if (in_array('31_p', $top_level_permissions) ){ ?>
                <li>
                    <a href="?pid=33&action=noticeboard">
                        <i class="main-icon fa fa-clipboard"></i><span>Notice Board</span>
                    </a>
                </li>
            </ul>
        <?php }?>
    <?php } ?>

    
</nav>

<span id="asidebg"></span>

</aside>