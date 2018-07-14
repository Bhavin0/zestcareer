<?php
	if($action == 'list_enquiry')
	{
    	include'enquiry-list.php';
	}
  	if(!isset($action))
  	{
    	include'enquiry-form.php';
  	}
  	if(($action=='registration' && $disptype=="formpurchase") || ($action=="print_enquirylist"))
  	{
    	include'view-enquiry.php';
  	}
?>