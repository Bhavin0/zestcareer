<?php
sm_registerglobal('pid', 'action','tid');	
/**
* Only Student or schoool staff  can be allowed to access this page
*/ 
checkuserinlogin(); 

if($action == 'add_incedent' && isset($_POST['insert']))
{
	$data = $_POST['data'];
	$data['violation_submitted_by'] = $_SESSION['eschools']['user_id'];
	$student_violationid = insert_into('student_violation', $data);
	
	if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '')
	{
		$name = $_FILES["attachment"]["name"];
		$ext = end((explode(".", $name)));
		$destination = "../uploads/student_violations/".$student_violationid.".".$ext;
		move_uploaded_file($_FILES["attachment"]["tmp_name"], $destination);

		update_where('student_violation', array('violation_file' => $ext), array('student_violationid' => $student_violationid));
	}

	header('location: ?pid=62&action=view_incedents');
	exit;
}

if($action == 'edit_incedent' && isset($_POST['update']))
{
	$data = $_POST['data'];

	if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '')
	{
		if($_POST['violation_file']!='')
		{
			unlink("../uploads/student_violations/".$_GET['student_violationid'].".".$_POST['violation_file']);
		}
		$name = $_FILES["attachment"]["name"];
		$ext = end((explode(".", $name)));
		$destination = "../uploads/student_violations/".$_GET['student_violationid'].".".$ext;
		move_uploaded_file($_FILES["attachment"]["tmp_name"], $destination);

		$data['violation_file'] = $ext;
	}

	$student_violationid = update_where('student_violation', $data, array('student_violationid' => $_GET['student_violationid']));

	header('location: ?pid=62&action=view_incedents');
	exit;
}
?>

