<?php
// Only Admin users can view the pages
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) 
{
	header('location: ./?pid=1&unauth=0');
	exit;
}

if(isset($action))
{
	if($action=='createfeetypes' && (!in_array('6_1', $admin_permissions)))
	{
		include'page-401.php'; exit;
	}
	if($action=='viewfees' && (!in_array('6_2', $admin_permissions)))
	{
		include'page-401.php'; exit;
	}
	if($action=='fee_cards' && (!in_array('6_3', $admin_permissions)))
	{
		include'page-401.php'; exit;
	}
	if($action=='fee_cards_list' && (!in_array('6_4', $admin_permissions)))
	{
		include'page-401.php'; exit;
	}

	include $action.'.php';
}	

?>