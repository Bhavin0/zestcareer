<?php 
sm_registerglobal('pid', 'action', 'emsg', 'update', 'getstudetails', 'studentid', 'student_id', 'stuclass', 'feemasterid', 'feepartuclars', 'feeamountpaid', 'total_payable','Submitpayform', 'selfeetypecheck', 'feepartuclarid', 'sid', 'start', 'pre_class', 'dc1', 'dc2', 'Search', 'comments', 'todat', 'fromdat', 'es_vouchertype','vocturetypesel', 'es_receiptno', 'es_narration', 'es_particulars', 'es_amount', 'es_checkno', 'es_vouchermode', 'es_bankacc', 'es_paymentmode', 'es_receiptdate','es_paymentmode', 'es_ledger', 'es_bank_pin', 'es_bank_name', 'es_teller_number', 'es_installment','feecategories','print_cat','pre_class','pre_year','school_year','fee_school_year','from_finan','to_finan','finecharged','finepaid','finededucted','fee_waived','dc1','dc2','search_all_otherfines','es_preadmissionid','get_student_receipts','rid','fee_instalments','get_fee_card','prev_class','misc_actual','misc_fine_paid','misc_fine_waived','tptfee_actual','tptfee_paid','tptfee_waived','st_sale_actual','st_sale_paid','st_sale_waived','book_fine_actual','book_fine_paid','book_fine_waived','hostel_fee_actual','hostel_fee_paid','hostel_fee_waived','old_bal_actual','old_bal_paid','old_bal_waived','otherfine_id','tptfeeid','st_pay_id','es_libbookfinedetid','es_hostel_charges_id','fine_name','due_month','invoice_no','lfp','es_hostel_month','ob_id','submit_fee_status','cash_paid','total_amount','exam_fee','exam_fee_id','fine_name','fee_concession','ofid','total_fine_amount','fine_payable','fine_amount','allname', 'total_payment', 'remaining_after_current', 'remaining', 'fine_payable', 'fcp_search_student', 'fcp_reg_no', 'fcp_fin_year', 'studentid', 'cfc_fin_year', 'cfc_pre_class');

	if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" )
	{
		header('location: ./?pid=1&unauth=0');
		exit;
	}

	if (!isset($pre_year) ) {
	   $from_acad    = $_SESSION['eschools']['from_acad'];
	   $to_acad      = $_SESSION['eschools']['to_acad'];
	   $from_finance = $_SESSION['eschools']['from_finance'];
	   $to_finance   = $_SESSION['eschools']['to_finance']; 
	}else{ 
	     $fi_res = getarrayassoc("SELECT * FROM `es_finance_master` ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1 ");
		 $current_yearid = $fi_res ['es_finance_masterid'];
		 $finance_res  = getarrayassoc("SELECT * FROM `es_finance_master` WHERE `es_finance_masterid`= $pre_year");
		 $from_finance = $finance_res['fi_startdate'];
		 $to_finance   = $finance_res['fi_enddate']; 
		 $from_acad    = $finance_res['fi_ac_startdate'];
		 $to_acad      = $finance_res['fi_ac_enddate'];
	} 
	if(isset($school_year)){
         $finance_res = getarrayassoc("SELECT * FROM `es_finance_master` WHERE `es_finance_masterid`= $school_year");
		 $from_finance = $finance_res['fi_startdate'];
		 $to_finance   = $finance_res['fi_enddate']; 
	}	

	$school_details_sel = "SELECT * FROM `es_finance_master` ORDER BY `es_finance_masterid` DESC";
	$school_details_res = getamultiassoc($school_details_sel);

if($action == 'payfee')
{
	if($_POST['getstudetails'] == 'Go')
	{
		$receipt_no = mysql_fetch_array(mysql_query("SELECT fid FROM es_feepaid_new ORDER BY fid DESC LIMIT 1"));

		$student_detail = mysql_fetch_array(mysql_query("SELECT * FROM es_preadmission WHERE es_preadmissionid = '".$_POST['studentid']."' LIMIT 1"));

		$academicyear = mysql_fetch_array(mysql_query("SELECT * FROM es_finance_master WHERE es_finance_masterid = '".$_POST['pre_year']."' LIMIT 1"));

		$classname = mysql_fetch_array(mysql_query("SELECT es_classname FROM es_classes WHERE es_classesid = '".$_POST['class']."' LIMIT 1"));

		$semesters = mysql_fetch_array(mysql_query("SELECT name FROM new_semesters WHERE semester_id = '".$_POST['semesters']."' LIMIT 1"));
	}

	if ($_POST['pay_fee']=='PAY')
	{
		$receipt_number = $_POST['receipt_no'];
		if($_POST['receipt_no']=='')
		{
			if(isset($_POST['transportation_amount']) && $_POST['transportation_amount']>0)
			{
				$series = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT pre_fix FROM fees_series WHERE section=".mysqli_real_escape_string($mysqli_con, $_POST['section_id'])." AND fees_type='Transportation Fees'"), MYSQLI_ASSOC) or die(mysqli_error($mysqli_con));
			}
			else
			{
				for($i = 0; $i < count($_POST['particularid']); $i++)
				{
					$flag = 'false';
					if(isset($_POST['applicable'][$_POST['particularid'][$i]]) && $_POST['received_amount'][$i]>0)
					{
						$series = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT pre_fix FROM fees_series WHERE section=".mysqli_real_escape_string($mysqli_con, $_POST['section_id'])." AND fees_type LIKE '%".mysqli_real_escape_string($mysqli_con, $_POST['particulartname'][$i])."%'"), MYSQLI_ASSOC) or die(mysqli_error($mysqli_con));

						if(!empty($series)) { $flag = 'true'; }
					}

					if($flag == 'true') { break; }
				}

				$receipt_no = $series['pre_fix'].date_format(date_create($_POST['ve_fromfinance']),'Y').'-'.date_format(date_create($_POST['ve_tofinance']),'y');

				$number = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) AS number FROM es_feepaid WHERE receipt_no LIKE '".mysqli_real_escape_string($mysqli_con, $receipt_no)."%'"), MYSQLI_NUM) or die(mysqli_error($mysqli_con));

				if($number[0]!=0)
				{
					$num_id = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT receipt_no FROM es_feepaid WHERE receipt_no LIKE '".mysqli_real_escape_string($mysqli_con, $receipt_no)."%' ORDER BY fid DESC"), MYSQLI_NUM) or die(mysqli_error($mysqli_con));
					preg_match_all('/\d+/', $num_id[0], $num);
					$numbers = end($num[0]);
					$numbers++;
				}
				else
				{
					$numbers = 1;
				}
				$receipt_number = $receipt_no."/".$numbers;
			}
		}
		else
		{
			$receipt_number = $_POST['receipt_no'];
		}

		mysqli_query($mysqli_con, "INSERT INTO `es_voucherentry`(`es_vouchertype`, `es_voucherno`, `es_voucherdate`, `es_paymentmode`, `es_ledger`, `es_amount_in`, `opposite_partyname`) VALUES (
						'Receipt',
						'".mysqli_real_escape_string($mysqli_con, $receipt_number)."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['payment_mode'])."',
						'School Fees',
						'".mysqli_real_escape_string($mysqli_con, $_POST['grand_total'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['payer_name'])."')") or die(mysqli_error($mysqli_con));

		$voucher_id = mysqli_insert_id($mysqli_con);

		if($_POST['payment_mode'] == 'Cash')
		{
			$voucher_narration = '';

			$voucher_bank = 'NULL';

			mysqli_query($mysqli_con, "INSERT INTO `es_feepaid`(`es_preadmissionid`, `receipt_no`, `receipt_date`, `financemaster_id`, `class_id`, `semester_id`, `received_amount`, `concession`, `fine`, `grand_total`, `payment_mode`, `voucherid`, `es_remarks`) VALUES (
						'".mysqli_real_escape_string($mysqli_con, $_POST['es_preadmissionid'])."',
						'".mysqli_real_escape_string($mysqli_con, $receipt_number)."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['financemaster_id'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['class_id'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['semster_id'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['sub_total'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['total_concession'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['fine_amount'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['grand_total'])."',
						'Cash',
						'".mysqli_real_escape_string($mysqli_con, $voucher_id)."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['remarks'])."')") or die(mysqli_error($mysqli_con));

			$fees_id = mysqli_insert_id($mysqli_con);
		}

		if($_POST['payment_mode'] == 'Cheque')
		{
			$voucher_narration = "Cheque No. : ".$_POST['cheque_no']."<br>Bank : ".$_POST['student_bank_name']."<br>Account : ".$_POST['payee_name']."<br>Account No. : ".$_POST['student_account_no'];

			$voucher_bank = 'NULL';

			mysqli_query($mysqli_con, "INSERT INTO `es_feepaid`(`es_preadmissionid`, `receipt_no`, `receipt_date`, `financemaster_id`, `class_id`, `semester_id`, `received_amount`, `concession`, `fine`, `grand_total`, `payment_mode`, `voucherid`, `es_remarks`, `cheque_bank_name`, `cheque_account_no`, `cheque_account_name`, `cheque_no`) VALUES (
					'".mysqli_real_escape_string($mysqli_con, $_POST['es_preadmissionid'])."',
					'".mysqli_real_escape_string($mysqli_con, $receipt_number)."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['financemaster_id'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['class_id'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['semster_id'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['sub_total'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['total_concession'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['fine_amount'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['grand_total'])."',
					'Cheque',
					'".mysqli_real_escape_string($mysqli_con, $voucher_id)."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['remarks'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['student_bank_name'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['student_account_no'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['payee_name'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['cheque_no'])."')") or die(mysqli_error($mysqli_con));

			$fees_id = mysqli_insert_id($mysqli_con);
		}

		if($_POST['payment_mode'] == 'Bank Deposit')
		{
			$voucher_narration = "Bank : ".$_POST['school_bank_name']."<br>Account : ".$_POST['school_account_no']."<br>Depositor : ".$_POST['dipositor_name']."<br>Slip No. / Transection ID. : ".$_POST['slip_no'];

			$voucher_bank = $_POST['school_bank_name']."<br>(".$_POST['school_account_no'].")";

			mysqli_query($mysqli_con, "INSERT INTO `es_feepaid`(`es_preadmissionid`, `receipt_no`, `receipt_date`, `financemaster_id`, `class_id`, `semester_id`, `received_amount`, `concession`, `fine`, `grand_total`, `payment_mode`, `voucherid`, `es_remarks`, `school_bank_name`, `school_bank_account_no`, `depositor_name`, `desposit_slip_no`) VALUES (
						'".mysqli_real_escape_string($mysqli_con, $_POST['es_preadmissionid'])."',
						'".mysqli_real_escape_string($mysqli_con, $receipt_number)."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['financemaster_id'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['class_id'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['semster_id'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['sub_total'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['total_concession'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['fine_amount'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['grand_total'])."',
						'Bank Deposit',
						'".mysqli_real_escape_string($mysqli_con, $voucher_id)."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['remarks'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['school_bank_name'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['school_account_no'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['dipositor_name'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['slip_no'])."')") or die(mysqli_error($mysqli_con));

			$fees_id = mysqli_insert_id($mysqli_con);

		}

		if($_POST['payment_mode'] == 'DD')
		{
			$voucher_narration = "DD No. : ".$_POST['dd_no']."<br>Depositor : ".$_POST['dd_depositor'];

			$voucher_bank = 'NULL';

			mysqli_query($mysqli_con, "INSERT INTO `es_feepaid`(`es_preadmissionid`, `receipt_no`, `receipt_date`, `financemaster_id`, `class_id`, `semester_id`, `received_amount`, `concession`, `fine`, `grand_total`, `payment_mode`, `voucherid`, `es_remarks`, `dd_no`, `dd_depositor`) VALUES (
					'".mysqli_real_escape_string($mysqli_con, $_POST['es_preadmissionid'])."',
					'".mysqli_real_escape_string($mysqli_con, $receipt_number)."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['financemaster_id'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['class_id'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['semster_id'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['sub_total'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['total_concession'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['fine_amount'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['grand_total'])."',
					'DD',
					'".mysqli_real_escape_string($mysqli_con, $voucher_id)."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['remarks'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['dd_no'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['dd_depositor'])."')") or die(mysqli_error($mysqli_con));

			$fees_id = mysqli_insert_id($mysqli_con);

		}

		if(isset($_POST['trasportation_id']))
		{
			mysqli_query($mysqli_con, "UPDATE `es_feepaid` SET
						transportation_fees = '".mysqli_real_escape_string($mysqli_con, $_POST['transportation_amount'])."',
						transport_concession=".mysqli_real_escape_string($mysqli_con, $_POST['trasport_concession'])."
						WHERE fid =".mysqli_real_escape_string($mysqli_con, $fees_id)) or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "UPDATE `transport_student_allocation` SET
					received_amount = received_amount+".mysqli_real_escape_string($mysqli_con, $_POST['transportation_amount']).",
					concession = concession+".mysqli_real_escape_string($mysqli_con, $_POST['trasport_concession']).",
					actual_received = actual_received+".mysqli_real_escape_string($mysqli_con, $_POST['total_transport'])."
					WHERE transport_student_allocation_id=".mysqli_real_escape_string($mysqli_con, $_POST['trasportation_id'])) or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "INSERT INTO `ledger_entries`(`es_ledger_id`, `es_voucher_id`, `ledger_detail`, `amount_in`) VALUES ('".$_POST['transport_ledger']."', '".$voucher_id."', 'Transportation Fees', '".$_POST['total_transport']."')") or die(mysqli_error($mysqli_con));

		}

		if($_POST['fine_amount'] != 0)
		{
			$fine_ledger = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_fine_master WHERE group_id=".mysqli_real_escape_string($mysqli_con, $_POST['section_id'])), MYSQLI_ASSOC);

			mysqli_query($mysqli_con, "INSERT INTO `ledger_entries`(`es_ledger_id`, `es_voucher_id`, `ledger_detail`, `amount_in`) VALUES (
				'".mysqli_real_escape_string($mysqli_con, $fine_ledger['ledger_id'])."',
				'".mysqli_real_escape_string($mysqli_con, $voucher_id)."',
				'Fine',
				'".mysqli_real_escape_string($mysqli_con, $_POST['fine_amount'])."')") or die(mysqli_error($mysqli_con));
		}

		mysqli_query($mysqli_con, "UPDATE `es_voucherentry` SET
				`es_narration`='".mysqli_real_escape_string($mysqli_con, $voucher_narration)."',
				es_bankname_acc='".mysqli_real_escape_string($mysqli_con, $voucher_bank)."'
				WHERE `es_voucherentryid`=".mysqli_real_escape_string($mysqli_con, $voucher_id)) or die(mysqli_error($mysqli_con));

		for($i = 0; $i < count($_POST['particularid']); $i++)
		{
			if(isset($_POST['applicable'][$_POST['particularid'][$i]]))
			{
			mysqli_query($mysqli_con, "INSERT INTO `es_feepaid_new_details`(`fid`, `student_id`, `particular_id`, `particulars`, `amount`, `concession`, `total_amount`, `applicable`, `created_on`) VALUES (
					'".mysqli_real_escape_string($mysqli_con, $fees_id)."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['es_preadmissionid'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['particularid'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['particulartname'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['received_amount'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['concession_amount'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['total_amount'][$i])."',
					'YES',
					'".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."')") or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "INSERT INTO `ledger_entries`(`es_ledger_id`, `es_voucher_id`, `ledger_detail`, `amount_in`) VALUES (
					'".mysqli_real_escape_string($mysqli_con, $_POST['ledger_id'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $voucher_id)."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['particulartname'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['total_amount'][$i])."')") or die(mysqli_error($mysqli_con));

			}
			else
			{
			mysqli_query($mysqli_con, "INSERT INTO `es_feepaid_new_details`(`fid`, `student_id`, `particular_id`, `particulars`, `amount`, `total_amount`, `applicable`, `created_on`) VALUES (
					'".mysqli_real_escape_string($mysqli_con, $fees_id)."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['es_preadmissionid'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['particularid'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['particulartname'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['not_applicable'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['not_applicable'][$i])."',
					'NO',
					'".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."')") or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "UPDATE `es_feepaid` SET
					`not_applicable`= not_applicable + ".mysqli_real_escape_string($mysqli_con, $_POST['not_applicable'][$i])." WHERE `fid` = ".$fees_id) or die(mysqli_error($mysqli_con));
			}
		}

		header("Location: ?pid=40&action=receipt_list&academic_year_id=".$_POST['financemaster_id']."&semester_id=".$_POST['semster_id']."&student_id=".$_POST['es_preadmissionid']);
		exit;
		
	}
		
}

if($action=='edit_receipt')
{
if ($_POST['editreceipt']=='1')
	{
		$receipt_number = $_POST['receipt_no'];
		if($_POST['receipt_no']=='')
		{
			if(isset($_POST['transportation_amount']) && $_POST['transportation_amount']>0)
			{
				$series = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT pre_fix FROM fees_series WHERE section=".mysqli_real_escape_string($mysqli_con, $_POST['section_id'])." AND fees_type='Transportation Fees'"), MYSQLI_ASSOC) or die(mysqli_error($mysqli_con));
			}
			else
			{
				for($i = 0; $i < count($_POST['particularid']); $i++)
				{
					$flag = 'false';
					if(isset($_POST['applicable'][$_POST['particularid'][$i]]) && $_POST['received_amount'][$i]>0)
					{
						$series = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT pre_fix FROM fees_series WHERE section=".mysqli_real_escape_string($mysqli_con, $_POST['section_id'])." AND fees_type LIKE '%".mysqli_real_escape_string($mysqli_con, $_POST['particulartname'][$i])."%'"), MYSQLI_ASSOC) or die(mysqli_error($mysqli_con));

						if(!empty($series)) { $flag = 'true'; }
					}

					if($flag == 'true') { break; }
				}
			}

			$receipt_no = $series['pre_fix'].date_format(date_create($_POST['ve_fromfinance']),'Y').'-'.date_format(date_create($_POST['ve_tofinance']),'y');

			$number = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) AS number FROM es_feepaid WHERE receipt_no LIKE '".mysqli_real_escape_string($mysqli_con, $receipt_no)."%'"), MYSQLI_NUM) or die(mysqli_error($mysqli_con));

			if($number[0]!=0)
			{
				$num_id = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT receipt_no FROM es_feepaid WHERE receipt_no LIKE '".mysqli_real_escape_string($mysqli_con, $receipt_no)."%' ORDER BY fid DESC"), MYSQLI_NUM) or die(mysqli_error($mysqli_con));
				preg_match_all('/\d+/', $num_id[0], $num);
				$numbers = end($num[0]);
				$numbers++;
			}
			else
			{
				$numbers = 1;
			}

			$receipt_number = $receipt_no."/".$numbers;

		}

		mysqli_query($mysqli_con, "DELETE FROM `ledger_entries` WHERE es_voucher_id=".$_POST['voucherid']) or die(mysqli_error($mysqli_con));

		if($_POST['payment_mode'] == 'Cash')
		{
			$voucher_narration = "";

			$voucher_bank = 'NULL';

			mysqli_query($mysqli_con, "UPDATE `es_feepaid` SET
					`receipt_no`='".mysqli_real_escape_string($mysqli_con, $receipt_number)."',
					`receipt_date`='".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."',
					`received_amount`='".mysqli_real_escape_string($mysqli_con, $_POST['sub_total'])."',
					`concession`='".mysqli_real_escape_string($mysqli_con, $_POST['total_concession'])."',
					`fine`='".mysqli_real_escape_string($mysqli_con, $_POST['fine_amount'])."',
					`grand_total`='".mysqli_real_escape_string($mysqli_con, $_POST['grand_total'])."',
					`not_applicable`='0',
					`payment_mode`='Cash',
					`es_remarks`='".mysqli_real_escape_string($mysqli_con, $_POST['remarks'])."',
					`cheque_bank_name`='NULL',
					`cheque_account_no`='NULL',
					`cheque_account_name`='NULL',
					`cheque_no`='NULL', `school_bank_name`='NULL',
					`school_bank_account_no`='NULL',
					`depositor_name`='NULL',
					`desposit_slip_no`='NULL',
					`dd_no`='NULL',
					`dd_depositor`='NULL' WHERE `fid`=".$_POST['receipt_id']) or die(mysqli_error($mysqli_con));
		}

		if($_POST['payment_mode'] == 'Cheque')
		{
			$voucher_narration = "Cheque No. : ".$_POST['cheque_no']."<br>Bank : ".$_POST['student_bank_name']."<br>Account : ".$_POST['payee_name']."<br>Account No. : ".$_POST['student_account_no'];

			$voucher_bank = 'NULL';

			mysqli_query($mysqli_con, "UPDATE `es_feepaid` SET
					`receipt_no`='".mysqli_real_escape_string($mysqli_con, $receipt_number)."',
					`receipt_date`='".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."',
					`received_amount`='".mysqli_real_escape_string($mysqli_con, $_POST['sub_total'])."',
					`concession`='".mysqli_real_escape_string($mysqli_con, $_POST['total_concession'])."',
					`fine`='".mysqli_real_escape_string($mysqli_con, $_POST['fine_amount'])."',
					`grand_total`='".mysqli_real_escape_string($mysqli_con, $_POST['grand_total'])."',
					`not_applicable`='0',
					`payment_mode`='Cheque',
					`es_remarks`='".mysqli_real_escape_string($mysqli_con, $_POST['remarks'])."',
					`cheque_bank_name`='".mysqli_real_escape_string($mysqli_con, $_POST['student_bank_name'])."',
					`cheque_account_no`='".mysqli_real_escape_string($mysqli_con, $_POST['student_account_no'])."',
					`cheque_account_name`='".mysqli_real_escape_string($mysqli_con, $_POST['payee_name'])."',
					`cheque_no`='".mysqli_real_escape_string($mysqli_con, $_POST['cheque_no'])."',
					`school_bank_name`='NULL',
					`school_bank_account_no`='NULL',
					`depositor_name`='NULL',
					`desposit_slip_no`='NULL',
					`dd_no`='NULL',
					`dd_depositor`='NULL' WHERE `fid`=".$_POST['receipt_id']) or die(mysqli_error($mysqli_con));
			
		}

		if($_POST['payment_mode'] == 'Bank Deposit')
		{
			$voucher_narration = "Bank : ".$_POST['school_bank_name']."<br>Account : ".$_POST['school_account_no']."<br>Depositor : ".$_POST['dipositor_name']."<br>Slip No. / Transection ID. : ".$_POST['slip_no'];

			$voucher_bank = $_POST['school_bank_name']."<br>(".$_POST['school_account_no'].")";

			mysqli_query($mysqli_con, "UPDATE `es_feepaid` SET
					`receipt_no`='".mysqli_real_escape_string($mysqli_con, $receipt_number)."',
					`receipt_date`='".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."',
					`received_amount`='".mysqli_real_escape_string($mysqli_con, $_POST['sub_total'])."',
					`concession`='".mysqli_real_escape_string($mysqli_con, $_POST['total_concession'])."',
					`fine`='".mysqli_real_escape_string($mysqli_con, $_POST['fine_amount'])."',
					`grand_total`='".mysqli_real_escape_string($mysqli_con, $_POST['grand_total'])."',
					`not_applicable`='0',
					`payment_mode`='Bank Deposit',
					`es_remarks`='".mysqli_real_escape_string($mysqli_con, $_POST['remarks'])."',
					`cheque_bank_name`='NULL',
					`cheque_account_no`='NULL',
					`cheque_account_name`='NULL',
					`cheque_no`='NULL',
					`school_bank_name`='".mysqli_real_escape_string($mysqli_con, $_POST['school_bank_name'])."',
					`school_bank_account_no`='".mysqli_real_escape_string($mysqli_con, $_POST['school_account_no'])."',
					`depositor_name`='".mysqli_real_escape_string($mysqli_con, $_POST['dipositor_name'])."',
					`desposit_slip_no`='".mysqli_real_escape_string($mysqli_con, $_POST['slip_no'])."',
					`dd_no`='NULL',
					`dd_depositor`='NULL'
					WHERE `fid`=".$_POST['receipt_id']) or die(mysqli_error($mysqli_con));
			
		}

		if($_POST['payment_mode'] == 'DD')
		{
			$voucher_narration = "DD No. : ".$_POST['dd_no']."<br>Depositor : ".$_POST['dd_depositor'];

			$voucher_bank = 'NULL';

			mysqli_query($mysqli_con, "UPDATE `es_feepaid` SET
					`receipt_no`='".mysqli_real_escape_string($mysqli_con, $receipt_number)."',
					`receipt_date`='".mysqli_real_escape_string($mysqli_con, $_POST['receipt_date'])."',
					`received_amount`='".mysqli_real_escape_string($mysqli_con, $_POST['sub_total'])."',
					`concession`='".mysqli_real_escape_string($mysqli_con, $_POST['total_concession'])."',
					`fine`='".mysqli_real_escape_string($mysqli_con, $_POST['fine_amount'])."',
					`grand_total`='".mysqli_real_escape_string($mysqli_con, $_POST['grand_total'])."',
					`not_applicable`='0', `payment_mode`='DD',
					`es_remarks`='".mysqli_real_escape_string($mysqli_con, $_POST['remarks'])."',
					`cheque_bank_name`='NULL',
					`cheque_account_no`='NULL',
					`cheque_account_name`='NULL',
					`cheque_no`='NULL',
					`school_bank_name`='NULL',
					`school_bank_account_no`='NULL', 
					`depositor_name`='NULL', 
					`desposit_slip_no`='NULL', 
					`dd_no`='".mysqli_real_escape_string($mysqli_con, $_POST['dd_no'])."', 
					`dd_depositor`='".mysqli_real_escape_string($mysqli_con, $_POST['dd_depositor'])."'
					WHERE `fid`=".$_POST['receipt_id']) or die(mysqli_error($mysqli_con));

		}

		if(isset($_POST['trasportation_id']))
		{
			mysqli_query($mysqli_con, "UPDATE `es_feepaid` SET transportation_fees = '".$_POST['transportation_amount']."', transport_concession='".$_POST['trasport_concession']."' WHERE fid =".$_POST['receipt_id']) or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "UPDATE `transport_student_allocation` SET received_amount = received_amount-".$_POST['transportation_previous_amount'].", concession= concession-".$_POST['transportation_previous_concession'].", actual_received=actual_received-".$_POST['transportation_previous_actual']." WHERE transport_student_allocation_id=".$_POST['trasportation_id']) or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "UPDATE `transport_student_allocation` SET received_amount = received_amount+".$_POST['transportation_amount'].", concession= concession+".$_POST['trasport_concession'].", actual_received=actual_received+".$_POST['total_transport']." WHERE transport_student_allocation_id=".$_POST['trasportation_id']) or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "INSERT INTO `ledger_entries`(`es_ledger_id`, `es_voucher_id`, `ledger_detail`, `amount_in`) VALUES ('".$_POST['transport_ledger']."', '".$_POST['voucherid']."', 'Transportation Fees', '".$_POST['total_transport']."')") or die(mysqli_error($mysqli_con));

		}

		if($_POST['fine_amount'] != 0)
		{

			$fine_ledger = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_fine_master WHERE group_id=".$_POST['section_id']), MYSQLI_ASSOC) or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "INSERT INTO `ledger_entries`(`es_ledger_id`, `es_voucher_id`, `ledger_detail`, `amount_in`) VALUES ('".$fine_ledger['ledger_id']."','".$_POST['voucherid']."','Fine','".$_POST['fine_amount']."')") or die(mysqli_error($mysqli_con));
		}

		mysqli_query($mysqli_con, "UPDATE `es_voucherentry` SET `es_voucherno`='".$_POST['receipt_no']."', `es_voucherdate`='".$_POST['receipt_date']."', `es_paymentmode`='".$_POST['payment_mode']."', `es_bankname_acc`='".$voucher_bank."', `es_amount_in`='".$_POST['sub_total']."', `es_narration`='".$voucher_narration."' WHERE es_voucherentryid=".$_POST['voucherid']) or die(mysqli_error($mysqli_con));
		
		for($i = 0; $i < count($_POST['particularid']); $i++)
		{
			if(isset($_POST['applicable'][$_POST['particularid'][$i]]))
			{
			mysqli_query($mysqli_con, "UPDATE `es_feepaid_new_details` SET `amount`='".$_POST['received_amount'][$i]."', concession='".$_POST['concession_amount'][$i]."', total_amount='".$_POST['total_amount'][$i]."', `applicable`='YES' WHERE `fp_det_id`=".$_POST['particularid'][$i]) or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "INSERT INTO `ledger_entries`(`es_ledger_id`, `es_voucher_id`, `ledger_detail`, `amount_in`) VALUES ('".$_POST['ledger_id'][$i]."', '".$_POST['voucherid']."', '".$_POST['particulartname'][$i]."', '".$_POST['total_amount'][$i]."')") or die(mysqli_error($mysqli_con));
			
			}
			else
			{
			mysqli_query($mysqli_con, "UPDATE `es_feepaid_new_details` SET `amount`='".$_POST['received_amount'][$i]."', total_amount='".$_POST['received_amount'][$i]."', `applicable`='NO' WHERE `fp_det_id`=".$_POST['particularid'][$i]) or die(mysqli_error($mysqli_con));
			mysqli_query($mysqli_con, "UPDATE `es_feepaid` SET `not_applicable`= not_applicable + ".$_POST['not_applicable'][$i]." WHERE `fid` = ".$_POST['receipt_id']) or die(mysqli_error($mysqli_con));
			}
		}
		header("Location: ?pid=40&action=receipt_list");
		exit;

	 }
}
if($action == 'delete_receipt')
{
	$rec = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_feepaid WHERE fid=".$_GET['receipt_id']), MYSQLI_ASSOC);
	mysqli_query($mysqli_con, "DELETE FROM es_feepaid_new_details WHERE fid =".$_GET['receipt_id']);
	mysqli_query($mysqli_con, "DELETE FROM es_voucherentry WHERE es_voucherentryid=".$rec['voucherid']);
	mysqli_query($mysqli_con, "DELETE FROM `ledger_entries` WHERE es_voucher_id=".$rec['voucherid']);
	if($rec['transportation_fees'] != 0)
	{
		$received_amount = $rec['transportation_fees'];
		$concession = $rec['transport_concession'];
		$actual_received = $rec['transportation_fees'] - $rec['transport_concession'];
		mysqli_query($mysqli_con, "UPDATE `transport_student_allocation` SET received_amount = received_amount-".$received_amount.", concession = concession-".$concession.", actual_received=actual_received-".$actual_received." WHERE acdemic_year_id='".$rec['financemaster_id']."' AND student_id='".$rec['es_preadmissionid']."'");


	}

	mysqli_query($mysqli_con, "UPDATE `es_feepaid` SET status='canceled' WHERE fid=".$_GET['receipt_id']);
	mysqli_query($mysqli_con, "UPDATE `fm_fee_cards` SET receipt_id=NULL WHERE receipt_id=".$_GET['receipt_id']);
	header('Location: ?pid=40&action=receipt_list');
	exit;
}

if($action == 'fee_paid_list')
{
	$fees_type = mysqli_query($mysqli_con, "SELECT DISTINCT fee_particular FROM es_feemaster");
	$i = 0;
	while($row = mysqli_fetch_assoc($fees_type))
	{
		$fees_category[$i] = $row;
		$i++;
	}
}

?>