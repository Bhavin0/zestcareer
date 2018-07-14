<?php 
    sm_registerglobal('pid', 'action', 'emsg');
?>



		
<?php
if ($action == 'Leave')
{
	
}

if($action == 'leave_request')
{
	if(isset($_POST['request']))
	{
		$query = "INSERT INTO `es_leave_request`(`es_staffid`, `leave_fromdate`, `leave_todate`, `priority`, `reason`, `leave_type`, `leave_duration`, `status`)
				VALUES (
				'".mysqli_real_escape_string($mysqli_con, $_SESSION['eschools']['user_id'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['from_date'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['to_date'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['priority'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['reason'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['leave_type'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['leave_duration'])."',
				'Pending')";

		mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));

		header('location: ?pid=24&action=Leave');
		exit;
	}
}

if($action == 'edit_leave')
{
	if(isset($_POST['request']))
	{
		$query = "UPDATE `es_leave_request` SET 
											`leave_fromdate`='".mysqli_real_escape_string($mysqli_con, $_POST['from_date'])."',
											`leave_todate`='".mysqli_real_escape_string($mysqli_con, $_POST['to_date'])."',
											`priority`='".mysqli_real_escape_string($mysqli_con, $_POST['priority'])."',
											`reason`='".mysqli_real_escape_string($mysqli_con, $_POST['reason'])."',
											`leave_type`='".mysqli_real_escape_string($mysqli_con, $_POST['leave_type'])."',
											`leave_duration`='".mysqli_real_escape_string($mysqli_con, $_POST['leave_duration'])."'
											 WHERE `es_leave_request_id`=".mysqli_real_escape_string($mysqli_con, $_GET['edit_id']);

		mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));

		header('location: ?pid=24&action=Leave');
		exit;
	}
}


?>
