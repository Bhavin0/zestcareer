<?php

for($i=0;$i<count($_POST['student_id']);$i++)
{

	mysqli_query($mysqli_con, "UPDATE es_preadmission_details SET division_id='".$_POST['division'][$i]."', scat_id=".$_POST['roll_no'][$i]." WHERE es_preadmissionid=".$_POST['student_id'][$i]." AND academic_year_id=".$_POST['academic_year']) or die(mysqli_error($mysqli_con));
}

	header('Location: ?pid=21&action=studentlist&academic_year_id='.$_POST['academic_year'].'&es_classesid=8'.$_POST['es_classesid']);
?>