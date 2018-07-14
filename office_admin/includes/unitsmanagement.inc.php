<?php

sm_registerglobal('pid', 'action','emsg','es_subjectid','es_classesid','addunit','unit_name','classesid','subjectid','searchunit','uid','updateunit','addunitslist');

/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}
if(isset($addunitslist) && $addunitslist!=""){
header("location:?pid=51&action=addunit");

}

 if($action == 'add_study_material')
 {
 	//echo "hello";exit;
		 	if(isset($_POST['submit']))
		{
			//print_r($_POST);exit;
			$data = $_POST['data']; 
			//print_r($data);exit;
			$data['person_type'] = 'admin';
			$data['created_by'] = $_SESSION['eschools']['admin_id'];
			$es_studymaterialid = insert_into('es_studymaterial', $data);

			if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '')
			{
				$name = $_FILES["attachment"]["name"];
				$ext = end((explode(".", $name)));
				$destination = "../uploads/study_materials/".$es_studymaterialid.".".$ext;
				move_uploaded_file($_FILES["attachment"]["tmp_name"], $destination);

				update_where('es_studymaterial', array('sm_attachment' => $ext), array('es_studymaterialid' => $es_studymaterialid));
			}


			header('location: ?pid=51&action=view_material');
			exit;
		}
	}

	if(isset($_POST['edit_material']))
{
	$data = $_POST['data'];
	update_where('es_studymaterial', $data, array('es_studymaterialid' => $_GET['studymaterialid']));

	if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '')
	{
		$name = $_FILES["attachment"]["name"];
		$ext = end((explode(".", $name)));
		$destination = "../uploads/study_materials/".$_GET['studymaterialid'].".".$ext;
		if(file_exists($destination))
		{
			unlink($destination);
		}
		move_uploaded_file($_FILES["attachment"]["tmp_name"], $destination);

		update_where('es_studymaterial', array('sm_attachment' => $ext), array('es_studymaterialid' => $_GET['studymaterialid']));
	}


	header('location: ?pid=51&action=view_material');
	exit;
}

if($_GET['action'] == 'delete_material')
{
	update_where('es_studymaterial', array('status' => 'deleted'), array('es_studymaterialid' => $_GET['studymaterialid']));
	header('location: ?pid=51&action=view_material');
	exit;
}
 
if($action=="deleteunit"){

			//$db->delete('es_units','unit_id=' . $uid);
			
			
			 
			
						$db->update('es_units', "status ='deleted'", 'unit_id =' . $uid);

				$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`) VALUES('".$_SESSION['eschools']['admin_id']."','es_units','TUTORIALS','ADD UNITS','".$uid."','UNIT DELETED','".$_SERVER['REMOTE_ADDR']."',NOW())";
	$log_insert_exe=mysql_query($log_insert_sql);
	
			header("location:?pid=51&action=list&emsg=3&classesid=".$classesid."&subjectid=".$subjectid."&searchunit=Submit");
			exit;
}
if(isset($addunit) && $addunit!=""){
		if (empty($es_classesid)) {
		$errormessage[0]="Select Class";	  
		}
		if (empty($es_subjectid)) {
		$errormessage[1]="Select Subject";	  
		}
		if (empty($unit_name)) {
		$errormessage[2]="Enter Unit Name";	  
		}
		if($es_classesid!="" && $es_subjectid!="" && $unit_name!=""){
		$count=$db->getOne("select * from es_units where es_classesid=".$es_classesid." AND  es_subjectid =".$es_subjectid." AND unit_name ='".$unit_name."'");
		if($count>0){
		$errormessage[3]="Unit Name Already Exist";	  
		}
		}
		if(count($errormessage)==0){
		$today=date("Y-m-d");
		 $photo_array = array(
							'es_classesid' 	=> $es_classesid,
							'es_subjectid' 	=> $es_subjectid,							
							'unit_name' 	=> $unit_name,
							'created_on'	=> $today
						 );
						 $photo_array = stripslashes_deep($photo_array);
			$rec_id=$db->insert('es_units',$photo_array);
			
			// logs inserting
		
		$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`) VALUES('".$_SESSION['eschools']['admin_id']."','es_units','TUTORIALS','ADD UNITS','".$rec_id."','UNIT ADDED','".$_SERVER['REMOTE_ADDR']."',NOW())";
		
	$log_insert_exe=mysql_query($log_insert_sql);
	
			header("Location:?pid=51&action=list&emsg=1");
	 		exit;
	}
	}
if(isset($updateunit) && $updateunit!=""){
		if (empty($es_classesid)) {
		$errormessage[0]="Select Class";	  
		}
		if (empty($es_subjectid)) {
		$errormessage[1]="Select Subject";	  
		}
		if (empty($unit_name)) {
		$errormessage[2]="Enter Unit Name";	  
		}
		if($es_classesid!="" && $es_subjectid!="" && $unit_name!=""){
		$count=$db->getOne("select * from es_units where es_classesid=".$es_classesid." AND  es_subjectid =".$es_subjectid." AND unit_name ='".$unit_name."' AND unit_id!=". $uid);
		if($count>0){
		$errormessage[3]="Unit Name already Exist";	  
		}
		}
		if(count($errormessage)==0){
		$today=date("Y-m-d");
			$db->update('es_units', "es_classesid ='" . $es_classesid . "',es_subjectid ='" . $es_subjectid . "',unit_name ='" . $unit_name . "'", 'unit_id =' . $uid);
			
			
			
			// logs inserting
		
		$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`) VALUES('".$_SESSION['eschools']['admin_id']."','es_units','TUTORIALS','ADD UNITS','".$uid."','UNIT UPDATED','".$_SERVER['REMOTE_ADDR']."',NOW())";
		
	$log_insert_exe=mysql_query($log_insert_sql);
	
	
			header("Location:?pid=51&action=list&emsg=2");
	 		exit;
	}
	}
if($action=='updateunits'){
$editunits=$db->getRow("select * from es_units where unit_id=". $uid);
}
$classlistarr = $db->getRows("SELECT * FROM `es_classes` ORDER BY `es_classesid` ASC");

if($action=='list' || $action=='print_list'){
	if(isset($searchunit) && $searchunit!=""){
	if (empty($classesid)) {
		$errormessage['classesid']="Select Class";	  
		}
		
		if (empty($subjectid)) {
		$errormessage['subjectid']="Select Subject";	  
		}
		if(count($errormessage)==0){
	
		if($subjectid !="" && $classesid!=""){
			
				$unitsarr = $db->getRows("SELECT u.*,c.es_classname,s.es_subjectname FROM `es_classes` c, `es_units` u, `es_subject` s WHERE u.es_subjectid=s.es_subjectid AND s.es_subjectshortname=c.es_classesid AND s.es_subjectid='".$subjectid."' AND c.es_classesid='".$classesid."' AND u.status!='deleted' ORDER BY `es_classesid` ASC");
		}
		}

}

}

if($_GET['action'] == 'view_material')
{
	$query_1 = "SELECT `es_studymaterial`.*, `es_classes`.`es_classname`, `es_subject`.`es_subjectname`, CONCAT(`es_admins`.`admin_fname`,' ',`es_admins`.`admin_lname`) AS `person_created` FROM `es_studymaterial` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_studymaterial`.`sm_class_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_studymaterial`.`sm_subject_id` INNER JOIN `es_admins` ON `es_admins`.`es_adminsid` = `es_studymaterial`.`created_by` WHERE `es_studymaterial`.`status`='active' AND `es_studymaterial`.`person_type` = 'admin'";

	$query_2 = "SELECT `es_studymaterial`.*, `es_classes`.`es_classname`, `es_subject`.`es_subjectname`, CONCAT(`es_staff`.`st_firstname`,' ',`es_staff`.`st_lastname`) AS `person_created` FROM `es_studymaterial` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_studymaterial`.`sm_class_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_studymaterial`.`sm_subject_id` INNER JOIN `es_staff` ON `es_staff`.`es_staffid` = `es_studymaterial`.`created_by` WHERE `es_studymaterial`.`status`='active' AND `es_studymaterial`.`person_type` = 'teacher'";

	$query = "(".$query_1.") UNION ALL (".$query_2.") ORDER BY `es_studymaterialid` DESC";

	$materials = mysqli_query($mysqli_con, $query) or die(MYSQLI_ERROR($mysqli_con));
}

?>