<?php 
/**
* Only Admin users can view the pages 
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
		header('location: ./?pid=1&unauth=0');
		exit;
}
	sm_registerglobal('pid', 'action', 'emsg', 
	  'update', 'fid', 'submit', 
	  'fee_amount', 
	  'admin', 
	  'fee_class', 
	  'fee_instalments',
	  'as_sec',
	  'as_lastdate',
	  'as_name',
	  'as_description', 
	  'Submit',
	  'as_createdon',
	  'as_lastdate',
	  'update',
	  'es_assid',
	  'back', 
	  'particulars',
	  'groups',
	  'selectclass',
	  'amount',
	  'instalments',
	  'updatefeeitem',
	  'newparticular',
	  'newamount',
	  'newinstalment',
	  'periodSubmit',
	  'at_no_periods',
	  'at_day',
	  'uid',
	  'stud_attend_Submit',
	  'at_std_class',
	  'at_std_group',
	  'at_std_class',
	  'at_attendance_date',
	  'at_std_subject',
	  'at_std_period',
	  'at_period_from',
	  'at_period_to',
	  'at_reg_no',
	  'at_stud_name',
	  'at_attendance',
	  'at_remarks',
	  'at_staff_dept',
	  'staff_attend_Submit',
	  'at_staff_date',
	  'at_staff_id',
	  'at_staff_name',
	  'at_staff_desig',
	  'at_staff_attend',
	  'at_staff_remarks',
	  'at_time_in',
	  'at_time_out',
	  'at_std_class_report',
	  'at_staff_dept1',
	  'at_std_wise_class_report',
	  'at_stdregno',
	  'student_report_submit',
	  'at_std_wise_name',
	  'dc1',
	  'dc2',
	  'at_staffwise_dept',
	  'at_staffid',
	  'at_staff_wise_name',
	  'staffwise_report_submit',
	  'class_student_report_submit',
	  'attend_staff_report_date_submit',
	  'from',
	  'to',
	  'print_staffwise_report',
	  'caid',
	  'school_year',
	  'pre_year',
	  'sabf',
	  'sabt',
	  'cadf',
	  'cadt',
	  'pcf',
	  'pct',
	  'psf',
	  'pst','es_post','stud_editattend_Submit','stud_updateattend_Submit','studentnamelist1','staff_editattend_Submit','staff_updateattend_Submit','classid','school_year2',
	  'dn_reg_no', 'dn_search_student', 'dn_classesid', 'sem_progress', 'sem_improvement', 'dn_save', 'dn_print', 'dn_reg_no_tbl'
	  );


   if($_GET['action']=='stud_attend' && (isset($_POST['submit']) || isset($_POST['submit_and_send_sms'])))
	{
		$query = "INSERT INTO `student_attendance`(`academic_year_id`, `attendance_date`, `standard_id`, `division_id`, `teacher_id`) VALUES (
					'".$_POST['academic_year']."',
					'".$_POST['attendance_date']."',
					'".$_POST['es_classesid']."',
					'".$_POST['division_id']."',
					'".$_POST['teacher_id']."')";

		mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));

		$attendance_id = mysqli_insert_id($mysqli_con);

		$section_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT school_name FROM es_groups WHERE es_groupsid=(SELECT es_groupid FROM es_classes WHERE es_classesid=".$_POST['es_classesid'].")"));

		for($i=0; $i<count($_POST['student_id']);$i++)
		{
			$query = "INSERT INTO `attendancesheet`(`attendance_id`, `studentid`, `attendance`, `remarks`) VALUES 
						('".$attendance_id."',
						'".$_POST['student_id'][$i]."',
						'".$_POST['attendance'][$i]."',
						'".$_POST['remarks'][$i]."')";

			mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
		}
		header('Location: ?pid=140&action=stud_attend_report&attendance_id='.$attendance_id);
		exit;
	}

	if($_GET['action']=='attendancesheet_edit' && (isset($_POST['submit']) || isset($_POST['submit_and_send_sms'])))
	{
		for($i=0; $i<count($_POST['attendance_key']);$i++)
		{
			$query = "UPDATE `attendancesheet` SET 
							`attendance`='".$_POST['attendance'][$i]."',
							`remarks`='".$_POST['remarks'][$i]."' 
												WHERE 
							`attendance_key`='".$_POST['attendance_key'][$i]."'";

			mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));

			$section_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT school_name FROM es_groups WHERE es_groupsid=(SELECT es_groupid FROM es_classes WHERE es_classesid=".$_POST['es_classesid'].")"));

			
		}
		header('Location: ?pid=140&action=stud_attend_report&attendance_id='.$_GET['attendance_id']);
		exit;
	}
	 

if(!isset($school_year)  ) {



	$from_acad = $_SESSION['eschools']['from_acad'];
	$to_acad   = $_SESSION['eschools']['to_acad'];
}
else {

 if (($at_std_class_report)==""){
		$errormessage[0]="Select Class"; 	
	 }
	 if (count($errormessage)==0){
 $academic_res = getarrayassoc("SELECT * FROM `es_finance_master` WHERE `es_finance_masterid`= $pre_year");
		$from_acad = $academic_res['fi_ac_startdate'];
		$to_acad   = $academic_res['fi_ac_enddate'];
}}

$school_details_sel = "SELECT * FROM `es_finance_master` ORDER BY `es_finance_masterid` DESC";
$school_details_res = getamultiassoc($school_details_sel);
$es_attend_student = new es_attend_student();
$es_attend_staff = new es_attend_staff();
 $q_limit  = 4;
 if ($Submit=='Save'){	
	if($groups=='all')
	{
	$classlist = getallClasses();
	}
	elseif($selectclass=='all') 
	{
	$classlist = getClasses($groups);
	}
	else
	{		
		for ($i=0; $i<count($particulars); $i++) {	
					if($particulars[$i]!="" && $amount[$i]!="")
					{	
					$obj_feesmaster = new es_feemaster();
					$obj_feesmaster->fee_particular = strtoupper($particulars[$i]);
					$obj_feesmaster->fee_class = $selectclass;
					$obj_feesmaster->fee_amount = $amount[$i];
					$obj_feesmaster->fee_instalments = $instalments[$i];
					$obj_feesmaster->Save();
					}
				}
	}
	if (count($classlist)>0){
		foreach($classlist as $eachclass){
			for ($i=0; $i<count($particulars); $i++) {
				if($particulars[$i]!="" && $amount[$i]!="" && $amount[$i]>0)
					{	
					$obj_feesmaster = new es_feemaster();
					$obj_feesmaster->fee_particular = strtoupper($particulars[$i]);
					$obj_feesmaster->fee_class = $eachclass['es_classname'];
					$obj_feesmaster->fee_amount = $amount[$i];
					$obj_feesmaster->fee_instalments = $instalments[$i];
					$obj_feesmaster->Save();
					}
			}
		}
	}
	header("Location:?pid=17&action=viewfees&emsg=".$emsg);
	exit;
  }
 
/**********************************************************************
* Get  groups and Classes
**********************************************************************/
//get groups
 $c_groups = get_groups();

//get classes
 if (isset($groups)&& $groups!=""){
	$class_data = getClasses($groups);
  }
// get Departments 
	$exesqlquery = "SELECT * FROM `es_departments`";
$getdeptlist = getamultiassoc($exesqlquery); 
  /**********************************************************************
//* Get  Student Names for taking attendance
**********************************************************************/
//get student name

if(isset($at_std_class) && $at_std_class!="" ){
	$studentnamelist = get_StudAttend($at_std_class);
	
}	
/*
*Start of Enter Students Attendance Inc Page
*/
if ($action == "stud_attend") { 

	if(isset($stud_attend_Submit) && $stud_attend_Submit != "") {
		$error = "";
		$vlc = new FormValidation();
		
		if(empty($at_attendance_date)) {
			$errormessage[0]         = "Enter Date";
		 }
		if(empty($at_attendance)) {
			$errormessage[1]         = "Invalid";
		} 
		if(count($errormessage)==0) {		 
			
			if (isset($at_attendance_date)){
				$attendance_date = formatDateCalender($at_attendance_date, 'Y-m-d');
				$today =  date("Y-m-d");
			$rowCount = $db->getOne('SELECT * FROM `es_attend_student` WHERE  `at_attendance_date`= "' .$attendance_date . '" AND `at_std_class` = "' .$at_std_class .'";');	
			$differencedate_val = dateDiff($today, $attendance_date);
					
			}
			 
		   if (isset($rowCount) && $rowCount > 0 ) {
				$emsg = 37;	
				header("location:?pid=$pid&action=stud_attend&at_std_class=$at_std_class&emsg=37");
				exit;
		   }
		   if (isset($differencedate_val) && $differencedate_val > 0 ) {
			   $emsg = 38;
			   header("location:?pid=$pid&action=stud_attend&at_std_class=$at_std_class&emsg=38");
			   exit;
			}
			if(empty($error) && empty($error1) && empty($error2)) {
			  
				 for ($i=0; $i<count($at_stud_name); $i++) {
					if($at_stud_name[$i]!="" )
						{	
						$ob_student = new es_attend_student();
						$ob_student->at_std_class = $at_std_class;
						$ob_student->at_std_subject = $at_std_subject;
						$ob_student->at_period_from = $at_period_from;
						$ob_student->at_period_to = $at_period_to;
						$ob_student->at_attendance_date = $attendance_date;
						$ob_student->at_reg_no = $at_reg_no[$i];
						$ob_student->at_stud_name = $at_stud_name[$i];
						$ob_student->at_attendance = $at_attendance[$i];
						$ob_student->at_remarks = $at_remarks[$i];
						$id=$ob_student->save();
						
						//--------------------------------------- Send SMS if student is absent ---------------------------------------//
						if($at_attendance[$i] == 'A')
						{
							$phone_no = $db->getOne("SELECT pre_mobile FROM es_preadmission WHERE es_preadmissionid=".$at_reg_no[$i]);
							$class_name = $db->getOne("SELECT es_classname FROM es_classes WHERE es_classesid=".$at_std_class);
							$message_text = "CONCERN(".date("d-M-Y", strtotime($attendance_date)).")-Dear Parent, ".$at_stud_name[$i]."(STD-".$class_name.") has not come to school today";
							$sms_url = "http://sms.smsinstant.in/api/sendmsg.php?user=babahs&pass=12345&sender=BABAHS";
							$sms_url .= "&phone=".$phone_no;
							$sms_url .= "&text=".urlencode($message_text);
							$sms_url .= "&priority=ndnd&stype=normal";
							
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $sms_url);
							curl_setopt($ch, CURLOPT_HEADER, 0);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For HTTPS
							curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For HTTPS
							curl_exec($ch);
							$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
							
							curl_close($ch);
						}// End of if($at_attendance[$i] == 'A')
						//----------------------------------- End of send SMS if student is absent ---------------------------------------//
				    if(isset($id) && $id!="") {
					
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_attend_student','ATTENDANCE','STUDENT ATTENDANCE','".$id."',' ENTER STUDENT ATTENDANCE','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
						
						header("location:?pid=$pid&action=stud_attend&emsg=22");
						}
								 } 
				 }
			}	
	}
  }
}
/*
*End of Enter Students Attendance Inc Page
*/
/*
*Start  of Enter Staff Attendance Inc Page
*/
/**********************************************************************
//* Get  Staff Names
**********************************************************************/
//get Staff name
if(isset($at_staff_dept) && $at_staff_dept!=""){
	$staffdept = getstudentdetails($at_staff_dept);
	
}	

if(isset($staff_attend_Submit) && $staff_attend_Submit != "")
{
	for($i=0; $i < count($_POST['at_staff_id']); $i++)
	{
		$query = "INSERT INTO `es_attend_staff`(`at_staff_dept`, `at_staff_date`, `at_staff_id`, `at_staff_name`, `at_staff_desig`, `at_staff_attend`, `at_staff_remarks`, `at_time_in`, `at_time_out`, `leave_type`)
				VALUES (
					'".mysqli_real_escape_string($mysqli_con, $_POST['at_staff_dept'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['at_staff_date'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['at_staff_id'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['at_staff_name'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['at_staff_desig'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['at_staff_attend'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['at_staff_remarks'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['at_time_in'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['at_time_out'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['leave_type'][$i])."')";
		mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
	}
	header('location: ?pid=27&action=staff_report');
	exit;
} 
/*
*End  of Enter Staff Attendance Inc Page
*/
/*
*Start Student Attendance Record for student wise Inc Page
*/

/**********************************************************************
* Get  Student Attendance Record for student wise for reg number
**********************************************************************/
//get Student Attendance
if(isset($at_std_wise_class_report) && $at_std_wise_class_report!=""){
	
	$stud_regno =  get_StudAttend($at_std_wise_class_report);
}	
	
/**********************************************************************
* Get  Student Attendance Record for student wise for name
**********************************************************************/
//get Student Attendance
if(isset($at_stdregno) && $at_stdregno!=""){
	
	$stud_name =  get_StudAttend_Reg1($at_stdregno);

}	

/**
*For Particular Studentwise Report 
*/
if(isset($student_report_submit) && $student_report_submit != "") {
	$error = "";
	$vlc = new FormValidation();
	if(empty($at_std_wise_class_report)) {
	$errormessage[0]             = "Select Class";
	
	}
	
	if(empty($at_stdregno)) {
	$errormessage[1]              = "Select Registration No";
	
	} 	
	
	if(empty($dc1)) {
	$errormessage[2]             = "Enter From Date";
	
	}
	
	if(empty($dc2)) {
	$errormessage[3]              = "Enter To  Date";
	
	} 	
	 
	if(count($errormessage)==0)
	 {
		 $from   =  formatDateCalender($dc1, 'Y-m-d'); 
		 $to     =  formatDateCalender($dc2, 'Y-m-d');
		
		$studentwiseReportList = get_StudWise_report($from,$to,$at_std_wise_class_report,$at_stdregno);
		$studurl				= "&from=$from&to=$to&at_std_wise_class_report=$at_std_wise_class_report&at_stdregno=$at_stdregno";
	}
	
	 $log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_attend_student','ATTENDANCE','STUDENT REPORT','".$at_stdregno."','PRINT STUDENT REPORT','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);

	$cnt_rec_atnd = $studentwiseReportList[0]['COUNT(*)'];
}
/*
*End Student Attendance Record for student wise Inc  Page
*/
/*
*Start of Student Attendance Record for student wise Inc Print Page
*/
if ($action == 'print_stud_report') {

	$class = "SELECT es_classname FROM es_classes WHERE es_classesid='".$at_std_wise_class_report."'";
	$className	= getarrayassoc($class);
	$studentwiseReportList = get_StudWise_report($from,$to,$at_std_wise_class_report,$at_stdregno);

}
/*
*End Student Attendance Record for student wise Inc Print Page
*/
/*Start of students Attendance classwise Inc Page */


$printpassurl = "";
if(isset($at_std_class_report) && $at_std_class_report!=""){
 
	$studentReportList = getamultiassoc("SELECT DISTINCT `at_reg_no` ,`at_stud_name` FROM `es_attend_student` WHERE  `at_attendance_date` BETWEEN  '$from_acad' AND  '$to_acad' AND `at_std_class`= '$at_std_class_report'");
	$printpassurl = "&at_std_class_report=$at_std_class_report&pcf=$from_acad&pct=$to_acad";
	
}	
 
if (isset($class_student_report_submit) && $class_student_report_submit != "") { 
	if(empty($dc1)) {
	   $errormessage[0]             = "Enter From Date";

	}
		 
	if(empty($dc2)) {
	$errormessage[1]              = "Enter To  Date";
	
	} 	
	 
	if(count($errormessage)==0)
	 {

 	  $from   =  formatDateCalender($dc1, 'Y-m-d'); 
	  $to     =  formatDateCalender($dc2, 'Y-m-d');
	 $printpassurl = "&at_std_class_report=$at_std_class_report&from=$from&to=$to";
	 $studentReport_date    = "SELECT DISTINCT `at_reg_no` ,`at_stud_name` FROM `es_attend_student` WHERE `at_attendance_date`  BETWEEN '$from' AND '$to'  AND `at_std_class`= '$at_std_class_report'";
	 
	
	 
	 
	 $studentReportList_date =  getamultiassoc($studentReport_date);
	
	

	
	
	}
}

/*Start of students classwise Print Page */

if($action == "print_class_report")
{
	$class = "SELECT es_classname FROM es_classes WHERE es_classesid='".$at_std_class_report."'";
	$className	= getarrayassoc($class);
	 $log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_attend_student','ATTENDANCE','CLASS REPORT','".$at_stdregno."','PRINT CLASS REPORT','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);


	if(isset($at_std_class_report) && $at_std_class_report!="" && $from=="" && $to==""){
		$studentReportList = getamultiassoc("SELECT DISTINCT `at_reg_no` ,`at_stud_name` FROM `es_attend_student` WHERE  `at_attendance_date` BETWEEN  '$pcf' AND  '$pct' AND `at_std_class`= '$at_std_class_report'");
		
	}

	if($at_std_class_report!="" && $from!="" && $to!=""){
	   $studentReport_date    = "SELECT DISTINCT `at_reg_no` ,`at_stud_name` FROM `es_attend_student` WHERE `at_attendance_date`  BETWEEN '$from' AND '$to'  AND `at_std_class`= '$at_std_class_report'";
	   $studentReportList_date =  getamultiassoc($studentReport_date);
	
	


	
	
	}
}
/*Start of students Absentees  classwise Print Page */

if ($action == 'class_report_absent') {
		$sel_absent = "SELECT * FROM `es_attend_student`  WHERE `at_attendance_date` BETWEEN  '$cadf' AND  '$cadt' AND `at_attendance` = 'A' AND `at_reg_no` = '$caid' ORDER BY `at_attendance_date` DESC ";
		$class_absenties = getamultiassoc($sel_absent); 
		
		 $log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_attend_student','ATTENDANCE','CLASS REPORT','".$class_absenties."','PRINT CLASS REPORT ABSENT','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
	}
/*Start of students Absentees  classwise Print Datewise Page */

if ($action == 'class_report_absent_date') {
		$sel_absent = "SELECT * FROM `es_attend_student`  WHERE `at_attendance_date`  BETWEEN '$from' AND '$to' AND `at_attendance` = 'A' AND `at_reg_no` = '$caid' ORDER BY `at_attendance_date` DESC ";
		$class_absenties = getamultiassoc($sel_absent); 
	 $log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_attend_student','ATTENDANCE','CLASS REPORT','".$caid."','PRINT CLASS REPORT','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
}
/*End of students Attendance classwise Inc Page */
/*
*Code for staffwise Attendance Report Starts Here
*/
/*  Fetching Staff Id  According to the Selection of Department Name */
if (isset($at_staffwise_dept) && $at_staffwise_dept!= "") {
 	
	 $sel_staffid = "SELECT * FROM  `es_staff` WHERE `st_department` = '".$at_staffwise_dept."' AND `tcstatus` != 'issued'"; 
	$res_staffid = getamultiassoc($sel_staffid);
	

}

/* Fetching Staff Name Depending upon the Selection of Staff ID */
if (isset($at_staffid) && $at_staffid!="" ) {

	$sel_staff_name = "SELECT * FROM  `es_staff` WHERE `es_staffid` = '".$at_staffid ."'";
	$res_staff_name = getamultiassoc($sel_staff_name);
}


/**
*For Particular StaffWise Report
*/
if (isset($staffwise_report_submit) && $staffwise_report_submit !="") {
	 $error = "";

	 $vlc = new FormValidation();
	  if(empty($at_staffwise_dept)) {
		$errormessage[0]             = "Select Department";

	 }
	 
	 if(empty($at_staffid)) {
	   $errormessage[1]              = "Select Employee Id";
	 
	 } 	
	 
	 if(empty($dc1)) {
		$errormessage[2]             = "Enter From Date";

	 }
	 
	 if(empty($dc2)) {
	   $errormessage[3]              = "Enter To  Date";
	 
	 } 	
	 
	if(count($errormessage)==0)
	 {
	 
	 $from   =  formatDateCalender($dc1, 'Y-m-d'); 
	 $to     =  formatDateCalender($dc2, 'Y-m-d');
	 
	 
	 $Sel_Staffwise_report = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_date` BETWEEN '$from' AND '$to'  AND `at_staff_dept` = '" .$at_staffwise_dept ."' AND `at_staff_id` = '". $at_staffid."'  ";
	 
	 
	$Staffwise_report = getamultiassoc($Sel_Staffwise_report);
	
	$cnt_rec_atnd = $Staffwise_report[0]['COUNT(*)'];

		
	 $staffwiseurl = "&from=$from&to=$to&at_staffwise_dept=$at_staffwise_dept&at_staffid=$at_staffid"; 

	
	$sel_workdays = "SELECT * FROM `es_attend_staff` WHERE `at_staff_date` BETWEEN '$from' AND '$to'  AND `at_staff_dept` = '" .$at_staffwise_dept ."' AND `at_staff_id` = '". $at_staffid."'   ";
	
	
	$workdays     = sqlnumber($sel_workdays);
	
	$sel_presentdays = "SELECT * FROM `es_attend_staff` WHERE `at_staff_date` BETWEEN '$from' AND '$to'  AND `at_staff_dept` = '" .$at_staffwise_dept ."' AND `at_staff_id` = '". $at_staffid."'   AND `at_staff_attend`='P'";
	
	$presentdays = sqlnumber($sel_presentdays);
	}
	

}
/*
*Code for Print of staffwise Attendance Report Starts Here
*/
if ($action == 'print_staffwise_report') {

	$Sel_Staffwise_report = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_date` BETWEEN '$from' AND '$to'  AND `at_staff_dept` = '" .$at_staffwise_dept ."' AND `at_staff_id` = '". $at_staffid."'  ";
	 
	$Staffwise_report = getamultiassoc($Sel_Staffwise_report);
	$sel_workdays = "SELECT * FROM `es_attend_staff` WHERE `at_staff_date` BETWEEN '$from' AND '$to'  AND `at_staff_dept` = '" .$at_staffwise_dept ."' AND `at_staff_id` = '". $at_staffid."'   ";
	
	$workdays     = sqlnumber($sel_workdays);
	
	$sel_presentdays = "SELECT * FROM `es_attend_staff` WHERE `at_staff_date` BETWEEN '$from' AND '$to'  AND `at_staff_dept` = '" .$at_staffwise_dept ."' AND `at_staff_id` = '". $at_staffid."'   AND `at_staff_attend`='P'";
	
	$presentdays = sqlnumber($sel_presentdays);
	
	
}
/*
*Code for staff Attendance Report Starts Here
*/
/**********************************************************************
//* Get  Department Names for reporting
**********************************************************************/
//get department name
$staffurl = "";
if(isset($school_year2) && $school_year2!=""){

 if (($at_staff_dept1)==""){
		$errormessage[0]="Select Department"; 	
	 }
	 if (count($errormessage)==0){
	$staffReportList =  getamultiassoc("SELECT DISTINCT `at_staff_name` , `at_staff_id` ,at_staff_desig  FROM `es_attend_staff` WHERE  `at_staff_date` BETWEEN  '$from_acad' AND  '$to_acad' AND `at_staff_dept` ='$at_staff_dept1'");
	
	$staffurl		="&at_staff_dept1=$at_staff_dept1&psf=$from_acad&pst=$to_acad";
	
}}
if (isset($attend_staff_report_date_submit) && $attend_staff_report_date_submit != "") {

	if(empty($dc1)) {
		    $errormessage[0]             = "Enter From Date";

	}
		 
	 if(empty($dc2)) {
	   $errormessage[1]              = "Enter To  Date";
	 
	 } 	
	 
	if(count($errormessage)==0)
	 {
  	 $from   =  formatDateCalender($dc1, 'Y-m-d').' 00:00:00'; 
	 $to     =  formatDateCalender($dc2, 'Y-m-d').' 23:59:59';
	 $staffurl		="&at_staff_dept1=$at_staff_dept1&from=$from&to=$to";
	 
	 $staffReport_date    = "SELECT DISTINCT `at_staff_name` , `at_staff_id`,at_staff_desig FROM `es_attend_staff` WHERE `at_staff_date`  BETWEEN '$from' AND '$to'  AND `at_staff_dept` ='$at_staff_dept1'";
	
		$staffReportList_date =  getamultiassoc($staffReport_date);
	}	

}	
/*
*Code for Print of staff Attendance Report Starts Here
*/
if ($action == 'print_staff_report') {

	if (isset($at_staff_dept1) && $at_staff_dept1!="" && $from!= "" && $to!= "") {
	
	$staffReport_date    = "SELECT DISTINCT `at_staff_name` , `at_staff_id`,at_staff_desig FROM `es_attend_staff` WHERE `at_staff_date`  BETWEEN '$from' AND '$to'  AND `at_staff_dept` ='$at_staff_dept1'";
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."',' es_attend_staff','ATTENDANCE','STAFF REPORT','".$at_staff_dept."','PRINT STAFF REPORT','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
	
		$staffReportList_date =  getamultiassoc($staffReport_date);
		
		

		
		
	}
	
	if (isset($at_staff_dept1) && $at_staff_dept1!="" && $from== "" && $to== "") {
	
	$staffReport_date    = "SELECT DISTINCT `at_staff_name` , `at_staff_id`,at_staff_desig FROM `es_attend_staff` WHERE `at_staff_dept` ='$at_staff_dept1'";
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."',' es_attend_staff','ATTENDANCE','STAFF REPORT','".$at_staff_dept."','PRINT STAFF REPORT','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);
	
		$staffReportList =  getamultiassoc($staffReport_date);
		
		

		
		
	}
	
	
}
	
/*Start of Staff Attendance  Absentees Print Page */ 	
if ($action == 'staff_report_absent') {
	$sel_absent = "SELECT * FROM `es_attend_staff`  WHERE `at_staff_date` BETWEEN  '$sabf' AND  '$sabt' AND `at_staff_attend` != 'p' AND `at_staff_id` = '$caid' ORDER BY `at_staff_date` DESC ";
	$staff_absenties = getamultiassoc($sel_absent); 

$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."',' es_attend_staff','ATTENDANCE','STAFF REPORT','".$caid."','PRINT STAFF ABSENT REPORT','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);





}
/*Start of Staff Attendance  Absentees Print Page Dtaewise */ 
if ($action == 'staff_report_absent_date') {
	$sel_absent = "SELECT * FROM `es_attend_staff`  WHERE `at_staff_date`  BETWEEN '$from' AND '$to' AND `at_staff_attend` != 'p' AND `at_staff_id` = '$caid' ORDER BY `at_staff_date` DESC ";
	$staff_absenties = getamultiassoc($sel_absent); 
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."',' es_attend_staff','ATTENDANCE','EMPLOYEE REPORT','".$caid."','PRINT STAFF ABSENT REPORT DATEWISE','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);



}



/*
*Start of Edit Students Attendance Inc Page
*/
if ($action == "edit_stud_attendence") { 
	if(isset($stud_editattend_Submit) && $stud_editattend_Submit != "") {
		$error = "";
		$vlc = new FormValidation();
		
		if(empty($at_std_class)) {
			$errormessage[0]         = "Select Class";
		} 
		if(empty($at_attendance_date)) {
			$errormessage[1]         = "Enter Date";
		
		 }
		
		
		if(count($errormessage)==0) { $studentnamelist1 = get_StudAttend($at_std_class); 
		$at_attendance_date1=formatDateCalender($at_attendance_date, 'Y-m-d');
		$attendance = "SELECT * FROM `es_attend_student` WHERE at_std_class='".$at_std_class."' AND at_attendance_date='".$at_attendance_date1."' AND at_std_subject='".$at_std_subject."' AND at_std_period='".$at_std_period."'";
		$attendance_num =sqlnumber($attendance);
		
		
		
		
		}
  }
  if(isset($stud_updateattend_Submit) && $stud_updateattend_Submit != "") {
  $studentnamelist1 = get_StudAttend($at_std_class);
  foreach ($studentnamelist1 as $student)
	{
	$student_addtendance=$_POST['at_attendance'.$student['es_preadmissionid']];
	$student_remarks=$_POST['at_remarks'.$student['es_preadmissionid']];
	$at_attendance_date1=formatDateCalender($at_attendance_date, 'Y-m-d');	
     $sql="UPDATE `es_attend_student` SET at_attendance='".$student_addtendance."',at_remarks='".$student_remarks."' WHERE at_std_class='".$at_std_class."' AND at_attendance_date='".$at_attendance_date1."' AND at_reg_no=".$student['es_preadmissionid']; 
mysql_query($sql);

$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_attend_student','ATTENDANCE','STUDENT ATTENDANCE','".$student['es_preadmissionid']."',' UPDATE STUDENT ATTENDANCE','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);

header("location: ?pid=27&action=edit_stud_attendence&emsg=55");
exit;


}
$studentnamelist1 = get_StudAttend($at_std_class);
$at_attendance_date1=formatDateCalender($at_attendance_date, 'Y-m-d');
$attendance = "SELECT * FROM `es_attend_student` WHERE at_std_class='".$at_std_class."' AND at_attendance_date='".$at_attendance_date1."' ";
$attendance_num =sqlnumber($attendance);
}}

if ($action == "edit_staff_attendence") { 
//array_print($_POST); 
	if(isset($staff_editattend_Submit) && $staff_editattend_Submit != "") {
		$error = "";
		$vlc = new FormValidation();
		
		if(empty($at_staff_dept)) {
			$errormessage[0]         = "Select Department";
		} 
		if(empty($at_staff_date)) {
			$errormessage[1]         = "Enter Date";
		
		 }
		
		
		if(count($errormessage)==0) { //$studentnamelist1 = get_StudAttend($at_std_class); 
		$at_attendance_date1=formatDateCalender($at_staff_date, 'Y-m-d');
		$attendance = "SELECT * FROM `es_attend_staff` WHERE at_staff_dept='".$at_staff_dept."' AND at_staff_date='".$at_attendance_date1."'";
		$attendance_num =sqlnumber($attendance);
		
		
		
		
		}
  }
  if(isset($staff_updateattend_Submit) && $staff_updateattend_Submit != "") {

  $staffdept = getstudentdetails($at_staff_dept);
  foreach ($staffdept as $staff)
	{
	$staff_addtendance=$_POST['at_staff_attend'.$staff['es_staffid']];
	$staff_remarks=$_POST['at_staff_remarks'.$staff['es_staffid']];
	$at_time_in=$_POST['at_time_in'.$staff['es_staffid']];
	$at_time_out=$_POST['at_time_out'.$staff['es_staffid']];
	$at_attendance_date1=formatDateCalender($at_staff_date, 'Y-m-d');	
     $sql="UPDATE `es_attend_staff` SET at_staff_attend='".$staff_addtendance."',at_time_in='".$at_time_in."',at_time_out='".$at_time_out."',at_staff_remarks='".$staff_remarks."' WHERE at_staff_dept='".$at_staff_dept."' AND at_staff_date='".$at_attendance_date1."' AND at_staff_id=".$staff['es_staffid']; 
mysql_query($sql);
}

$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_attend_staff','ATTENDANCE','STAFF ATTENDANCE','".$staff['es_staffid']."','EDIT STAFF ATTANDANCE','".$_SERVER['REMOTE_ADDR']."',NOW())";
$log_insert_exe=mysql_query($log_insert_sql);


/*$studentnamelist1 = getstudentdetails($at_staff_dept);
$at_attendance_date1=formatDateCalender($at_attendance_date, 'Y-m-d');
$attendance = "SELECT * FROM `es_attend_staff` WHERE at_staff_dept='".$at_staff_dept."' AND at_attendance_date='".$at_attendance_date1."' ";
$attendance_num =sqlnumber($attendance);*/
header("location: ?pid=27&action=edit_staff_attendence&emsg=55");
exit;
}
}


if($action == "descriptive_notes" || $action == "print_descriptive_notes")
{
	if(isset($dn_reg_no))
		$reg_no = $dn_reg_no;
	if(isset($dn_reg_no_tbl))
		$reg_no = $dn_reg_no_tbl;
		
	if(isset($dn_search_student) || isset($dn_save))
	{
		if(empty($reg_no))
			$errormessage[0] = "Please enter registration number";
			
		if(!empty($reg_no))
		{
			$is_exists_student = $db->getOne("SELECT COUNT(*) FROM es_preadmission WHERE es_preadmissionid=".$reg_no);
			if($is_exists_student == 0)
				$errormessage[1] = "Student does not exists";
		}
		
		if(count($errormessage) == 0)
		{
			$student_info = $db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid=".$reg_no);
			$preadmission_details = $db->getRows("SELECT * FROM es_preadmission_details WHERE es_preadmissionid=".$reg_no);
			$es_descr_notes = $db->getRows("SELECT * FROM es_descriptive_notes WHERE es_preadmissionid=".$reg_no);
		}	// End of if(count($errormessage) == 0)
	}	// End of if(isset($dn_search_student))
	
	if(isset($dn_save))
	{
		if(count($es_descr_notes) > 0)
		{
			$db->delete("es_descriptive_notes", "es_preadmissionid=".$reg_no);
			//mysql_query("DELETE FROM es_descriptive_notes WHERE es_preadmissionid=".$reg_no);
		}
		for($i = 0; $i < (count($_POST['dn_classesid'])*2); $i++)
		{
			if($i%2 == 0)
				$sem = 1;
			else
				$sem = 2;
				
			
			$es_descriptive_notes = array(	'es_preadmissionid'	=>	$reg_no,
											'es_classesid'		=>	$dn_classesid[$i/2],
											'es_semester'		=>	$sem,
											'special_progress'	=>	$sem_progress[$i],
											'need_to_improve'	=>	$sem_improvement[$i]
										);
			$es_descriptive_notesid = $db->insert("es_descriptive_notes", $es_descriptive_notes);
			//print_r($es_descriptive_notes);
			//echo "<br>";
		}
		header("location: ?pid=27&action=descriptive_notes&dn_search_student=GO&dn_reg_no=".$reg_no."&emsg=2");
	}
}


?> 