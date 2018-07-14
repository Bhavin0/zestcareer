<?php 
sm_registerglobal('pid', 'action','emsg','es_subjectid','es_classesid','addchapter','unit_id','classesid','subjectid','searchunit','uid','chapter_name','chid','chapter_id','tut_desc','file_path','title','tutid','downloadfile','addtutorial','start','check_your_progress');
/**
* Only Student or schoool staff  can be allowed to access this page
*/ 
checkuserinlogin();
/**End of the permissions   **/
$student_det = get_studentdetails( $_SESSION['eschools']['user_id']);

if(isset($downloadfile) && $downloadfile!="") {
ForceDownloadFile("../office_admin/images/tutorials/".$downloadfile);
}
if($action=='tutorialslist' || $action == 'print_list'){

$subject_list=$db->getRow("SELECT subject_id_array FROM subjects_cat WHERE scat_id=(SELECT EPD.scat_id FROM es_preadmission EP,es_preadmission_details EPD WHERE EP.es_preadmissionid=EPD.es_preadmissionid AND EP.es_preadmissionid=".$_SESSION['eschools']['user_id'].')');
	 $subject_id_array=explode('@#@#@',$subject_list['subject_id_array']);
	 
	  $tutorial_qry = "SELECT cl.es_classname, s.es_subjectname , u.unit_name ,c.chapter_name,s.es_subjectid,t.* 
	                  FROM es_classes cl, es_subject s, es_units u, es_chapters c, es_tutorials t  
	                           WHERE  cl.es_classesid ='".$student_det['pre_class']."' 
							   AND   cl.es_classesid = s.es_subjectshortname 
							   AND   s.es_subjectid  = u.es_subjectid
							   AND   u.unit_id       = c.unit_id 
							   AND   c.chapter_id    = t.chapter_id
							   AND   t.status        = 'active'" ;
	$no_rows      = sqlnumber($tutorial_qry);
	
	$q_limit      = 10;
		
	if ( !isset($start) ){
			$start = 0;
		}						   
	$tutorial_qry .="ORDER BY t.tut_id DESC LIMIT " . $start . ", " . $q_limit . ""; 						   
	$tutorials_det = $db->getRows($tutorial_qry);
	//array_print($tutorials_det);
}
$current_academic_year = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC"));
$current_academic_detail = get_single_row('es_preadmission_details', array('es_preadmissionid' => $_SESSION['eschools']['user_id']), 'es_preadmission_detailsid', 'DESC');

if($_GET['action'] == 'mymaterial')
{
	
	

	$query_1 = "SELECT `es_studymaterial`.*, `es_classes`.`es_classname`, `es_subject`.`es_subjectname`, CONCAT(`es_admins`.`admin_fname`,' ',`es_admins`.`admin_lname`) AS `person_created` FROM `es_studymaterial` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_studymaterial`.`sm_class_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_studymaterial`.`sm_subject_id` INNER JOIN `es_admins` ON `es_admins`.`es_adminsid` = `es_studymaterial`.`created_by` WHERE `es_studymaterial`.`status`='active' AND `es_studymaterial`.`person_type` = 'admin' AND `es_studymaterial`.`sm_class_id`=".$current_academic_detail['pre_class']." ";

	//echo $query_1;exit;

$query_2 = "SELECT `es_studymaterial`.*, `es_classes`.`es_classname`,`es_subject`.`es_subjectname`, CONCAT(`es_staff`.`st_firstname`,' ',`es_staff`.`st_lastname`) AS `person_created` FROM `es_studymaterial` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_studymaterial`.`sm_class_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_studymaterial`.`sm_subject_id` INNER JOIN `es_staff` ON `es_staff`.`es_staffid` = `es_studymaterial`.`created_by` WHERE `es_studymaterial`.`status`='active' AND `es_studymaterial`.`person_type` = 'teacher' AND `es_studymaterial`.`sm_class_id`=".$current_academic_detail['pre_class']." ";

	//echo $query_2;exit;

	$query = "(".$query_1.") UNION ALL (".$query_2.") ORDER BY `es_studymaterialid` DESC";

	//echo $query;exit;

	$materials = mysqli_query($mysqli_con, $query) or die(MYSQLI_ERROR($mysqli_con));
}
if($action=="viewtutorial" || $action=='print_view'){
	$single_tutorial_qry = "SELECT cl.es_classname, s.es_subjectname , u.unit_name ,c.chapter_name, t.* 
							   FROM es_classes cl, es_subject s, es_units u, es_chapters c, es_tutorials t   
							   WHERE  cl.es_classesid ='".$student_det['pre_class']."' 
							   AND   cl.es_classesid = s.es_subjectshortname 
							   AND   s.es_subjectid  = u.es_subjectid
							   AND   u.unit_id       = c.unit_id 
							   AND   c.chapter_id    = t.chapter_id
							   AND   t.tut_id        = ".$tutid ;
							  
							   
	$viewtutorial = $db->getrow($single_tutorial_qry);
	
	if($viewtutorial['user_type']=="staff"){
	
	$viewuserinfo=$db->getRow("select * from es_staff where es_staffid=".$viewtutorial['user_id']);
	$username=$viewuserinfo['st_firstname']	;	
	}	
	if($viewtutorial['user_type']=="admin"){
	$viewuserinfo=$db->getRow("select * from es_admins where es_adminsid=".$viewtutorial['user_id']);
	$username=$viewuserinfo['admin_fname'];
	}
	
	$questioncount = $db->getOne("select count(*) from es_questionbank where chapter_id=".$viewtutorial['chapter_id']);	
	
	if($check_your_progress !="" && isset($check_your_progress)){	
			$_SESSION['eschools']['exam']['chapter']= $viewtutorial['chapter_id'];
			unset($_SESSION['eschools']['exam']['question']);	
			unset($_SESSION['eschools']['exam']['correctanswer']);		
			header("Location:?pid=40&action=chapterexam");
			exit;
		}
	
}

?>	