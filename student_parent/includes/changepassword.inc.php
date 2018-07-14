<?php 
                                    sm_registerglobal('pid', 
									                  'action',
													  'emsg', 
													  'passwordSubmit',
													  'ch_old_password',
													  'ch_new_password',
													  'ch_rew_password',
													  'notvalid'
													  );
/**
* Only Student or schoool staff  can be allowed to access this page
*/ 

if(isset($_POST['change_password']))
{
	$st_old_password = get_single_row('es_preadmission',array('es_preadmissionid' => $_SESSION['eschools']['user_id']));
	
	  $ch_old_password = $_POST['st_old_password'];
	  $ch_new_password = $_POST['st_new_password'];
	  $ch_rew_password = $_POST['st_rew_password'];
	
	
	if($st_old_password['pre_student_password'] != $ch_old_password)
	{
		$alert_class = "danger";
		$message_text = "Old password invalid vipul";
	}
	elseif($ch_new_password != $ch_rew_password)
	{
		$alert_class = "danger";
		$message_text = "Please Enter same password in Rewrite password";
	}
	else
	{
		$alert_class = "success";
		$message_text = "Password change successfully";
		$update_password = "UPDATE es_preadmission SET pre_student_password = '".$ch_new_password."' WHERE es_preadmissionid = '".$_SESSION['eschools']['user_id']."' " ;
		mysqli_query($mysqli_con, $update_password) or die(mysqli_error($mysqli_con));
	}
	$_POST = array();

}

?>	