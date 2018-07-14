<?php

//include_once (INCLUDES_CLASS_PATH . DS . 'class.es_assignment.php');
sm_registerglobal('pid','action','update','emsg','start','column_name','asds_order','uid','sid','admin',
'Submit','blogDesc','title','es_date', 'update','es_messagesid','es_staffid','subject','message','submit_staff','submit_student','es_classesid','es_preadmissionid','es_adminsid','keyword','search','type','dc1','dc2');
/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}

if($action == 'compose')
{
	//print_r($_SESSION);exit;
	//$form_type = $_POST['form_id'];exit;
	if(isset($_POST['send_notice']))
	{
		
		$data = $_POST['data'];
		$data['created_on'] = date('Y-m-d h:i:s');
		$data['from_id'] = $_SESSION['eschools']['admin_id'];
		insert_into('es_notice_messages', $data);
		//exit;
	}

	if(isset($_POST['send_to_staff_notice']))
	{
		//print_r($_POST);
		$data = $_POST['data'];
		$data['created_on'] = date('Y-m-d h:i:s');
		$data['from_id'] = $_SESSION['eschools']['admin_id'];
		insert_into('es_notice_messages', $data);
		//exit;
	}
}

?>