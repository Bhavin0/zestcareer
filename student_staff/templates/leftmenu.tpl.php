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

<?php
if ($_SESSION['eschools']['login_type']=="staff")
{ 
	$staff_permissions_arr = array();
	$staff_det = $db->getrow("SELECT * FROM es_staff WHERE es_staffid=".$_SESSION['eschools']['user_id']);
	$staff_TYPE = $staff_det["teach_nonteach"];
	$staff_permisions = $staff_det["st_permissions"];
	if($staff_permisions!="")
    {
	    $staff_permissions_arr = explode(",",$staff_permisions);
	}
?>

<ul class="nav nav-list">
    <li class="active">
        <a href="?pid=16&action=dashboard" class="dashboard">
            <i class="main-icon fa fa-tachometer"></i><span>Dashboard</span>
        </a>
    </li>

    <?php if (in_array('18_p', $top_level_permissions) ){?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon fa fa-check-square"></i> <span>Attendance</span>
        </a>
         <ul>
        <?php if($staff_TYPE =='teaching' && in_array('2', $staff_permissions_arr)){?>
            <li><a href="?pid=55&action=stud_attend">Student Attendance</a></li>
            <li><a href="?pid=55&action=attendancesheets">Attendancesheets</a></li>
        <?php }?>
        </ul>
    </li>
    <?php }?>

    <?php if (in_array('17_p', $top_level_permissions) && $staff_TYPE =='teaching' ){?>
      <li id="dd-12">
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-documents"></i><span>Examination</span>
        </a>
        <ul>
          <li><a href="?pid=17&action=examreport">Enter Marks</a></li> 
          <li>
            <a href="#">
              <i class="fa fa-menu-arrow pull-right"></i>
              Extra Activities
            </a>
            <ul>
              <li>
                <a href="?pid=17&action=coscholastic">Enter Marks</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    <?php }?>

    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-edit"></i><span>Class Tests</span>
        </a>
        <ul>
            <li><a href="?pid=59&action=start_test">Start Test</a></li>
            <li><a href="?pid=59&action=view_tests">View Test</a></li>
        </ul>
    </li>

    <?php
    $t_id = "SELECT teachers_id FROM new_survey_teacher_group WHERE head_teacher_id=".$_SESSION['eschools']['user_id'];
    $result =mysql_query($t_id);
    $count = mysql_num_rows($result);
    if($count >= 1) {
    ?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon glyphicon glyphicon-stats"></i><span>Evaluation Form</span>
        </a>
        <ul>
            <li><a href="?pid=60&action=new_survey">Weekly Survey</a></li>
            <li><a href="?pid=60&action=monthly_survey">Monthly Survey</a></li>
            <li><a href="?pid=60&action=survey_list">View Surveys</a></li>
        </ul>
    </li>
    <?php }?>

    <li class="active">
        <a href="?pid=63&action=planners">
            <i class="main-icon fa fa-tasks"></i><span>Planner</span>
        </a>
    </li>

    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon fa fa-user-secret"></i>
            <span>Student Violations</span>
        </a>
        <ul>
            <li><a href="?pid=62&action=add_incedent">Add Incident</a></li>
            <li><a href="?pid=62&action=view_incedents">View Incidents</a></li>
        </ul>
    </li>

    <?php if(in_array('14_p', $top_level_permissions)){?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon fa fa-bus"></i><span>Transport</span>
        </a>
        <ul>
            <li><a href="?pid=46&action=mydetails">My Route/Board Details</a></li>
            <li><a href="?pid=43&action=alldetails">View All Routes/Boards</a></li>
        </ul>
    </li>               
    <?php }?>

    <?php if (in_array('15_p', $top_level_permissions) && $staff_TYPE =='teaching'){?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-clock"></i><span>Time Table</span>
        </a>
        <ul>
            <li><a href="?pid=52&action=timetable">Class wise timetables</a></li>
            <li><a href="?pid=54&action=staff">Staff wise timetables</a></li>
            <li><a href="#" onclick="window.open('?pid=54&action=free_staff')">Free Staff Time Table</a></li>
        </ul>
    </li>
    <?php }?>

    <?php if (in_array('15_p', $top_level_permissions) && $staff_TYPE =='teaching'){?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon fa fa-tags"></i><span>Inventory</span>
        </a>
        <ul>
            <li><a href="?pid=61&action=purchase_request">Goods Issue Request</a></li>
            <li><a href="?pid=61&action=view">View Status</a></li>
        </ul>
    </li>
    <?php }?>

    <?php if(in_array('11_p', $top_level_permissions)){?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon fa fa-inr"></i><span>Salary</span>
        </a>
        <ul>                         
            <li><a href="?pid=20&action=viewsalary">View Salary</a></li>
            <li><a href="?pid=20&action=loanissueslist">View Loan</a></li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-calendar"></i><span>Leaves</span>
        </a>
        <ul>
            <li><a href="?pid=24&action=Leave">Annual Leaves</a></li>
            <li><a href="?pid=24&action=leave_request">Leave Request</a></li>
        </ul>
    </li>
    <?php }?>

    <?php if (in_array('7_p', $top_level_permissions) && $staff_TYPE =='teaching' && in_array('1', $staff_permissions_arr) ){?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-book-open"></i><span>Assignment</span>
        </a>
        <ul>                                                
            <li><a href="?pid=21&action=add_assignment">Add Assignment</a></li>
            <li><a href="?pid=21&action=view_assignment">View Assignment</a></li>
        </ul>
    </li>               
    <?php }?>

    <?php if (in_array('8_p', $top_level_permissions) && $staff_TYPE =='teaching'){?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon glyphicon glyphicon-book"></i><span>Study Material</span>
        </a>
        <ul>                                                                        
            <li><a href="?pid=36&action=add_material">Add&nbsp;Material</a></li>
            <li><a href="?pid=36&action=view_material">View&nbsp;Material</a></li>
            
        </ul>
    </li>
    <?php }?>

    <?php if (in_array('22_p', $top_level_permissions) ){ ?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon fa fa-exclamation-triangle"></i><span> Message</span>
        </a>
        <ul> 
            <li><a href="?pid=31&action=compose">compose</a></li> 
            <li><a href="?pid=31&action=sent_student_message">student Message</a></li>
            <li><a href="?pid=31&action=sentmails">Sent message</a></li>
        </ul>
    </li>
    <?php } ?>

    <!-- <?php if (in_array('20_p', $top_level_permissions)  ){ ?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon fa fa-envelope"></i><span>Message</span>
        </a>
        <ul>                                                                              
            <li><a href="?pid=28&action=mails_received">Message Inbox</a></li>
            <li><a href="?pid=28&action=sentmails">Sent Messages</a></li>
            <li>
                <a href="#">
                    <i class="fa fa-menu-arrow pull-right"></i>
                    Compose Message
                </a>
                <ul>
                    <li><a href="?pid=28&action=mailtoadmin">To Admin</a></li>
                    <li><a href="?pid=28&action=mailtostaff">To Staff</a></li>
                    <li><a href="?pid=28&action=mailtostudents">To Students</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <?php }?> -->

    <?php if (in_array('30_p', $top_level_permissions) ){ ?>
    <li>
        <a href="#">
            <i class="fa fa-menu-arrow pull-right"></i>
            <i class="main-icon et-newspaper"></i><span>Knowledge Base </span>
        </a>
        <ul>                        
            <li><a href="?pid=18&action=know_category">Create Category</a></li>
            <li><a href="?pid=18&action=know_categ">Search Articles</a></li>
        </ul>
    </li>
    <?php }?>

    <?php if (in_array('27_p', $top_level_permissions) ){ ?>
    <li>
        <a href="?pid=29&action=holidayslist">
            <i class="main-icon fa fa-thumbs-up"></i><span> Holidays</span>
        </a>
    </li>
    <?php }?>

    <?php if (in_array('31_p', $top_level_permissions) ){ ?>
    <li>
        <a href="?pid=33&action=noticeboard">
            <i class="main-icon fa fa-clipboard"></i><span>Notice Board</span>
        </a>
    </li>
    <?php }?>
</ul>

<?php  } ?>
    
</nav>

<span id="asidebg"></span>

</aside>