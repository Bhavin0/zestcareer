<?php

sm_registerglobal('pid', 'action','emsg', 'update', 'fid', 'submit', 'fee_amount', 'admin', 'fee_class', 'fee_instalments','as_sec','as_lastdate','as_name','as_description', 'Submit','as_createdon','as_lastdate','update','es_assid','back', 'particulars','groups','selectclass','amount','instalments', 'updatefeeitem', 'newparticular', 'newamount', 'newinstalment', 'print_id','pre_year');
/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
		header('location: ./?pid=1&unauth=0');
		exit;
	}
	
if (!isset($pre_year)) {
	    $finance_res = getarrayassoc("SELECT *FROM `es_finance_master` ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1 ");
		 $finance_res ['es_finance_masterid']; 
	    $from_finance = $_SESSION['eschools']['from_finance'];
	    $to_finance = $_SESSION['eschools']['to_finance'];
	}else{
		$finance_res = getarrayassoc("SELECT * FROM `es_finance_master` WHERE `es_finance_masterid`= $pre_year");
		$from_finance = $finance_res['fi_startdate'];
		$to_finance   = $finance_res['fi_enddate']; 
	} 
	


$sql100 = mysqli_query($mysqli_con, "SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC");
$i = 0;
while( $row = mysqli_fetch_assoc($sql100))
{
    $academic_years[$i] = $row;
    $i++;
}
	

$school_details_sel = "SELECT * FROM `es_finance_master` ORDER BY `es_finance_masterid` DESC";
$school_details_res = getamultiassoc($school_details_sel);
$vlc = new FormValidation();

// Add Fields
 $obj_feesmaster = new es_feemaster();

 if ($action == 'createfeetypes' && $Submit=='Save')
 {	
 	$academy_year_id = $_POST['academy_year_id'];
 	if($_POST['section_id'] == 'All')
 	{
 		$sections = mysql_query("SELECT * FROM es_groups");
 	}
 	else
 	{
 		$sections = mysql_query("SELECT * FROM es_groups WHERE es_groupsid = ".$_POST['section_id']);
 	}

 	while($row = mysql_fetch_assoc($sections))
 	{
 		if($_POST['fee_class'] == 'All')
 		{
 			$classes = mysql_query("SELECT * FROM es_classes WHERE es_groupid = ".$row['es_groupsid']);
 		}
 		else
 		{
 			$classes = mysql_query("SELECT * FROM es_classes WHERE es_classesid = ".$_POST['fee_class']);
 		}
 		while($inner_row = mysql_fetch_assoc($classes))
 		{
 			if($_POST['semester_id'] == 'All')
 			{
 				$semesters = mysql_query("SELECT * FROM new_semesters WHERE department_id = ".$row['es_groupsid']." AND academic_year_id = ".$academy_year_id);
 			}
 			else
 			{
 				$semesters = mysql_query("SELECT * FROM new_semesters WHERE semester_id = ".$_POST['semester_id']);
 			}
 				
 			while($inner_inner_row = mysql_fetch_assoc($semesters))
 			{
 				for($i=0; $i < count($_POST['particulars']); $i++)
 				{
 					mysql_query("INSERT INTO `es_feemaster`(`academy_year_id`, `section_id`, `fee_class`, `semester_id`, `fee_particular`, `fee_amount`, `optional`, `ledger_id`) VALUES ('".$academy_year_id."', '".$row['es_groupsid']."', '".$inner_row['es_classesid']."', '".$inner_inner_row['semester_id']."', '".$_POST['particulars'][$i]."', '".$_POST['amount'][$i]."', '".$_POST['optional'][$i]."', '".$_POST['ledger'][$i]."')");
 				};
 			}
 			
 		}
 			
 	}
	header("Location:?pid=17&action=viewfees&emsg=10");	
 }
 
/**********************************************************************
* Get  groups and Classes
**********************************************************************/
//get groups
 $c_groups = get_groups();

//get classes
 if (isset($groups)&& $groups!=""){
	$class_data = getClasses($groups);
  }

  
if ($action=='deletefeeitem'){
	//$obj_feesmaster = new es_feemaster();
	$obj_feesmaster->es_feemasterId = $fid;
	$obj_feesmaster->Delete();
	
	$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,module,submodule,`record_id`,`action`,ipaddress,`posted_on`) VALUES('".$_SESSION['eschools']['admin_id']."','es_feemaster','Fee Payment','Fee Details','".$fid."','DELETE FEE','".$_SERVER['REMOTE_ADDR']."',NOW())";
	$log_insert_exe=mysql_query($log_insert_sql);
	
	$emsg = 3;
	header("Location:?pid=17&action=viewfees&emsg=".$emsg);
	exit;	
}

// get details for updating fee item
if ($action == 'edit_feeitem') {
	//$obj_feesmaster = new es_feemaster();
	$es_feemasterdet = $obj_feesmaster->Get($fid);
	//Update fee item
	
}
if ($updatefeeitem == 'Update'){
     
	if ($newamount>0 && $newparticular!=""){
		$db->update('es_feemaster', "fee_particular ='" . strtoupper($newparticular) . "',	fee_amount 	 ='" . round($newamount,2) . "', fee_instalments ='" . $newinstalment . "'", 'es_feemasterid =' . $fid);
		$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,module,submodule,`record_id`,`action`,ipaddress,`posted_on`) VALUES('".$_SESSION['eschools']['admin_id']."','es_feemaster','Fee Payment','Fee Details','".$fid."','EDIT FEE','".$_SERVER['REMOTE_ADDR']."',NOW())";
	$log_insert_exe=mysql_query($log_insert_sql);
	header("Location:?pid=17&action=viewfees&emsg=2");
	exit;
	}else{
	$errormessage[0] = "Please enter valid Amount and Particulars";
	}
	
	
 }

 if($action=='createfeetypes')
 {
 	$ledgers_rows = mysqli_query($mysqli_con, "SELECT * FROM es_ledger");
 	$i = 0;
 	while($ledger = mysqli_fetch_assoc($ledgers_rows))
 	{
 		$ledgers[$i] = $ledger;
 		$i++;
 	}
 }

 if($action == 'fee_card_generate')
 {
 	if(isset($_POST['generate_fee_card']) && $_POST['generate_fee_card'] == 'Generate')
 	{
 		//print_r($_POST);
 		$card_no_array = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT card_number FROM fee_card_numbering WHERE student_id=".$_POST['es_preadmissionid']." AND academic_year_id='".$_POST['financemaster_id']."'"), MYSQLI_ASSOC);
 		if(empty($card_no_array))
 		{
 			$max_card = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) AS card_no FROM fee_card_numbering WHERE academic_year_id=".$_POST['financemaster_id']), MYSQLI_ASSOC);
 			$card_no = $max_card['card_no'] + 1;

 			mysqli_query($mysqli_con, "INSERT INTO `fee_card_numbering`(`academic_year_id`, `student_id`, `card_number`) VALUES ('".$_POST['financemaster_id']."', '".$_POST['es_preadmissionid']."','".$card_no."')") or die(mysqli_error($mysqli_con));

 		}
 		else
 		{
 			$card_no = $card_no_array['card_number'];
 		}
 		$transportation_fees = 0;
 		$transport_concession = 0;

 		if(isset($_POST['transportation_amount']) && $_POST['transportation_amount']>0)
 		{

 			$transportation_fees = $_POST['transportation_amount'];
 			$transport_concession = $_POST['trasport_concession'];
 		}
		
		//print_r($_POST);
		mysqli_query($mysqli_con, "INSERT INTO `fm_fee_cards`(`slip_no`, `es_preadmissionid`, `card_date`, `financemaster_id`, `class_id`, `semester_id`, `received_amount`, `concession`, `transportation_fees`, `transport_concession`, `grand_total`, `not_applicable`, `bank_name`, `last_date`) VALUES ('".$card_no."', '".$_POST['es_preadmissionid']."', '".date('Y-m-d')."', '".$_POST['financemaster_id']."', '".$_POST['class_id']."', '".$_POST['semster_id']."', '".$_POST['sub_total']."', '".$_POST['total_concession']."', '".$transportation_fees."', '".$transport_concession."', '".$_POST['grand_total']."','0','".$_POST['bank_name']."','".$_POST['last_date']."')") or die(mysqli_error($mysqli_con));

		$card_id = mysqli_insert_id($mysqli_con);

		for($i = 0; $i < count($_POST['particularid']); $i++)
		{
			if(isset($_POST['applicable'][$_POST['particularid'][$i]]))
			{
				mysqli_query($mysqli_con, "INSERT INTO `fm_fee_card_childs`(`card_id`, `student_id`, `particular_id`, `particulars`, `amount`, `concession`, `total_amount`, `applicable`, `ledger_id`) VALUES ('".$card_id."', '".$_POST['es_preadmissionid']."', '".$_POST['particularid'][$i]."', '".$_POST['particulartname'][$i]."', '".$_POST['received_amount'][$i]."', '".$_POST['concession_amount'][$i]."', '".$_POST['total_amount'][$i]."','YES', '".$_POST['ledger_id'][$i]."')");

			}
			else
			{
				mysqli_query($mysqli_con, "INSERT INTO `fm_fee_card_childs`(`card_id`, `student_id`, `particular_id`, `particulars`, `amount`, `total_amount`, `applicable`, `ledger_id`) VALUES ('".$card_id."', '".$_POST['es_preadmissionid']."', '".$_POST['particularid'][$i]."', '".$_POST['particulartname'][$i]."', '".$_POST['not_applicable'][$i]."', '".$_POST['not_applicable'][$i]."','NO', '".$_POST['ledger_id'][$i]."')");

				mysqli_query($mysqli_con, "UPDATE `fm_fee_cards` SET `not_applicable`= not_applicable + ".$_POST['not_applicable'][$i]." WHERE `card_id` = ".$card_id);
			}
		}
		header("Location: ?pid=17&action=fee_cards_list&academic_year_id=".$_POST['financemaster_id']."&semester_id=".$_POST['semster_id']."&student_id=".$_POST['es_preadmissionid']);
		exit;

 	}
 }

 if($action == 'edit_card')
 {

 	if(isset($_POST['es_preadmissionid']) && $_POST['es_preadmissionid']!='')
 	{
 		mysqli_query($mysqli_con, "UPDATE fee_card_numbering SET student_id=".$_POST['es_preadmissionid']." WHERE academic_year_id=".$_POST['ac_year']." AND card_number=".$_POST['card_no']) or die(mysqli_error($mysqli_con));

 		mysqli_query($mysqli_con, "UPDATE fm_fee_cards SET es_preadmissionid=".$_POST['es_preadmissionid']." WHERE slip_no=".$_POST['card_no']." AND financemaster_id=".$_POST['ac_year']) or die(mysqli_error($mysqli_con));
 	}

	$transportation_fees = 0;
	$transport_concession = 0;

	if(isset($_POST['transportation_amount']) && $_POST['transportation_amount']>0)
	{

		$transportation_fees = $_POST['transportation_amount'];
		$transport_concession = $_POST['trasport_concession'];
	}

	mysqli_query($mysqli_con, "UPDATE `fm_fee_cards` SET `received_amount`='".$_POST['sub_total']."', `concession`='".$_POST['total_concession']."',transportation_fees=".$transportation_fees.",transport_concession=".$transport_concession.",`grand_total`='".$_POST['grand_total']."',`not_applicable`='0', bank_name='".$_POST['bank_name']."', last_date='".$_POST['last_date']."' WHERE `card_id`='".$_POST['card_id']."'");
	
	for($i = 0; $i < count($_POST['card_child_id']); $i++)
	{
		echo $_POST['card_child_id'][$i];
		if(isset($_POST['applicable'][$_POST['card_child_id'][$i]]))
		{
			mysqli_query($mysqli_con, "UPDATE `fm_fee_card_childs` SET `amount` = '".$_POST['received_amount'][$i]."', `concession` = '".$_POST['concession_amount'][$i]."', `total_amount`='".$_POST['total_amount'][$i]."', `applicable`='YES' WHERE card_child_id='".$_POST['card_child_id'][$i]."'");
			echo "UPDATE `fm_fee_card_childs` SET `amount` = '".$_POST['received_amount'][$i]."', `concession` = '".$_POST['concession_amount'][$i]."', `total_amount`='".$_POST['total_amount'][$i]."', `applicable`='YES' WHERE card_child_id='".$_POST['card_child_id'][$i]."'";
		}
		else
		{
			mysqli_query($mysqli_con, "UPDATE `fm_fee_card_childs` SET `amount` = '".$_POST['not_applicable'][$i]."', `concession` = '0', `total_amount`='".$_POST['not_applicable'][$i]."', `applicable`='NO' WHERE card_child_id='".$_POST['card_child_id'][$i]."'");

			mysqli_query($mysqli_con, "UPDATE `fm_fee_cards` SET `not_applicable`= not_applicable + ".$_POST['not_applicable'][$i]." WHERE `card_id` = ".$card_id);
		}
	}
	header("Location: ?pid=17&action=fee_cards_list");
	exit;
 }
  
if($action == 'generate_receipt')
{
	$card = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT fm_fee_cards.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname FROM fm_fee_cards INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = fm_fee_cards.es_preadmissionid WHERE fm_fee_cards.card_id=".$_GET['card_id']), MYSQLI_ASSOC);
	if($card['receipt_id']=='')
	{
		$card_childs = mysqli_query($mysqli_con,"SELECT fm_fee_card_childs.*, es_feemaster.ledger_id FROM fm_fee_card_childs INNER JOIN es_feemaster ON es_feemaster.es_feemasterid = fm_fee_card_childs.particular_id WHERE card_id=".$_GET['card_id']);

		$transport_fee = get_single_row('transport_student_allocation', array('acdemic_year_id' => $card['financemaster_id'], 'student_id' => $card['es_preadmissionid']), 'transport_student_allocation_id', 'DESC');


		mysqli_query($mysqli_con, "INSERT INTO `es_voucherentry`(`es_vouchertype`, `es_voucherno`, `es_voucherdate`, `es_paymentmode`, `es_ledger`, `es_amount_in`, `opposite_partyname`) VALUES ('Receipt', '".$_GET['card_id']."', '".date('Y-m-d')."', 'Bank', 'School Fees', '".$card['grand_total']."', '".$card['pre_name']." ".$card['middle_name']." ".$card['pre_lastname']."')");

		$voucher_id = mysqli_insert_id($mysqli_con);

		mysqli_query($mysqli_con, "INSERT INTO `es_feepaid`(`es_preadmissionid`, `receipt_no`, `receipt_date`, `financemaster_id`, `class_id`, `semester_id`, `received_amount`, `concession`, `fine`, `transportation_fees`, `transport_concession`, `grand_total`, `payment_mode`, `voucherid`) VALUES ('".$card['es_preadmissionid']."', '".$_GET['card_id']."', '".date('Y-m-d')."', '".$card['financemaster_id']."', '".$card['class_id']."', '".$card['semester_id']."', '".$card['received_amount']."', '".$card['concession']."', '".$card['fine']."', '".$card['transportation_fees']."', '".$card['transport_concession']."', '".$card['grand_total']."', 'Bank Deposit', '".$voucher_id."')");

		$fees_id = mysqli_insert_id($mysqli_con);

		if(!empty($transport_fee))
		{
			$actual_transport = $card['transportation_fees'] - $card['transport_concession'];
			mysqli_query($mysqli_con, "UPDATE `transport_student_allocation` SET
						received_amount = received_amount+".$card['transportation_fees'].",
						concession = concession+".$card['transport_concession'].",
						actual_received = actual_received+".$actual_transport."
						WHERE transport_student_allocation_id=".$transport_fee['transport_student_allocation_id']) or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "INSERT INTO `ledger_entries`(`es_ledger_id`, `es_voucher_id`, `ledger_detail`, `amount_in`) VALUES ('".$transport_fee['ledger_id']."', '".$voucher_id."', 'Transportation Fees', '".$actual_transport."')") or die(mysqli_error($mysqli_con));
		}
		

		mysqli_query($mysqli_con, "UPDATE `fm_fee_cards` SET `receipt_id`='".$fees_id."' WHERE `card_id`='".$_GET['card_id']."'");


		while($card_child = mysqli_fetch_assoc($card_childs))
		{
			if($card_child['applicable']=='YES')
			{
				mysqli_query($mysqli_con, "INSERT INTO `es_feepaid_new_details`(`fid`, `student_id`, `particular_id`, `particulars`, `amount`, `concession`, `total_amount`, `applicable`) VALUES ('".$fees_id."', '".$card['es_preadmissionid']."', '".$card_child['particular_id']."', '".$card_child['particulars']."', '".$card_child['amount']."', '".$card_child['concession']."', '".$card_child['total_amount']."','YES')");

				if($card_child['total_amount'] != 0)
				{
					mysqli_query($mysqli_con, "INSERT INTO `ledger_entries`(`es_ledger_id`, `es_voucher_id`, `ledger_detail`, `amount_in`) VALUES ('".$card_child['ledger_id']."', '".$voucher_id."', '".$card_child['particulars']."', '".$card_child['total_amount']."')");
				}

			}
			else
			{
				mysqli_query($mysqli_con, "INSERT INTO `es_feepaid_new_details`(`fid`, `student_id`, `particular_id`, `particulars`, `amount`, `total_amount`, `applicable`) VALUES ('".$fees_id."', '".$card['es_preadmissionid']."', '".$card_child['particular_id']."', '".$card_child['particulars']."', '".$card_child['amount']."', '".$card_child['amount']."', 'NO')");

				mysqli_query($mysqli_con, "UPDATE `es_feepaid` SET `not_applicable`= not_applicable + ".$card_child['amount']." WHERE `fid` = ".$fees_id);
			}
		}
	}

	header("Location: ?pid=40&action=receipt_list&academic_year_id=".$card['financemaster_id']."&semester_id=".$card['semester_id']."&student_id=".$card['es_preadmissionid']);
}
if($action == 'viewfees_pagination')
{
 	$ledgers_rows = mysqli_query($mysqli_con, "SELECT * FROM es_ledger");
 	$i = 0;
 	while($ledger = mysqli_fetch_assoc($ledgers_rows))
 	{
 		$ledgers[$i] = $ledger;
 		$i++;
 	}
}
if($action == 'update_fee')
{
	mysqli_query($mysqli_con, "UPDATE `es_feemaster` SET `fee_particular`='".$_GET['particular']."',`fee_amount`='".$_GET['amount']."',`ledger_id`='".$_GET['ledger']."' WHERE `es_feemasterid`=".$_GET['particular_id']);
}
if($action == 'delete_fee')
{
	mysqli_query($mysqli_con, "DELETE FROM `es_feemaster` WHERE `es_feemasterid`=".$_GET['particular_id']);
}
?>