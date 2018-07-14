<?php
include_once (INCLUDES_CLASS_PATH . DS . 'class.es_assignment.php');
sm_registerglobal('pid', 'action','emsg', 'update', 'uid', 'start', 'asds_order', 'submit', 'column_name', 'admin', 'as_suject', 'as_class','as_sec','as_lastdate','as_name','as_description', 'Submit','as_createdon','as_lastdate','as_marks','update','es_assid','back','delete','prev','pre_year','column_name');


 
/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}

if(isset($_POST['add_assignment']))
{
	$data = $_POST['data'];
	$data['person_type'] = 'admin';
	$data['created_by'] = $_SESSION['eschools']['admin_id'];
	$assignment_id = insert_into('es_assignment', $data);

	if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '')
	{
		$name = $_FILES["attachment"]["name"];
		$ext = end((explode(".", $name)));
		$destination = "../uploads/assignments/".$assignment_id.".".$ext;
		move_uploaded_file($_FILES["attachment"]["tmp_name"], $destination);

		update_where('es_assignment', array('as_attachment' => $ext), array('es_assignmentid' => $assignment_id));
	}


	header('location: ?pid=4&action=view_assignment');
	exit;
}

if(isset($_POST['edit_assignment']))
{
	$data = $_POST['data'];
	update_where('es_assignment', $data, array('es_assignmentid' => $_GET['assignment_id']));

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


	header('location: ?pid=4&action=view_assignment');
	exit;
}

if($_GET['action'] == 'delete_assignment')
{
	update_where('es_assignment', array('status' => 'deleted'), array('es_assignmentid' => $_GET['assignment_id']));
	header('location: ?pid=4&action=view_assignment');
	exit;
}


if($_GET['action'] == 'view_assignment')
{
	$query_1 = "SELECT `es_assignment`.*, `es_classes`.`es_classname`, `isd_class_division`.`division_name`, `es_subject`.`es_subjectname`, CONCAT(`es_admins`.`admin_fname`,' ',`es_admins`.`admin_lname`) AS `person_created` FROM `es_assignment` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_assignment`.`as_class_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `es_assignment`.`as_division_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_assignment`.`as_subject_id` INNER JOIN `es_admins` ON `es_admins`.`es_adminsid` = `es_assignment`.`created_by` WHERE `es_assignment`.`status`='active' AND `es_assignment`.`person_type` = 'admin'";

	$query_2 = "SELECT `es_assignment`.*, `es_classes`.`es_classname`, `isd_class_division`.`division_name`, `es_subject`.`es_subjectname`, CONCAT(`es_staff`.`st_firstname`,' ',`es_staff`.`st_lastname`) AS `person_created` FROM `es_assignment` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_assignment`.`as_class_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `es_assignment`.`as_division_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_assignment`.`as_subject_id` INNER JOIN `es_staff` ON `es_staff`.`es_staffid` = `es_assignment`.`created_by` WHERE `es_assignment`.`status`='active' AND `es_assignment`.`person_type` = 'teacher'";

	$query = "(".$query_1.") UNION ALL (".$query_2.") ORDER BY `es_assignmentid` DESC";

	$assignments = mysqli_query($mysqli_con, $query) or die(MYSQLI_ERROR($mysqli_con));
}
?>
