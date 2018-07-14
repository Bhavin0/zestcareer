<?php
sm_registerglobal('pid','action','update','emsg','start','submit','redirecturl','sudent_id','es_classesid','roll_no','section_id','update');

if(isset($_POST['submitroll_no']))
{

	for($i=0;$i<count($_POST['student_id']);$i++)
	{
		mysqli_query($mysqli_con, "UPDATE es_preadmission_details SET scat_id=".$_POST['roll_no'][$i]." WHERE es_preadmission_detailsid=".$_POST['student_id'][$i]) or die(mysqli_error($mysqli_con));
	}
	header('location: ?pid=21&action=studentlist&academic_year_id='.$_POST['academic_year'].'&es_classesid='.$_POST['es_classesid']);
	exit;
}

?>
