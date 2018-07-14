<?php
sm_registerglobal_no('pid', 'action','update', 'uid', 'pre_serialno', 'pre_student_username', 'pre_student_password', 'pre_dateofbirth', 'pre_dateofbirth1', 'pre_fathername', 'pre_mothername', 'pre_fathersoccupation','pre_fathersoccupation2', 'pre_motheroccupation','pre_motheroccupation2', 'pre_contactname1', 'pre_contactno1', 'pre_contactno2', 'pre_contactname2', 'pre_address1', 'pre_city1', 'pre_state1', 'pre_country1', 'pre_phno1', 'pre_mobile1', 'pre_prev_acadamicname', 'pre_prev_class', 'pre_prev_university', 'pre_prev_percentage', 'pre_prev_tcno', 'pre_current_acadamicname', 'pre_current_class1', 'pre_current_percentage1', 'pre_current_result1', 'pre_current_class2', 'pre_current_percentage2', 'pre_current_result2', 'pre_current_class3', 'pre_current_percentage3', 'pre_current_result3', 'pre_physical_details', 'pre_height', 'pre_weight', 'pre_alerge', 'pre_physical_status', 'pre_special_care', 'pre_class', 'pre_sec', 'pre_name', 'pre_age', 'pre_address', 'pre_city', 'pre_state', 'pre_country', 'pre_phno', 'pre_mobile', 'pre_resno', 'pre_resno1', 'pre_image', 'test1', 'test2', 'test3', 'pre_pincode1', 'pre_pincode','pre_mobile','pre_country', 'newpreadmission','transport','boardid', 'pre_emailid', 'pre_pincode', 'pre_fromdate','es_user_theme', 'pre_todate', 'emsg', 'Submit','pre_blood_group','pre_hobbies','pre_gender','acad_year','caste_id','ann_income','scat_id','tr_place_id','document_deposited','admission_date','admission_date1','fee_concession','old_balance','es_home','admission_status','es_econbackward','es_econbackward1','es_econbackward2','es_econbackward3','es_econbackward4','es_econbackward5','pre_number','searchsch','group','schoolname','admission_id','school_id','pre_lastname','pre_placeofbirth','pre_contactno','pre_contactno3','pre_resno2','pre_resno2','pre_emailid2','middle_name','pre_dateofbirth3','pre_dateofbirth2','grno','board','edugap','reason','reason12','pre_schl1','enrlno1','yearfrom1','yearupto1','reason1','pre_schl2','enrlno2','yearfrom2','yearupto2','reason2');

	if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
		header('location: ./?pid=1&unauth=0');
		exit;
	}

	if(isset($_POST['Submit']))
	{
		$response = array();
		$class_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_classesid =".$_POST['pre_class']));
		$minimum_date = date('Y-m-d', strtotime('-'.$class_detail['minimum_age']));

		if($_POST['data']['pre_dateofbirth'] > $minimum_date)
		{
			$response['pre_dateofbirth'] = "Student should must be ".$class_detail['minimum_age']." old";
		}

		$is_username_valid = mysqli_query($mysqli_con, "SELECT * FROM `es_preadmission` WHERE `pre_student_username` = '".$_POST['data']['pre_student_username']."'");

		if(mysqli_num_rows($is_username_valid) > 0)
		{
			$response['pre_student_username'] = "Username already exist.";
		}
		
		if(!empty($response))
		{
			echo json_encode($response);
			exit;
		}

		$admission_id = insert_into('es_preadmission', $_POST['data']);

		$preadmission_details['es_preadmissionid'] = $admission_id;
		$preadmission_details['academic_year_id'] = $_POST['academic_year'];
		$preadmission_details['pre_class'] = $_POST['pre_class'];
		$preadmission_details['status'] = 'pass';
		$preadmission_details['admission_status'] = 'newadmission';
		$preadmission_details['division_id'] = $_POST['division'];

		insert_into('es_preadmission_details', $preadmission_details);

		echo"success";


		//header('Location: ?pid=21&action=studentlist&academic_year_id='.$_POST['academic_year'].'&pre_class='.$_POST['pre_class'].'&division_id='.$_POST['division']);
		exit;

	}

	if(isset($_POST['update']))
	{
		$response = array();
		$class_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_classesid =".$_POST['pre_class']));
		$minimum_date = date('Y-m-d', strtotime('-'.$class_detail['minimum_age']));

		if($_POST['data']['pre_dateofbirth'] > $minimum_date)
		{
			$response['pre_dateofbirth'] = "Student should must be ".$class_detail['minimum_age']." old";
		}

		$is_username_valid = mysqli_query($mysqli_con, "SELECT * FROM `es_preadmission` WHERE `pre_student_username` = '".$_POST['data']['pre_student_username']."' AND es_preadmissionid!=".$_GET['student_id']);

		if(mysqli_num_rows($is_username_valid) > 0)
		{
			$response['pre_student_username'] = "Username already exist.";
		}
		
		if(!empty($response))
		{
			echo json_encode($response);
			exit;
		}

		update_where('es_preadmission', $_POST['data'], array('es_preadmissionid' => $_GET['student_id']));

		echo"success";


		//header('Location: ?pid=21&action=studentlist&academic_year_id='.$_POST['academic_year'].'&pre_class='.$_POST['pre_class'].'&division_id='.$_POST['division']);
		exit;

	}
?> 