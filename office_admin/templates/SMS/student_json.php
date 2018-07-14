<?php
	$students = mysqli_query($mysqli_con, "SELECT es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission.pre_mobile_no, es_preadmission.pre_sms_no, es_preadmission.es_preadmissionid FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE es_preadmission_details.pre_class = '".$_GET['class_id']."' AND es_preadmission_details.academic_year_id ='".$_GET['ac_year']."' ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name");

	$student_list = array();

	while($student = mysqli_fetch_assoc($students))
	{
		$student_list[] = $student;
	}

	echo json_encode($student_list);
?>
