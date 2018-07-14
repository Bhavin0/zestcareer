<?php
set_time_limit(900);
$query = "SELECT es_preadmission_details.*, es_classes.es_classname, es_preadmission.grno, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission.pre_mobile1 FROM es_preadmission_details INNER JOIN es_classes ON es_classes.es_classesid = es_preadmission_details.pre_class INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid";

if(!isset($_POST['academic_year_id']))
{

	$academic_year = mysql_fetch_array(mysql_query("SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC LIMIT 1"));
	$query .= " WHERE es_preadmission_details.pre_fromdate ='".$academic_year['fi_ac_startdate']."' AND es_preadmission_details.pre_todate ='".$academic_year['fi_ac_enddate']."'";
}
else
{
	$academic_year = mysql_fetch_array(mysql_query("SELECT * FROM es_finance_master WHERE es_finance_masterid =".$_POST['academic_year_id']));
	$query .= " WHERE es_preadmission_details.pre_fromdate ='".$academic_year['fi_ac_startdate']."' AND es_preadmission_details.pre_todate ='".$academic_year['fi_ac_enddate']."'";
	if($_POST['section_id'] != 'ALL')
	{
		$query .= " AND es_classes.es_groupid = ".$_POST['section_id'];
	}
	if($_POST['class_id'] != 'ALL')
	{
		$query .= " AND es_preadmission_details.pre_class =".$_POST['class_id'];
	}
}
$students = mysql_query($query);

 	require_once('../includes/mpdf/mpdf.php');
	$mpdf = new mPDF('c');
// $mpdf->setDisplayMode('fullpage');
// $stylesheet = file_get_contents('css/core.css');
// $mpdf->WriteHTML($stylesheet,1);
// ob_start();
?>
<html>
<body onload="window.print()">
<table cellspacing="0" cellpadding="4" style="border: 1px solid black;" width="100%">
	<thead>
		<tr style="border: 1px solid black;">
			<th width="10%" style="border: 1px solid black;">Student ID</th>
			<th width="30%" style="border: 1px solid black;">Student Name</th>
			<th width="10%" style="border: 1px solid black;">GR No.</th>
			<th width="10%" style="border: 1px solid black;">Class</th>
			<th width="10%" style="border: 1px solid black;">Mobile No.</th>
			<th width="10%" style="border: 1px solid black;">Payble Fees</th>
			<th width="10%" style="border: 1px solid black;">Paid</th>
			<th width="10%" style="border: 1px solid black;">Outstanding</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while($row = mysql_fetch_assoc($students)) {
		$query1 = "SELECT SUM(fee_amount) AS payble_fees FROM es_feemaster WHERE optional = 'NO' AND fee_class = ".$row['pre_class']." AND academy_year_id =".$academic_year['es_finance_masterid'];
		$query2 = "SELECT SUM(received_amount), SUM(not_applicable), SUM(concession) FROM es_feepaid WHERE es_preadmissionid = ".$row['es_preadmissionid']." AND financemaster_id =".$academic_year['es_finance_masterid'];
		if(isset($_POST['semester_id']) && $_POST['semester_id']!='ALL')
		{
			$query1 .= " AND es_feemaster.semester_id =".$_POST['semester_id'];
			$query2 .= " AND semester_id =".$_POST['semester_id'];
		}
		$payble_fees = mysql_fetch_array(mysql_query($query1));
		if($payble_fees[0]=='') { $payble_fees[0]='0'; }
										
		$paid_fees = mysql_fetch_array(mysql_query($query2));
		if($paid_fees[0]=='') { $total_paid_fees='0'; } else { $total_paid_fees= $paid_fees[0] + $paid_fees[1] + $paid_fees[2];}

		if($payble_fees[0] - $total_paid_fees > 0) {
		?>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><?php echo $row['es_preadmissionid']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row['pre_name']." ".$row['middle_name']." ".$row['pre_lastname']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row['grno']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row['es_classname']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row['pre_mobile1']; ?></td>
				<td style="border: 1px solid black;"><?php echo $payble_fees[0]; ?></td>
				<td style="border: 1px solid black;"><?php echo $total_paid_fees; ?></td>
				<td style="border: 1px solid black;"><?php echo $payble_fees[0] - $total_paid_fees; ?></td>
			</tr>
		<?php
		}
	} ?>
	</tbody>
</table>
</body>
</html>



<?php

// $content = ob_get_contents();
// ob_end_clean();
// $mpdf->WriteHTML($content); 
// $mpdf->Output(standardize(ampersand('filename', false)) . '.pdf', 'D');
?>