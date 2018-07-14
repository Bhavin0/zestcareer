<?php
	$sms_setup = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM tbl_sms_setup"), MYSQLI_ASSOC);

	$link = $sms_setup['tbl_sms_api_link'];
	$link = str_replace('[userid]', $sms_setup['sms_setup_user_id'], $link);
	$link = str_replace('[password]', $sms_setup['sms_setup_password'], $link);
	$link = str_replace('[senderid]', $sms_setup['sms_setup_senderid'], $link);
	$link = str_replace('[phone]', $_POST['mobile_no'], $link);
	$link = str_replace('[message]', $_POST['message'], $link);
	$link = str_replace('[priority]', $sms_setup['sms_setup_priority'], $link);
	$link = str_replace('[type]', $sms_setup['sms_setup_type'], $link);
	$link = str_replace(' ', '%20', $link);

	ob_start();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $link);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_exec($ch);
	curl_close($ch);
	$response = ob_get_contents();
	ob_clean();

	$query = "INSERT INTO `tbl_sms_to_student`(`student_id`, `message_datetime`, `message`, `response`) VALUES 
			(
				'".mysqli_real_escape_string($mysqli_con, $_POST['student_id'])."',
				'".date('Y-m-d h:m:i')."',
				'".mysqli_real_escape_string($mysqli_con, $_POST['message'])."',
				'".mysqli_real_escape_string($mysqli_con, $response)."')";
	mysqli_query($mysqli_con, $query);

	echo $response;
?>