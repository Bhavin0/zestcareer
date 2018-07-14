<?php
sm_registerglobal('pid', 'action', 'asds_order' ,'as_class', 'column_name', 'start', 'q_limit', 'no_rows' , 'assignment_id');

/**
* Only Student or schoool staff  can be allowed to access this page
*/ 
checkuserinlogin();

$current_academic_year = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC"));

$current_academic_detail = get_single_row('es_preadmission_details', array('es_preadmissionid' => $_SESSION['eschools']['user_id'], 'academic_year_id' => $current_academic_year['es_finance_masterid']), 'es_preadmission_detailsid', 'DESC');

if($_GET['action'] == 'myassignment')
{
	
	

	$query_1 = "SELECT `es_assignment`.*, `es_classes`.`es_classname`, `isd_class_division`.`division_name`, `es_subject`.`es_subjectname`, CONCAT(`es_admins`.`admin_fname`,' ',`es_admins`.`admin_lname`) AS `person_created` FROM `es_assignment` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_assignment`.`as_class_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `es_assignment`.`as_division_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_assignment`.`as_subject_id` INNER JOIN `es_admins` ON `es_admins`.`es_adminsid` = `es_assignment`.`created_by` WHERE `es_assignment`.`status`='active' AND `es_assignment`.`person_type` = 'admin' AND `es_assignment`.`as_class_id`=".$current_academic_detail['pre_class']." AND `es_assignment`.`as_division_id`=".$current_academic_detail['division_id'];

	$query_2 = "SELECT `es_assignment`.*, `es_classes`.`es_classname`, `isd_class_division`.`division_name`, `es_subject`.`es_subjectname`, CONCAT(`es_staff`.`st_firstname`,' ',`es_staff`.`st_lastname`) AS `person_created` FROM `es_assignment` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_assignment`.`as_class_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `es_assignment`.`as_division_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_assignment`.`as_subject_id` INNER JOIN `es_staff` ON `es_staff`.`es_staffid` = `es_assignment`.`created_by` WHERE `es_assignment`.`status`='active' AND `es_assignment`.`person_type` = 'teacher' AND `es_assignment`.`as_class_id`=".$current_academic_detail['pre_class']." AND `es_assignment`.`as_division_id`=".$current_academic_detail['division_id'];

	$query = "(".$query_1.") UNION ALL (".$query_2.") ORDER BY `es_assignmentid` DESC";

	$assignments = mysqli_query($mysqli_con, $query) or die(MYSQLI_ERROR($mysqli_con));
}
?> 