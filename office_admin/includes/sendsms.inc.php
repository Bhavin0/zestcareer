<?php
sm_registerglobal('pid','action','update','emsg','start','column_name','asds_order','uid','sid','admin',
'Submit','blogDesc','title','es_date', 'update','es_messagesid','es_staffid','subject','message','submit_staff','submit_student','es_classesid','es_preadmissionid','es_adminsid','keyword','search','admin_phoneno','st_prmobno','pre_mobile1','sms_date', 'hw_class', 'hw_homework', 'sendHomework', 'a_text', 'sendtoall');
/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}


if($action == 'smssetup')
{
	if(isset($_POST['submit']))
	{
		delete_where('smsconfig', array('configid' => 1));
		$data = $_POST['data'];
		$data['configid'] = 1;
		insert_into('smsconfig', $data);

		header('Location: ?pid=62&action=smssetup');
	}
}

if($action == 'smstocustomnumber')
{
	if(isset($_POST['submit']))
	{
		$sms_detail = get_single_row('smsconfig', array('configid' => 1));
		$url = str_replace('[phone_nos]', $_POST['mobile_nos'], $sms_detail['sms_api_url']);
		$url = str_replace('[message]', $_POST['message'], $url);

		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript">
			$.ajax({url: "<?php echo $url; ?>", success: function(result){
        		//console.log(result);
        		
    		}});

    		$(document).ajaxStop(function() {
    			window.location.href = '?pid=62&action=smstocustomnumber&response=success';
			});
		</script>
		<?php
		exit;
	}
}

if($action == 'sms_student_json')
{
	$query = "SELECT `pre_name`,`middle_name`,`pre_lastname`,`pre_sms_no` FROM `es_preadmission` WHERE `es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`='".$_GET['ac_id']."' AND admission_status != 'admission_status'";

	if($_GET['section_id'] != 'all')
	{
		$query .= " AND `pre_class` IN (SELECT `es_classesid` FROM `es_classes` WHERE `es_groupid` = '".$_GET['section_id']."')";
	}

	if($_GET['class_id'] != 'all')
	{
		$query .= " AND `pre_class` = '".$_GET['class_id']."'";
	}

	if($_GET['division_id'] != 'all')
	{
		$query .= " AND `division_id` = '".$_GET['division_id']."'";
	}

	if($_GET['student_id'] != 'all')
	{
		$query .= " AND `es_preadmissionid` = '".$_GET['student_id']."'";
	}

	$query .= ")";

	$students = mysqli_query($mysqli_con, $query) or die(MYSQLI_ERROR($mysqli_con));
	$json = array();
	$i = 0;
	while($student = mysqli_fetch_assoc($students))
	{
		$json[$i]['student_name'] = $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname'];
		$json[$i]['sms_no'] = $student['pre_sms_no'];
		$i++;
	}
	echo json_encode($json);
}
?>