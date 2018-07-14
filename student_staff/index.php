<?php
ob_start();
session_start();
   error_reporting(0);

	$path_arr = explode('/', $_SERVER['PHP_SELF']);
	$cur_foldpath =  count($path_arr)-3;
	if(isset($_SESSION['eschools']['superadmin_school']) && $_SESSION['eschools']['superadmin_school']!=$path_arr[$cur_foldpath]){
		header("Location: ../index.php?emsg=15");
		exit;
	}
	
	if (!defined('FROMINDEX')) {
		define('FROMINDEX', true);
	}

	if (!defined('DS')) {
		define('DS', '/');
	}	
	include ('includes/config.inc.php');
	//class
	function __autoload($class_name) {
		include_once INCLUDES_CLASS_PATH . DS . "class." . $class_name . '.php';
	}
	
	include (INCLUDES_CLASS_PATH . DS .'developer.mysql.class.php');
	include (INCLUDES_CLASS_PATH . DS . 'validation.class.php');
	include (INCLUDES_CLASS_PATH . DS . 'html_form.class.php');
	//files
	include (INCLUDES_PATH . DS .'messages.inc.php');
	include (INCLUDES_PATH . DS . 'functions.inc.php');
		
	sm_registerglobal('pid', 'admin', 'action', 'set_color');
/**
* Creation of database object for  class developer_db [developer.mysql.class.php file]
*/
	$db = new developer_db();
/**
* Meta keywords list
*/
	$meta_keywords    = "";
	$meta_description = "";

	/// List of processes
	$arr_pages = array (
				0=> array (
							'action' => 'default.inc',
							'view'   => 'default.tpl',
							'title'  => 'Default Page'
								),
				1=> array (
							'action' => 'stafflogin.inc',
							'view'   => 'stafflogin.tpl',
							'title'  => 'Staff Sign up'
							    ),
				2=> array (
							'action' => 'myprofile.inc',
							'view'   => 'myprofile.tpl',
							'title'  => 'My Profile'
							),
				3=> array (
							'action' => 'attendance.inc',
							'view'   => 'attendance.tpl',
							'title'  => 'Attendance'
							),
				4=> array (
							'action' => 'knowledge_base.inc',
							'view'   => 'knowledge_base.tpl',
							'title'  => 'Knowledge Base'
							),
				5=> array (
							'action' => 'changepassword.inc',
							'view'   => 'changepassword.tpl',
							'title'  => 'Change Password'
							),
				6=> array (
							'action' => 'transport.inc',
							'view'   => 'transport.tpl',
							'title'  => 'Transport'
							),
				7=> array (
							'action' => 'themes.inc',
							'view'   => 'themes.tpl',
							'title'  => 'Themes'
							),
				8=> array (
							'action' => 'help.inc',
							'view'   => 'help.tpl',
							'title'  => 'Help'
							),
				9=> array (
							'action' => 'logout.inc',
							'view'   => 'logout.tpl',
							'title'  => 'Logout'
							),
				10=> array (
							'action' => 'feedetails.inc',
							'view'   => 'feedetails.tpl',
							'title'  => 'Fee details '
							),
				11=> array (
							'action' => 'examination1.inc',
							'view'   => 'examination1.tpl',
							'title'  => 'Academic Examinations'
							),
				12=> array (
							'action' => 'assignment.inc',
							'view'   => 'assignment.tpl',
							'title'  => 'Assignment  Details'
							),
				13=> array (
							'action' => 'timetable.inc',
							'view'   => 'timetable.tpl',
							'title'  => 'Time Table'
							),
				14=> array (
							'action' => 'viewnotice.inc',
							'view'   => 'viewnotice.tpl',
							'title'  => 'viewnotice'
							),	
				15=> array (
							'action' => 'library.inc',
							'view'   => 'opec.tpl',
							'title'  => 'Notice'
							),
				16=> array (
							'action' => 'viewstaff.inc',
							'view'   => 'Dashboard/index',
							'title'  => 'Staff Details'
							),	
				17=> array (
							'action' => 'examination.inc',
							'view'   => 'Examination/examination.tpl'
						   ),
				18=> array (
							'action' => 'staff_knowledge_base.inc',
							'view'   => 'staff_knowledge_base.tpl',
							'title'  => 'Staff knowledge base'
							),	
				19=> array (
							'action' => 'staff_attendance.inc',
							'view'   => 'staff_attendance.tpl',
							'title'  => 'Staff Attendance'
						   ),
				20=> array (
							'action' => 'viewsalary.inc',
							'view'   => 'viewsalary.tpl',
							'title'  => 'Salary'
						   ),	
				21=> array (
							'action' => 'addassignment.inc',
							'view'   => 'Assignment/index'
						   ),
				22=> array (
							'action' => 'viewassignment.inc',
							'view'   => 'viewassignment.tpl',
							'title'  => 'Assignment'
						   ),
			    23=> array (
							'action' => 'stafftimetable.inc',
							'view'   => 'stafftimetable.tpl',
							'title'  => 'Time Table'
						   ),	
				24=> array (
							'action' => 'leave.inc',
							'view'   => 'Leaves/leave.tpl'
						   ),
			 	25=> array (
							'action'  => 'resignation.inc',
							'view'	  => 'resignation.tpl',
							'lablels' => 'resignation.lbl',
						    'title'	  => 'Resignation'
							),
				26=> array (
							'action' => 'viewassignment1.inc',
							'view'   => 'viewassignment1.tpl',
							'title'  => 'View Assignment'
				            ),	
				27=> array (
							'action' => 'sendmail.inc',
							'view'   => 'sendmail.tpl',
							'title'  => 'INTERNAL MESSAGING SYSTEM'
				            ),
				28=> array (
							'action' => 'staffsendmail.inc',
							'view'   => 'staffsendmail.tpl',
							'title'  => 'INTERNAL MESSAGING SYSTEM'
				            ),
				29=> array (
							'action' => 'holidays.inc',
							'view'   => 'Holiday/index',
							'title'  => 'Holidays'
				            ),
				30=> array (
							'action' => 'sendnotices.inc',
							'view'   => 'sendnotices.tpl',
							'title'  => 'Notice Management'
				            ),
				31=> array (
							'action' => 'sendstudentnotices.inc',
							'view'   => 'Send_notice/index',
							'title'  => 'Notice Management'
				            ),
				32=> array (
							'action' => 'videogalleries.inc',
							'view'   => 'videogalleries.tpl',
							'title'  => 'Video Gallery'
				            ),
				33=> array (
							'action' => 'notice.inc',
							'view'   => 'notice.tpl',
							'title'  => 'Notice Board'
				            ),
				34=> array (
							'action' => 'tutorials.inc',
							'view'   => 'tutorials.tpl',
							'title'  => 'Tutorials'
				            ),
				35=> array (
							'action' => 'booklets.inc',
							'view'   => 'booklets.tpl',
							'title'  => 'Booklets'
				            ),
				36=> array (
							'action' => 'staff_tutorials.inc',
							'view'   => 'Study_material/index',
							'title'  => 'Tutorials'
				            ),
				37=> array (
							'action' => 'staff_booklets.inc',
							'view'   => 'staff_booklets.tpl',
							'title'  => 'Booklets'
				            ),
				38=> array (
							'action' => 'ajaxdropdowns.inc',
							'view'   => 'ajaxdropdowns.tpl',
							'title'  => 'Ajax'
							),
				39=> array (
							'action' => 'staffquestions.inc',
							'view'   => 'staffquestions.tpl',
							'title'  => 'Question Bank Management'
							),
							
				40=> array (
							'action' => 'studentquestions.inc',
							'view'   => 'studentquestions.tpl',
							'title'  => 'Question Bank'
							),	
				41=> array (
							'action' => 'photogalleries.inc',
							'view'   => 'Photo-Gallery/index'
							)	,
				42=> array (
							'action' => 'trans_myrouteboard.inc',
							'view'   => 'trans_myrouteboard.tpl',
							'title'  => 'My Route/Board Details'
							),
				43=> array (
							'action' => 'trans_allrouteboard.inc',
							'view'   => 'trans_allrouteboard.tpl',
							'title'  => 'All Route/Board Details'
							),
				44=> array (
							'action' => 'library.inc',
							'view'   => 'library.tpl',
							'title'  => 'Library'
							),
				45=> array (
							'action' => 'timetable_staff.inc',
							'view'   => 'timetable_staff.tpl',
							'title'  => 'Staff Wise Timetable'
							),
				46=> array (
							'action' => 'trans_myrouteboard_staff.inc',
							'view'   => 'trans_myrouteboard_staff.tpl',
							'title'  => 'Staff Wise Timetable'
							),
				47=> array (
							'action' => 'hostel.inc',
							'view'   => 'hostel.tpl',
							'title'  => 'Hostel Management'
							),
				48=> array (
							'action' => 'hostel_staff.inc',
							'view'   => 'hostel_staff.tpl',
							'title'  => 'Hostel Management'
							),
				49=> array (
							'action' => 'addon.inc',
							'view'   => 'addon.tpl',
							'title'  => 'Addon Management'
							),
				50=> array (
						'action' => 'examination_new.inc',
						'view'   => 'examination_new.tpl',
						'title'  => 'Examinations'
					   ),
				51=> array (
							'action' => 'timetablestaff.inc',
							'view'   => 'timetablestaff.tpl',
							'title'  => 'Staff Wise Timetable'
							),				
							
				52=> array (
							'action' => 'timetablenew.inc',
							'view'   => 'timetablenew.tpl',
							'title'  => 'Timetable'
							),
				53=> array (
							'action' => 'examination.inc',
							'view'   => 'examination.tpl',
							'title'  => 'Examinations'
						   ),
				 54=> array (
						'action' => 'timetablestaff2.inc',
						'view'   => 'timetablestaff2.tpl',
						'title'  => 'Staff Wise Timetable'
						),
						
					55=> array (
							'action' => 'attendance_new.inc',
							'view'   => 'Attendance/index',
							'title'  => 'Attendance'
							),
					56=> array (
							'action' => 'staffattendance.inc',
							'view'   => 'staffattendance.tpl',
							'title'  => 'Staff Attendance'
						   ),
					57=> array (
							'action' => 'exam.inc',
							'view'   => 'exam.tpl',
							'title'  => 'Examinations'
						   ),
					58=> array (
							'action' => 'exam.inc',
							'view'   => 'exam.tpl',
							'title'  => 'Examinations'
						   ),
					59=> array (
							'action' => 'test.inc',
							'view'   => 'Tests/index'
						   ),
					60=> array (
							'action' => 'survey.inc',
							'view'   => 'survey.tpl',
							'title'  => 'Survey'
						   ),
					61=> array(
							'action' => 'inventory.inc',
							'view' => 'Inventory/inventory',
							'title' => 'Inventory'
						),
					62=> array(
							'action' => 'student_violation.inc',
							'view' => 'Student_violation/index',
						),
					63=> array(
							'action' => 'planner.inc',
							'view' => 'Planner/index',
						),
					64 => array(
							'action' => 'planner.inc',
							'view' => 'Planner/add_plan',
						),
														   							   
						);

	
	if (!isset($pid) || $pid >= count($arr_pages)) {
		$pid = 1;
	}
		// Including inc files ( PHP Coding files )
	if (file_exists(INCLUDES_PATH . DS . $arr_pages[$pid]['action'] . ".php"))
	{
		include(INCLUDES_PATH . DS . $arr_pages[$pid]['action'] . ".php");
		include INCLUDES_PATH . DS . $arr_pages[$pid]['action'] . ".php";
	}

	// set defualt $layout here
	switch ($pid) {
		
	case 0:
		$layout = "default";
		break;

	case 1:
		$layout = "stafflogin";
		break;	
	case 3:
	if($action=='printslip' || $action == 'print_class_report' || $action == 'print_staff_report' || $action =='print_stud_report' || $action == 'print_staffwise_report')
	{
		$layout = "print2";
	}else
	if($action == 'class_report_absent' || $action == 'class_report_absent_date') {
					$layout ="blank";
					}	
	else
	{
	    $layout = "index";
	}
	break;	
	
	case 4:
   	if ($action == 'print_category' || $action=='print_notices_det' || $action=='print_subcat') {
		$layout = "print2";
	}			
    else 
	{
	    $layout ="index";
	}
	break;	
		
	case 10 : 
	
	if($action=='printcompletefeedet' || $action=='print_student_details' || $action=='printpaid_balance' || $action=='print_fine_details'){$layout = "print2";}else
	{
	    $layout = "index";
	}	
	break;	
	
	
	case 12:
			if ($action=="viewassignment"){
				$layout = "blank";
			}elseif($action=='print_assignment')
	{
		$layout = "print2";
	}	else{
				$layout = "index";
			}		
	break;
	case 13:
	if($action=='printtimetable')
	{
		$layout = "print2";
	}	
	else
	{
	    $layout = "index";
	}
	break;	
	case 14:
		$layout = "blank";
		break;	
	case 15:
		$layout = "plain";
		break;	
	case 16:
		$layout = "main";
		break;	
		
	 case 17:
   	if ($action == 'mark_print') {
		$layout = "print2";
	}			
    else 
	{
	    $layout ="main";
	}
	break;	
	 case 18:
   	if ($action == 'print_category' || $action=='print_notices_det' || $action=='print_subcat' || $action=='print_search') {
		$layout = "print2";
	}			
    else 
	{
	    $layout ="index";
	}
	break;			
	case 19:
	if($action=='printslip' || $action == 'print_class_report' || $action == 'print_staff_report' || $action =='print_stud_report' || $action == 'print_staffwise_report')
	{
		$layout = "print2";
	}elseif($action == 'class_report_absent' || $action == 'class_report_absent_date' || $action == 'staff_report_absent'  || $action == 'staff_report_absent_date') {
					$layout ="blank";
					}	
	else
	{
	    $layout = "index";
	}
	break;
	case 20:
	if($action=='loanissueslist'){$layout="index_left";}elseif($action=='print_list' || $action=='print_salarylist' || $action=='print_loan'){$layout = "print2";}else{$layout = "index";}
	break;
	
	case 21:
	$layout = "main";
	break;
	case 23:
	if($action=='printtimetable' || $action=='print_class_timetable')
	{
		$layout = "print2";
	}	
	else
	{
	    $layout = "index";
	}
	break;
	case 24: $layout = "main";
	break;
	case 25:	
	if ($action == 'print_resignation' ) {
		$layout = "print2";
	}
	else
	{
	    $layout = "index";
	}
	break;
	case 26: $layout = "blank";
			break;	
	case 22:
		$layout = "blank";
		break;
  
	case 27: 
	if ($action=='fullmessage' || $action=="fullmessage_sent" || $action=="print_not_list" || $action=='print_reply_list'){
					$layout = "print2";
				} else 
	{
	    $layout ="index";
	}
		break;	
	case 28: 
	if ($action=='fullmessage' || $action=="fullmessage_sent" || $action=="print_not_list" || $action=='print_reply_list'){
					$layout = "print2";
				} else 
	{
	    $layout ="index";
	}
		break;	
	case 29: 
	
	    $layout ="main";
	
		break;
		
		case 30: 
				
	if ( $action=="fullmessage_sent" || $action=="print_not_list" || $action=='print_reply_list'||$action=='fullmessage' ){
					$layout = "print2";
				}
				elseif($action=='sentmails'){$layout="index_left";}
				 else 
	{
	    $layout ="index";
	}
		break;
		case 31: 
	$layout = "main";
	break;
		case 33: 
	 $layout = "main";
				
			
			
	      if ($action=='print_notices' || $action=="print"){
					$layout = "print2";
				} 
			break;	
		case 34: 
	if ($action=='print_list' || $action=="print_view"){
					$layout = "print2";
				} else 
	{
	    $layout ="index";
	}
		break;	
		case 35: 
	if ($action=='print_list' || $action=="print_view"){
					$layout = "print2";
				} else 
	{
	    $layout ="index";
	}
		break;
		case 36: 
	
	    $layout ="main";
	
		break;	
		case 37: 
	if ($action=='print_list' || $action=="print_view"){
					$layout = "print2";
				} else 
	{
	    $layout ="index";
	}
		break;
	case 38: 
	    $layout = "none";
		 break;	
		 case 39: 
	if ($action=='print_list' || $action=="print_view"){
					$layout = "print2";
				} else 
	{
	    $layout ="index";
	}
		break;
	case 40:
			if ($action=="viewfeedback"){
				$layout = "blank";
			}elseif ($action=="printresult"){
				$layout = "print2";
			}elseif ($action=="printresult1" || $action=='printresult'){
				$layout = "print2";
			}else{
				$layout = "index";
			}		
	break;	
	  case 41:
	  $layout = "main";
	 break;	
	 case 42:
 if($action=='print_tr_bills' || $action=='receipt' || $action=='print_tr_details')
	{
		$layout = "print2";
	}	
	else
	{
	    $layout = "index";
	}
	 break;	
	   case 44:
 if($action=='student_record_print' || $action=='faculty_record_print')
	{
		$layout = "print2";
	}	
	else
	{
	    $layout = "index";
	}
	 break;	
	case 45: 
	if ($action=="timetable")
		 {
			$layout = "index";
		}
		else{
	    $layout = "blank";
		}
		 break;	
		 case 46:
 if($action=='print_tr_bills' || $action=='receipt' || $action=='print_tr_details')
	{
		$layout = "print2";
	}	
	else
	{
	    $layout = "index";
	}
	
	if($action=='mydetails'){$layout="index_left";}
	 break;	
	 case 47:
 if($action=='person_allotment_details' || $action=='receipt' || $action=='print_list')
	{
		$layout = "print2";
	}	
	else
	{
	    $layout = "index";
	}
	 break;	
	  case 48:
 if($action=='person_allotment_details' || $action=='receipt' || $action=='print_list')
	{
		$layout = "print2";
	}	
	else
	{
	    $layout = "index";
	}
	 break;	
		
		case 51: if ($action=='viewtimetable' || $action=='staff_timetable' || $action=='free_staff' || $action=='edit_timetable') $layout = "blank";
		
			break;
		case 52: 
		if ($action=='timetable' || $action=='viewtimetable1' ) $layout = "index";
		if($action=='viewtimetableprint_time_table'){$layout = "print2";}
		
		if ($action=='edittimetable' || $action=='viewtimetable') $layout = "blank";
			break;
		case 53:  $layout = "index";
	if ($action=='createxam' ||$action=='createxamexport'||$action=='marksentry'||$action=='stdmarksentry'||$action=='allstudents'||$action=='allstudentsexport'||$action=='stud_report'||$action=='chatreports'||$action=='chatreports_schoolwise' ||$action=='classwiseviewresult') $layout = "index";
	if ($action == "stud_certificate" || $action == "stdmarksentryprint" || $action == "entermarksprint" || $action=='print_list_allstudents' || $action=='mark_print' ) $layout = "print2";
			break;	
			
	case 54: if ($action=='viewtimetable' || $action=='staff_timetable' || $action=='free_staff' || $action=='edit_timetable') $layout = "blank";
	if ($action=='staff' || $action=='time_table'  ) $layout = "index";
	if ($action=='edittimetable' || $action=='viewtimetable') $layout = "index";
	if ($action == "viewtimetable"  ) $layout = "print2";
	
		break;
			
			case 55: $layout ="main";

			break;
			case 56:
			if ($action=='timetable'||$action=='viewtimetable'   ) $layout = "index";
	if($action=='printslip' || $action == 'print_class_report' || $action == 'print_staff_report' || $action =='print_stud_report' || $action == 'print_staffwise_report')
	{
		$layout = "print2";
	}elseif($action == 'class_report_absent' || $action == 'class_report_absent_date' || $action == 'staff_report_absent'  || $action == 'staff_report_absent_date') {
					$layout ="blank";
					}	
	else
	{
	    $layout = "index";
	}
	
	break;
					
		 case 57:
   	if ($action == 'mark_print') {
		$layout = "print2";
	}			
    else 
	{
	    $layout ="index";
	}

	break;

	case 59:

	$layout = "main";

	break;

	case 61:

		$layout = "main";

	break;

	case 62:

		$layout = "main";		

	case 63:

		$layout = "main";

	case 64:

		$layout = "main";		
			
			
	default:
		if (!isset($layout) || !file_exists("templates/layouts/" . $layout . ".tpl.php"))
		 {
			$layout = "index";
		}
	}

	include( TEMPLATES_PATH . DS . 'layouts' . DS . $layout . ".tpl.php");
	
?>
