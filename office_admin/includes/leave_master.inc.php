<?php
/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}
/**End of the permissions    **/
if(!isset($school_year)) {
	$from_finance = $_SESSION['eschools']['from_finance'];
	$to_finance = $_SESSION['eschools']['to_finance'];
}
else{
		$finance_res = getarrayassoc("SELECT * FROM `es_finance_master` WHERE `es_finance_masterid`= $pre_year");
		$from_finance = $finance_res['fi_startdate'];
		$to_finance   = $finance_res['fi_enddate']; 
}
$school_details_sel = "SELECT * FROM `es_finance_master` ORDER BY `es_finance_masterid` DESC";
$school_details_res = getamultiassoc($school_details_sel);

if($action == 'leave_requestes')
{
	if(isset($_GET['request_id']))
	{
		mysqli_query($mysqli_con, "UPDATE `es_leave_request` SET 
			`status`='".mysqli_escape_string($mysqli_con, $_GET['status'])."' 
			WHERE es_leave_request_id =".$_GET['request_id']) or die(mysqli_error($mysqli_con));
		header('Location: ?pid=137&action=leave_requestes');
		exit;
	}
}

if($action == 'create_annual_leave')
{
	if(isset($_POST['insert']))
	{
		foreach($_POST['leave_department'] as $dept)
		{
			$query = "INSERT INTO `es_leavemaster`(`academic_year_id`, `leave_department`, `leave_name`, `allowed_leave`) VALUES (".mysqli_escape_string($mysqli_con, $_POST['academic_year_id']).",
						".mysqli_escape_string($mysqli_con, $dept).",
						'".mysqli_escape_string($mysqli_con, $_POST['leave_name'])."',
						'".mysqli_escape_string($mysqli_con, $_POST['allowed_leave'])."')";
			mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
		}
		header('Location: ?pid=137&action=annual_leaves');
		exit;
	}
}
?>
