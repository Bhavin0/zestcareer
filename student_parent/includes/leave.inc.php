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
		$query = "INSERT INTO `es_leave_request`(`es_staffid`, `leave_fromdate`, `leave_todate`, `priority`, `reason`, `leave_type`, `status`)
				VALUES (
				'".mysqli_real_escape_string($mysqli_con, $_SESSION['eschools']['user_id'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['from_date'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['to_date'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['priority'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['reason'])."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['leave_type'])."',
				'Pending')";

		mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));

		header('location: ?pid=24&action=Leave');
		exit;
	}
}


?>
