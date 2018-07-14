<?php
//print_r($_SESSION);exit;
//include_once (INCLUDES_CLASS_PATH . DS . 'class.es_assignment.php');
sm_registerglobal('pid','action','update','emsg','start','column_name','asds_order','uid','sid','admin',
'Submit','blogDesc','title','es_date', 'update','es_messagesid','es_staffid','subject','message','submit_staff','submit_student','es_classesid','es_preadmissionid','es_adminsid','keyword','search','type','copyid','dc1','dc2');
/**
* Only Admin users can view the pages
*/
checkuserinlogin();$obj_messages = new es_messages();
$obj_classlist    = new es_classes();
$obj_stafflist    = new es_staff();
$obj_studentslist    = new es_preadmission();
$html_obj = new html_form();

$obj_classlistarr = $obj_classlist->GetList(array(array("es_classesid", ">", 0)) );
//$class_list['all'] = "-- All --";
foreach($obj_classlistarr as $eachclass){
$class_list[$eachclass->es_classesId]= $eachclass->es_classname;
}


$obj_stafflistarr = $obj_stafflist->GetList(array(array("es_staffid", ">", 0)) );
$staff_list['all'] = "-- All --";
foreach($obj_stafflistarr as $eachstaff){

$staff_list[$eachstaff->es_staffId]= $eachstaff->st_firstname.' '.$eachstaff->st_lastname.'&nbsp;&lt;'. $eachstaff->st_username . '&gt;';
}


$alladmins = $db->getrows("SELECT * FROM es_admins ORDER BY es_adminsid ASC");

if(count($alladmins)>0){

$alladmins_arr['all'] = "-- All --";
foreach($alladmins as $each_admin){
$alladmins_arr[$each_admin['es_adminsid']]= $each_admin['admin_fname'].'&nbsp;&lt;'. $each_admin['admin_username'] . '&gt;';
}
}
if($action == 'compose')
{
//print_r($_POST);exit;
	//print_r($_SESSION);exit;
	//$form_type = $_POST['form_id'];exit;
	if(isset($_POST['send_to_student']))
	{
		// echo "hello";exit;
		//print_r($_POST);exit;
		$data = $_POST['data'];
		$data['created_on'] = date('Y-m-d h:i:s');
		$data['from_id'] = $_SESSION['eschools']['user_id'];
		$data['from_type'] = $_SESSION['eschools']['login_type'];
		insert_into('es_notice_messages', $data);
		header('location: ?pid=31&action=compose');
		exit;
	}

}
if($action == 'send_notice_to_student')
{
	 //echo "hello";exit;
	if(isset($_POST['send_message_to_student']))
	{
		 //echo "hello";exit;
		//print_r($_POST);exit;
		$data = $_POST['data'];
		$data['created_on'] = date('Y-m-d h:i:s');
		$data['from_id'] = $_SESSION['eschools']['user_id'];
		$data['from_type'] = $_SESSION['eschools']['login_type'];
		insert_into('es_notice_messages', $data);
		header('location: ?pid=31&action=send_notice_to_student');
		exit;
	}

}
?>