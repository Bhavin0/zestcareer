<?php
include_once (INCLUDES_CLASS_PATH . DS . 'class.es_assignment.php');

sm_registerglobal('pid', 'action','emsg', 'update', 'as_marks', 'uid', 'start', 'asds_order', 'submit', 'column_name', 'admin','as_name', 'as_suject', 'as_class','as_sec','as_lastdate','as_description', 'Submit','as_createdon','as_lastdate','as_marks','update','es_assid','back','delete','prev','pre_year');
/**
* Only Student or schoool staff  can be allowed to access this page
*/ 
checkuserinlogin();
/**End of the permissions*/   

	$school_details_sel = "SELECT * FROM `es_finance_master` ORDER BY `es_finance_masterid` DESC";
	$school_details_res = getamultiassoc($school_details_sel);

//fetching  Class  //*/
    $staff_det = get_staffdetails($_SESSION['eschools']['user_id']);
	$exesqlquery = "SELECT * FROM `es_classes` WHERE  es_classesid=".$staff_det['st_class'];
    $getclasslist = getamultiassoc($exesqlquery);
	
	//fetching  Class  ///

// Add Assignments


if(isset($_POST['add_assignment']))
{
	$data = $_POST['data'];
	$data['person_type'] = 'teacher';
	$data['created_by'] = $_SESSION['eschools']['user_id'];
	$assignment_id = insert_into('es_assignment', $data);

	if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '')
	{
		$name = $_FILES["attachment"]["name"];
		$ext = end((explode(".", $name)));
		$destination = "../uploads/assignments/".$assignment_id.".".$ext;
		move_uploaded_file($_FILES["attachment"]["tmp_name"], $destination);

		update_where('es_assignment', array('as_attachment' => $ext), array('es_assignmentid' => $assignment_id));
	}


	header('location: ?pid=21&action=view_assignment');
	exit;
}

if(isset($_POST['edit_assignment']))
{
	$data = $_POST['data'];
	update_where('es_assignment', $data, array('es_assignmentid' => $_GET['assignment_id'], 'created_by' => $_SESSION['eschools']['user_id']));

	if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '')
	{
		$name = $_FILES["attachment"]["name"];
		$ext = end((explode(".", $name)));
		$destination = "../uploads/assignments/".$_GET['assignment_id'].".".$ext;
		if(file_exists($destination))
		{
			unlink($destination);
		}
		move_uploaded_file($_FILES["attachment"]["tmp_name"], $destination);

		update_where('es_assignment', array('as_attachment' => $ext), array('es_assignmentid' => $_GET['assignment_id']));
	}


	header('location: ?pid=21&action=view_assignment');
	exit;
}

if($_GET['action'] == 'delete_assignment')
{
	update_where('es_assignment', array('status' => 'deleted'), array('es_assignmentid' => $_GET['assignment_id'], 'created_by' => $_SESSION['eschools']['user_id']));
	header('location: ?pid=21&action=view_assignment');
	exit;
}


if($_GET['action'] == 'view_assignment')
{

	$query = "SELECT `es_assignment`.*, `es_classes`.`es_classname`, `isd_class_division`.`division_name`, `es_subject`.`es_subjectname`, CONCAT(`es_staff`.`st_firstname`,' ',`es_staff`.`st_lastname`) AS `person_created` FROM `es_assignment` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_assignment`.`as_class_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `es_assignment`.`as_division_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_assignment`.`as_subject_id` INNER JOIN `es_staff` ON `es_staff`.`es_staffid` = `es_assignment`.`created_by` WHERE `es_assignment`.`status`='active' AND `es_assignment`.`person_type` = 'teacher' AND `es_assignment`.`created_by`='".$_SESSION['eschools']['user_id']."' ORDER BY `es_assignmentid` DESC";

	$assignments = mysqli_query($mysqli_con, $query) or die(MYSQLI_ERROR($mysqli_con));
}


	
?>
