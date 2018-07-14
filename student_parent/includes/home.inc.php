<?php 
include_once (INCLUDES_CLASS_PATH . DS . 'class.es_preadmission.php');
sm_registerglobal('pid', 'action','update','column_name','start','asds_order','submit','search','Submit','Search','pre_class','pre_year');

if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}
$q= $_SESSION['eschools']['from_acad'];
if($action=='birthday_students'){

$today = date("Y-m-d");
list($year, $month) = explode('-', date('Y-n'));

 $date = getdate();
 $year = $date['year'];
 $month = $date['mon'];



  $sql_todaybirth = "SELECT * FROM es_preadmission  WHERE  pre_status!= 'inactive' ORDER BY DAYOFMONTH(pre_dateofbirth)";
   $students_det = $db->getrows($sql_todaybirth);

} 
else
{
	$current_year_students = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM es_preadmission_details WHERE academic_year_id=2"), MYSQLI_NUM);
	$new_students =  mysqli_fetch_array(mysqli_query($mysqli_con,"SELECT COUNT(*) FROM es_preadmission_details WHERE academic_year_id=2 AND admission_status='newadmission'"), MYSQLI_NUM);
	$total_staff = mysqli_fetch_array(mysqli_query($mysqli_con,"SELECT COUNT(*) FROM es_staff WHERE status='added'"), MYSQLI_NUM);
	$staff_absent = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT count(*) FROM es_attend_staff WHERE at_staff_date='".date('Y-m-d')."' AND at_staff_attend='A'"));

	$fees_receipt = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT count(*) FROM es_feepaid WHERE receipt_date='".date('Y-m-d')."' AND status='active'"), MYSQLI_NUM);

	$receipt_amount = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT SUM(grand_total) FROM es_feepaid WHERE receipt_date='".date('Y-m-d')."' AND status='active'"), MYSQLI_NUM);

	$inventory_requests = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT count(*) FROM es_in_goods_issue_requests WHERE status='Pending'"), MYSQLI_NUM);

	$inventory_today = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT count(*) FROM es_in_goods_issue_requests WHERE status='Pending' AND in_issue_date='".date('Y-m-d')."'"), MYSQLI_NUM);

	$birthdays = $db->getRows("SELECT * FROM `es_preadmission` WHERE DAY(pre_dateofbirth)=DAY(CURDATE()) AND MONTH(pre_dateofbirth)=MONTH(CURDATE())");

	$notices = mysqli_query($mysqli_con, "SELECT * FROM es_notice ORDER BY es_noticeId  DESC LIMIT 0,5");

	$holidays = mysqli_query($mysqli_con, "SELECT * FROM es_holidays WHERE holiday_date >= '".date('Y-m-d')."'");
}
 
?>