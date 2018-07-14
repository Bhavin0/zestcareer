<?php
sm_registerglobal('pid','action','update','emsg','start','submit_from','redirecturl','sno1','date','student_name','father_name','class_name','section','caste','passed_trial','place_of_birth','rank','dob','charector','status','created_on','conduct','id','update','es_preadmissionid','es_classesid');
/**
* Only Admin users can view the pages
*/

if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}

if($action == 'add')
{
	if(isset($_POST['submit_from']))
	{
		$query = "INSERT INTO `es_bonafied`(`date`, `academic_year`, `class_id`, `student_id`, `student_name`, `father_name`, `dob`, `place_of_birth`, `caste`, `grno`, `passed_standard`, `trials`, `progress`, `conduct`, `status`, `created_on`) VALUES ('".date('Y-m-d')."', '".$_POST['academic_year']."', '".$_POST['es_classesid']."', '".$_POST['es_studentid']."', '".$_POST['student_name']."', '".$_POST['father_name']."', '".$_POST['dob']."', '".$_POST['place_of_birth']."', '".$_POST['caste']."', '".$_POST['grno']."', '".$_POST['passed_standard']."', '".$_POST['trials']."', '".$_POST['progress']."', '".$_POST['conduct']."', 'Active', '".date('Y-m-d h:m:i')."')";
		mysqli_query($mysqli_con, $query);

		header('location: ?pid=117&action=list');
		exit;
	}
}

	

?>
