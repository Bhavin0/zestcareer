<?php
if($action=="admission_form")
{
	$reg_No = ($db->getone("SELECT MAX(es_preadmissionid) FROM es_preadmission")+1);
	ob_clean();
	include 'admission_form.php';
}

if($action=="print_student")
{
	$student = get_single_row('es_preadmission', array('es_preadmissionid' => $_GET['student_id']));
	$academic = get_single_row('es_preadmission_details', array('es_preadmissionid' => $_GET['student_id'], 'academic_year_id' => $_GET['academic_year_id']));
	$school_detail = get_single_row('es_finance_master', array('es_finance_masterid' => $academic['academic_year_id']));
	$class_detail = get_single_row('es_classes', array('es_classesid' => $academic['pre_class']));
	$division_detail = get_single_row('isd_class_division', array('class_division_id' => $academic['division_id']));
	$section_detail = get_single_row('es_groups', array('es_groupsid' => $class_detail['es_groupid']));
	ob_clean();
	include 'print_student.php';
}

if($action=="edit_student")
{
	$student = get_single_row('es_preadmission', array('es_preadmissionid' => $_GET['student_id']));
	$academic = get_single_row('es_preadmission_details', array('es_preadmissionid' => $_GET['student_id'], 'academic_year_id' => $_GET['academic_year_id']));
	$school_detail = get_single_row('es_finance_master', array('es_finance_masterid' => $academic['academic_year_id']));
	$class_detail = get_single_row('es_classes', array('es_classesid' => $academic['pre_class']));
	$division_detail = get_single_row('isd_class_division', array('class_division_id' => $academic['division_id']));
	$section_detail = get_single_row('es_groups', array('es_groupsid' => $class_detail['es_groupid']));
	ob_clean();
	include 'edit_student.php';
}
?>