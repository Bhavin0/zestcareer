<?php 
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}
if ($action == 'payfee')
{ 
	ob_clean();
	include 'payfee.php';
}
if($action=='receipt_list')
{
	ob_clean();
	if(!in_array('6_7', $admin_permissions))
	{
		include'page-401.php'; exit;
	}
	include'receipt_list.php';
}
if($action=='print_receipt')
{
	ob_clean();
	if(!in_array('6_7', $admin_permissions))
	{
		include'page-401.php'; exit;
	}
	include'print_receipt.php';
}

if ($action == 'outstandingfees'||$action == 'outstandingfeesreport' || $action=='print_each_outstanding'){ 
	ob_clean();
	include'outstandingfees.php';
}

if ($action == 'fee_paid_list' || $action=="fee_paid_listprint")
{
	include'fee_paid_list.php';
}
if($action == 'ajax_receipt_edit')
{
	ob_clean();
	include'ajax_receipt_edit.php';
}
if($action == 'outstandingfees_pagination')
{
	ob_clean();
	include'outstandingfees_pagination.php';
}
if($action == 'outstandingfees_print')
{
	ob_clean();
	include'outstandingfees_print.php';
}
if($action == 'receipt_pagination')
{
	ob_clean();
	if(!in_array('6_7', $admin_permissions))
	{
		include'page-401.php'; exit;
	}
	include'receipt_pagination.php';
}
if($action == 'classwisefees')
{
	ob_clean();
	include'classwisefees.php';
}
if($action == 'classwisefees_ajax')
{
	ob_clean();
	include'classwisefees_ajax.php';
}
if($action == 'classwisefees_print')
{
	ob_clean();
	include'classwisefees_print.php';
}
if($action == 'fee_paid_list_print')
{
	ob_clean();
	include'fee_paid_list_print.php';
}
if($action == 'receipt_list_print')
{
	ob_clean();
	include'receipt_list_print.php';
}
?>