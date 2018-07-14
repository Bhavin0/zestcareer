<?php
	if($_GET['action'] == 'addcategory')
	{
		if(isset($_POST['categorysubmit']))
		{
			mysqli_query($mysqli_con, "INSERT INTO `es_in_category`(`in_category_name`, `in_description`, `status`) VALUES ('".
				$_POST['in_category_name']."','".$_POST['in_description']."','active')");
			header('Location: ?pid=7&action=addcategory');
		}
	}


	if($_GET['action'] == 'additem')
	{
		if(isset($_POST['itemSubmit']))
		{
			mysqli_query($mysqli_con, "INSERT INTO `es_in_item_master`(`in_item_code`, `in_item_name`, `cost`, `in_inventory_id`, `in_category_id`, `in_qty_available`, `in_reorder_level`, `status`, `in_units`) VALUES ('".$_POST['in_item_code']."', '".$_POST['in_item_name']."', '".$_POST['cost']."', '".$_POST['in_inventory_id']."', '".$_POST['in_category_id']."', '".$_POST['in_qty_available']."', '".$_POST['in_reorder_level']."', 'active', '".$_POST['in_units']."')");

			header('Location: ?pid=7&action=additem');
		}
		if(isset($_POST['itemUpdate']))
		{
			mysqli_query($mysqli_con, "UPDATE `es_in_item_master` SET `in_item_code`='".$_POST['in_item_code']."', `in_item_name`='".$_POST['in_item_name']."', `cost`='".$_POST['cost']."', `in_inventory_id`='".$_POST['in_inventory_id']."', `in_category_id`='".$_POST['in_category_id']."', `in_qty_available`='".$_POST['in_qty_available']."', `in_reorder_level`='".$_POST['in_reorder_level']."', `in_units`='".$_POST['in_units']."' WHERE es_in_item_masterid=".$_POST['item_id']);

			header('Location: ?pid=7&action=additem');
		}
	}


	if($_GET['action'] == 'addsupply')
	{
		if(isset($_POST['supplysubmit']))
		{
			mysqli_query($mysqli_con, "INSERT INTO `es_in_supplier_master`(`in_name`, `in_address`, `in_city`, `in_state`, `in_country`, `in_office_no`, `in_mobile_no`, `in_email`, `in_fax`, `in_description`, `bank_account_name`, `bank_account_no`, `bank_name`, `bank_branch`, `beneficary_code`) VALUES ('".$_POST['in_name']."', '".$_POST['in_address']."', '".$_POST['in_city']."', '".$_POST['in_state']."', '".$_POST['in_country']."', '".$_POST['in_office_no']."', '".$_POST['in_mobile_no']."', '".$_POST['in_email']."', '".$_POST['in_fax']."', '".$_POST['in_description']."', '".$_POST['bank_account_name']."', '".$_POST['bank_account_no']."', '".$_POST['bank_name']."', '".$_POST['bank_branch']."', '".$_POST['beneficary_code']."')");

			header('Location: ?pid=7&action=addsupply');
		}
	}

	if($_GET['action'] == 'add_order')
	{
		$maxorderno = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT MAX(es_in_ordersid) FROM es_in_orders"), MYSQLI_NUM);
		if(isset($_POST['purchaseorder']))
		{
			mysqli_query($mysqli_con, "INSERT INTO `es_in_orders`(`in_suplier_id`, `order_date`, `in_ord_status`) VALUES ('".$_POST['in_suplier_name']."', '".$_POST['order_date']."', 'Pending')");

			$order_id = mysqli_insert_id($mysqli_con);
			$message ="<table border = 2><tr><td>Item</td><td>QTY</td></tr>";
			for($i = 0; $i < count($_POST['item_category']); $i++)
			{
				mysqli_query($mysqli_con, "INSERT INTO `es_in_orders_items`(`es_order_id`, `item_category`, `item_id`, `ordered_qty`) VALUES ('".$order_id."', '".$_POST['item_category'][$i]."', '".$_POST['item_id'][$i]."', '".$_POST['item_qty'][$i]."')");

				$item = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT in_item_name,in_units FROM es_in_item_master WHERE es_in_item_masterid=".$_POST['item_id'][$i]), MYSQLI_ASSOC);
				$message .="<tr><td>".$item['in_item_name']."</td><td>".$_POST['item_qty'][$i]." ".$item['in_units']."</td></tr>";
			}
			$message .= "</table>";

			$email = mysqli_fetch_array(mysqli_query($mysqli_con,"SELECT in_email FROM es_in_supplier_master WHERE es_in_supplier_masterid =".$_POST['in_suplier_name']), MYSQLI_ASSOC);

			$to = $email['in_email'];
			$subject = $_POST['quotation_subject'];
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: ".$res_year['fi_email']."\r\n";
			mail($to,$subject,$message,$headers);
			header('Location: ?pid=7&action=purchase_orders_detail&order_id='.$order_id);
			exit;
		}
	}

	$categories = mysqli_query($mysqli_con, "SELECT * FROM es_in_category WHERE status='active'");

	$items = mysqli_query($mysqli_con, "SELECT es_in_item_master.*, es_in_category.in_category_name FROM es_in_item_master  INNER JOIN es_in_category ON es_in_category.es_in_categoryid = es_in_item_master.in_category_id WHERE es_in_item_master.status = 'active'");

	$suppliers = mysqli_query($mysqli_con, "SELECT * FROM es_in_supplier_master WHERE status='active'");

	$category_json = array();
	while($category = mysqli_fetch_assoc($categories))
	{
		$category_json[] = $category;
	}

	if($_GET['action'] == 'goods_issue')
	{
		$gin_no = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT MAX(es_in_goods_issueid) FROM es_in_goods_issue"), MYSQLI_NUM);

		if(isset($_POST['issue_goods']))
		{
			mysqli_query($mysqli_con, "INSERT INTO `es_in_goods_issue`(`in_issue_date`, `request_id`, `in_issue_to`, `staff_id`) VALUES ('".$_POST['in_issue_date']."', '".$_POST['request_id']."', '".$_POST['in_issue_to']."', '".$_POST['staff_id']."')");
			
			$es_in_goods_issue_id = mysqli_insert_id($mysqli_con);

			mysqli_query($mysqli_con, "UPDATE es_in_goods_issue_requests SET status = 'Approved' WHERE es_in_goods_issueid='".$_POST['request_id']."'");
			
			for($i = 0; $i < count($_POST['item_id']); $i++)
			{
				mysqli_query($mysqli_con, "INSERT INTO `es_in_goods_issue_items`(`es_in_goods_issue_id`, `item_category`, `item_id`, `qty`, `status`) VALUES ('".$es_in_goods_issue_id."','".$_POST['item_category'][$i]."','".$_POST['item_id'][$i]."','".$_POST['item_qty'][$i]."','NOT RETURNED')");

				mysqli_query($mysqli_con, "UPDATE `es_in_item_master` SET `in_qty_available`= in_qty_available - ".$_POST['item_qty'][$i]." WHERE `es_in_item_masterid` =".$_POST['item_id'][$i]);
			}
			header("Location: ?pid=7&action=goods_issue_note&gin_id=".$es_in_goods_issue_id);
			exit;
		}
	}
	if($_GET['action']=='quotation')
	{
	}
	if($_GET['action'] == 'quotation_request')
	{
		if(isset($_POST['request_quote']))
		{
			$message_body = mysqli_real_escape_string($mysqli_con, $_POST['message']);
			for($i=0; $i < count($_POST['supplier_id']); $i++)
			{
				$sql = "INSERT INTO `es_in_quotation_requests`(`supplier_id`, `quotation_subject`, `message_body`) VALUES ('".$_POST['supplier_id'][$i]."','".$_POST['quotation_subject']."','".$message_body."')";
				mysqli_query($mysqli_con,$sql);

				$email = mysqli_fetch_array(mysqli_query($mysqli_con,"SELECT in_email FROM es_in_supplier_master WHERE es_in_supplier_masterid =".$_POST['supplier_id'][$i]), MYSQLI_ASSOC);

				$to = $email['in_email'];
				$subject = $_POST['quotation_subject'];
				$message = $message_body;
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= "From: ".$res_year['fi_email']."\r\n";
				mail($to,$subject,$message,$headers);
			}
			header('Location: ?pid=7&action=quotation');
		}

	}

	if($_GET['action'] == 'edit_order')
	{
		if(isset($_POST['edit_order']))
		{
			mysqli_query($mysqli_con, "UPDATE `es_in_orders` SET `in_suplier_id`='".$_POST['in_suplier_name']."',`order_date`='".$_POST['order_date']."' WHERE es_in_ordersid=".$_POST['order_id']);
			mysqli_query($mysqli_con, "DELETE FROM `es_in_orders_items` WHERE `es_order_id`=".$_POST['order_id']);

			$message ="<table border = 2><tr><td>Item</td><td>QTY</td></tr>";
			for($i = 0; $i < count($_POST['item_category']); $i++)
			{
				mysqli_query($mysqli_con, "INSERT INTO `es_in_orders_items`(`es_order_id`, `item_category`, `item_id`, `ordered_qty`) VALUES ('".$_POST['order_id']."', '".$_POST['item_category'][$i]."', '".$_POST['item_id'][$i]."', '".$_POST['item_qty'][$i]."')");

				$item = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT in_item_name,in_units FROM es_in_item_master WHERE es_in_item_masterid=".$_POST['item_id'][$i]), MYSQLI_ASSOC);
				$message .="<tr><td>".$item['in_item_name']."</td><td>".$_POST['item_qty'][$i]." ".$item['in_units']."</td></tr>";
			}
			$message .= "</table>";

			$email = mysqli_fetch_array(mysqli_query($mysqli_con,"SELECT in_email FROM es_in_supplier_master WHERE es_in_supplier_masterid =".$_POST['in_suplier_name']), MYSQLI_ASSOC);

			$to = $email['in_email'];
			$subject = $_POST['quotation_subject'];
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: ".$res_year['fi_email']."\r\n";
			mail($to,$subject,$message,$headers);
			header('Location: ?pid=7&action=purchase_orders_detail&order_id='.$_POST['order_id']);
			exit;
		}
	}
	if($_GET['action']=='delete_order')
	{
		mysqli_query($mysqli_con, "DELETE FROM es_in_orders_items WHERE es_order_id=".$_GET['order_id']);
		mysqli_query($mysqli_con, "DELETE FROM es_in_orders WHERE es_in_ordersid =".$_GET['order_id']);
		header('Location: ?pid=7&action=purchase_orders');
		exit;
	}


	if($_GET['action'] == 'make_grn')
	{
		if($_POST['make_grn'] == '1')
		{
			mysqli_query($mysqli_con, "INSERT INTO `es_in_goods_receipt_note`(`es_order_id`, `grn_date`, `bill_no`, `supplier_id`, `additional_amount`, `total_amount`, `remarks`, `paid_amount`) VALUES ('".$_POST['order_id']."', '".$_POST['in_rec_date']."', '".$_POST['in_rec_bill_no']."', '".$_POST['in_suplier_name']."', '".$_POST['additional_amount']."', '".$_POST['total_amount']."', '".$_POST['remarks']."', '0')");
			$grn_id = mysqli_insert_id($mysqli_con);

		for($i = 0; $i < count($_POST['item_category']); $i++)
		{
			mysqli_query($mysqli_con, "INSERT INTO `es_in_goods_receipt_note_items`(`grn_id`, `item_category`, `item_id`, `qty`, `price`, `amount`) VALUES ('".$grn_id."', '".$_POST['item_category'][$i]."', '".$_POST['item_id'][$i]."', '".$_POST['qty'][$i]."', '".$_POST['price'][$i]."', '".$_POST['amount'][$i]."')");

			mysqli_query($mysqli_con, "UPDATE `es_in_item_master` SET `in_qty_available`=in_qty_available + ".$_POST['qty'][$i].",`in_last_recieved_date`=NOW() WHERE es_in_item_masterid = ".$_POST['item_id'][$i]);

		}
		header("Location: ?pid=7&action=goods_reciept&grn_id=".$grn_id);
		exit;
		}
	}
	if($_GET['action']=='supplier_payment')
	{
		if(isset($_POST['payment']))
		{
		mysqli_query($mysqli_con, "INSERT INTO `es_voucherentry`(`es_vouchertype`, `es_voucherdate`, `es_paymentmode`, `es_ledger`, `es_amount_out`, `opposite_partyname`) VALUES ('Payment', '".$_POST['payment_date']."', '".$_POST['payment_mode']."', 'Inventory Purchase Payment', '".$_POST['total']."', '".$_POST['supplier_name']."')");
		$voucher_id = mysqli_insert_id($mysqli_con);

		if($_POST['payment_mode'] == 'Cash')
		{
			$voucher_narration = '';
			mysqli_query($mysqli_con, "INSERT INTO `supplier_payments`(`payment_date`, `supplier_id`, `paid_amount`, `voucher_id`, `payment_mode`, `remarks`) VALUES ('".$_POST['payment_date']."', '".$_POST['supplier_id']."', '".$_POST['total']."', '".$voucher_id."', '".$_POST['payment_mode']."', '".$_POST['remarks']."')");
			$payment_id = mysqli_insert_id($mysqli_con);
		}
		elseif ($_POST['payment_mode'] == 'Cheque')
		{
			$voucher_narration = 'Cheque No. : '.$_POST['cheque_no'].'<br>Cheque Date : '.$_POST['cheque_date'].'<br>Payee : '.$_POST['ac_payee'].'<br>Bank : '.$_POST['school_bank'].'<br>Account No. :'.$_POST['school_account'];

			mysqli_query($mysqli_con, "INSERT INTO `supplier_payments`(`payment_date`, `supplier_id`, `paid_amount`, `voucher_id`, `payment_mode`, `cheque_no`, `cheque_date`, `ac_payee_name`, `bank_name`, `bank_account_no`, `remarks`) VALUES ('".$_POST['payment_date']."', '".$_POST['supplier_id']."', '".$_POST['total']."', '".$voucher_id."', '".$_POST['payment_mode']."', '".$_POST['cheque_no']."', '".$_POST['cheque_date']."', '".$_POST['ac_payee']."', '".$_POST['school_bank']."', '".$_POST['school_account']."', '".$_POST['remarks']."')");
			$payment_id = mysqli_insert_id($mysqli_con);
		}
		elseif ($_POST['payment_mode'] == 'Online Payment')
		{
			$voucher_narration = 'Bank : '.$_POST['school_bank'].'<br>Account No. :'.$_POST['school_account'].'<br>Type : '.$_POST['online_type'].'<br>Transection ID : '.$_POST['transection_id'].'<br>Beneficiay Code : '.$_POST['baneficiary_code'];

			mysqli_query($mysqli_con, "INSERT INTO `supplier_payments`(`payment_date`, `supplier_id`, `paid_amount`, `voucher_id`, `payment_mode`, `bank_name`, `bank_account_no`, `online_type`, `transection_id`, `beneficiary_code`, `remarks`) VALUES ('".$_POST['payment_date']."', '".$_POST['supplier_id']."', '".$_POST['total']."', '".$voucher_id."', '".$_POST['payment_mode']."', '".$_POST['school_bank']."', '".$_POST['school_account']."','".$_POST['online_type']."', '".$_POST['transection_id']."', '".$_POST['baneficiary_code']."', '".$_POST['remarks']."')");
			$payment_id = mysqli_insert_id($mysqli_con);
		}
		elseif ($_POST['payment_mode'] == 'Bank Deposit')
		{
			$voucher_narration = 'Bank : '.$_POST['supplier_bank'].'<br>Account No. :'.$_POST['supplier_account_no'].'<br>Account Name : '.$_POST['supplier_account_name'].'<br>Deposit Slip : '.$_POST['deposite_slip_no'];

			mysqli_query($mysqli_con, "INSERT INTO `supplier_payments`(`payment_date`, `supplier_id`, `paid_amount`, `voucher_id`, `payment_mode`, `supplier_bank`, `suppllier_account_no`, `supplier_account_name`, `deposit_slip_no`, `remarks`) VALUES ('".$_POST['payment_date']."', '".$_POST['supplier_id']."', '".$_POST['total']."', '".$voucher_id."', '".$_POST['payment_mode']."', '".$_POST['supplier_bank']."', '".$_POST['supplier_account_no']."', '".$_POST['supplier_account_name']."', '".$_POST['deposite_slip_no']."', '".$_POST['remarks']."')");
			$payment_id = mysqli_insert_id($mysqli_con);
		}
		elseif ($_POST['payment_mode'] == 'DD Payment')
		{
			$voucher_narration = 'Bank : '.$_POST['supplier_bank'].'<br>Account No. :'.$_POST['supplier_account_no'].'<br>Account Name : '.$_POST['supplier_account_name'].'<br>DD No. : '.$_POST['dd_no'];

			mysqli_query($mysqli_con, "INSERT INTO `supplier_payments`(`payment_date`, `supplier_id`, `paid_amount`, `voucher_id`, `payment_mode`, `supplier_bank`, `suppllier_account_no`, `supplier_account_name`, `dd_no`, `remarks`) VALUES ('".$_POST['payment_date']."', '".$_POST['supplier_id']."', '".$_POST['total']."', '".$voucher_id."', '".$_POST['payment_mode']."', '".$_POST['supplier_bank']."', '".$_POST['supplier_account_no']."', '".$_POST['supplier_account_name']."', '".$_POST['dd_no']."', '".$_POST['remarks']."')");
			$payment_id = mysqli_insert_id($mysqli_con);
		}

		mysqli_query($mysqli_con, "UPDATE es_voucherentry SET es_narration ='".$voucher_narration."' WHERE es_voucherentryid=".$voucher_id);
		

		for($i=0; $i<count($_POST['grn_id']); $i++)
		{
			mysqli_query($mysqli_con, "INSERT INTO `supplier_payment_child`(`supplier_payment_id`, `grn_id`, `paid_amount`) VALUES ('".$payment_id."', '".$_POST['grn_id'][$i]."', '".$_POST['paid_amount'][$i]."')");

			mysqli_query($mysqli_con, "UPDATE es_in_goods_receipt_note SET paid_amount = paid_amount +".$_POST['paid_amount'][$i]." WHERE grn_id=".$_POST['grn_id'][$i]);
		}

		header('Location: ?pid=7&action=supplier_payment_detail&payment_id='.$payment_id);
		exit;
		}
	}
	if($_GET['action']=='edit_payment')
	{
		if(isset($_POST['edit_payment']))
		{

			if($_POST['payment_mode'] == 'Cash')
			{
				$voucher_narration = '';

				mysqli_query($mysqli_con, "UPDATE `supplier_payments` SET `payment_date`='".$_POST['payment_date']."', `paid_amount`='".$_POST['total']."', `payment_mode`='Cash', `cheque_no`='', `cheque_date`='', `ac_payee_name`='', `bank_name`='', `bank_account_no`='', `online_type`='', `transection_id`='', `beneficiary_code`='', `supplier_bank`='', `suppllier_account_no`='', `supplier_account_name`='', `deposit_slip_no`='', `dd_no`='', `remarks`='".$_POST['remarks']."' WHERE `supplier_payment_id`='".$_POST['payment_id']."'");
			}
			elseif ($_POST['payment_mode'] == 'Cheque')
			{
				$voucher_narration = 'Cheque No. : '.$_POST['cheque_no'].'<br>Cheque Date : '.$_POST['cheque_date'].'<br>Payee : '.$_POST['ac_payee'].'<br>Bank : '.$_POST['school_bank'].'<br>Account No. :'.$_POST['school_account'];

				mysqli_query($mysqli_con, "UPDATE `supplier_payments` SET `payment_date`='".$_POST['payment_date']."', `paid_amount`='".$_POST['total']."', `payment_mode`='Cheque', `cheque_no`='".$_POST['cheque_no']."', `cheque_date`='".$_POST['cheque_date']."', `ac_payee_name`='".$_POST['ac_payee']."', `bank_name`='".$_POST['school_bank']."', `bank_account_no`='".$_POST['school_account']."', `online_type`='', `transection_id`='', `beneficiary_code`='', `supplier_bank`='', `suppllier_account_no`='', `supplier_account_name`='', `deposit_slip_no`='', `dd_no`='', `remarks`='".$_POST['remarks']."' WHERE `supplier_payment_id`='".$_POST['payment_id']."'");
			}
			elseif ($_POST['payment_mode'] == 'Online Payment')
			{
				$voucher_narration = 'Bank : '.$_POST['school_bank'].'<br>Account No. :'.$_POST['school_account'].'<br>Type : '.$_POST['online_type'].'<br>Transection ID : '.$_POST['transection_id'].'<br>Beneficiay Code : '.$_POST['baneficiary_code'];

				mysqli_query($mysqli_con, "UPDATE `supplier_payments` SET `payment_date`='".$_POST['payment_date']."', `paid_amount`='".$_POST['total']."', `payment_mode`='Online Payment', `cheque_no`='', `cheque_date`='', `ac_payee_name`='', `bank_name`='".$_POST['school_bank']."', `bank_account_no`='".$_POST['school_account']."', `online_type`='".$_POST['online_type']."', `transection_id`='".$_POST['transection_id']."', `beneficiary_code`='".$_POST['baneficiary_code']."', `supplier_bank`='', `suppllier_account_no`='', `supplier_account_name`='', `deposit_slip_no`='', `dd_no`='', `remarks`='".$_POST['remarks']."' WHERE `supplier_payment_id`='".$_POST['payment_id']."'");
			}
			elseif ($_POST['payment_mode'] == 'Bank Deposit')
			{
				$voucher_narration = 'Bank : '.$_POST['supplier_bank'].'<br>Account No. :'.$_POST['supplier_account_no'].'<br>Account Name : '.$_POST['supplier_account_name'].'<br>Deposit Slip : '.$_POST['deposite_slip_no'];

				mysqli_query($mysqli_con, "UPDATE `supplier_payments` SET `payment_date`='".$_POST['payment_date']."', `paid_amount`='".$_POST['total']."', `payment_mode`='Bank Deposit', `cheque_no`='', `cheque_date`='', `ac_payee_name`='', `bank_name`='', `bank_account_no`='', `online_type`='', `transection_id`='', `beneficiary_code`='', `supplier_bank`='".$_POST['supplier_bank']."', `suppllier_account_no`='".$_POST['supplier_account_no']."', `supplier_account_name`='".$_POST['supplier_account_name']."', `deposit_slip_no`='".$_POST['deposite_slip_no']."', `dd_no`='', `remarks`='".$_POST['remarks']."' WHERE `supplier_payment_id`='".$_POST['payment_id']."'");

				
			}
			elseif ($_POST['payment_mode'] == 'DD Payment')
			{
				$voucher_narration = 'Bank : '.$_POST['supplier_bank'].'<br>Account No. :'.$_POST['supplier_account_no'].'<br>Account Name : '.$_POST['supplier_account_name'].'<br>DD No. : '.$_POST['dd_no'];

				mysqli_query($mysqli_con, "UPDATE `supplier_payments` SET `payment_date`='".$_POST['payment_date']."', `paid_amount`='".$_POST['total']."', `payment_mode`='DD Payment', `cheque_no`='', `cheque_date`='', `ac_payee_name`='', `bank_name`='', `bank_account_no`='', `online_type`='', `transection_id`='', `beneficiary_code`='', `supplier_bank`='".$_POST['supplier_bank']."', `suppllier_account_no`='".$_POST['supplier_account_no']."', `supplier_account_name`='".$_POST['supplier_account_name']."', `deposit_slip_no`='', `dd_no`='".$_POST['dd_no']."', `remarks`='".$_POST['remarks']."' WHERE `supplier_payment_id`='".$_POST['payment_id']."'");
			}


			mysqli_query($mysqli_con, "UPDATE es_voucherentry SET es_narration ='".$voucher_narration."', es_paymentmode='".$_POST['payment_mode']."', es_amount_out='".$_POST['total']."', es_voucherdate='".$_POST['payment_date']."' WHERE es_voucherentryid=".$_POST['voucher_id']);

			mysqli_query($mysqli_con, "DELETE FROM `supplier_payment_child` WHERE `supplier_payment_id`=".$_POST['payment_id']);

			for($i=0; $i<count($_POST['grn_id']); $i++)
			{
				mysqli_query($mysqli_con, "INSERT INTO `supplier_payment_child`(`supplier_payment_id`, `grn_id`, `paid_amount`) VALUES ('".$_POST['payment_id']."', '".$_POST['grn_id'][$i]."', '".$_POST['paid_amount'][$i]."')");

				mysqli_query($mysqli_con, "UPDATE es_in_goods_receipt_note SET paid_amount = paid_amount -".$_POST['old_paid_amount'][$i]." WHERE grn_id=".$_POST['grn_id'][$i]);

				mysqli_query($mysqli_con, "UPDATE es_in_goods_receipt_note SET paid_amount = paid_amount +".$_POST['paid_amount'][$i]." WHERE grn_id=".$_POST['grn_id'][$i]);
			}

		header('Location: ?pid=7&action=supplier_payment_detail&payment_id='.$_POST['payment_id']);
		exit;
		}
	}
	if($_GET['action']=='delete_payment')
	{
		$grns = mysqli_query($mysqli_con, "SELECT * FROM `supplier_payment_child` WHERE `supplier_payment_id`=".$_GET['payment_id']);
		while($grn = mysqli_fetch_assoc($grns))
		{
			mysqli_query($mysqli_con, "UPDATE es_in_goods_receipt_note SET paid_amount = paid_amount -".$grn['paid_amount']." WHERE grn_id=".$grn['grn_id']);

			mysqli_query($mysqli_con, "DELETE FROM `supplier_payment_child` WHERE supplier_payment_child_id=".$grn['supplier_payment_child_id']);
		}

		$payment = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT voucher_id FROM supplier_payments WHERE supplier_payment_id=".$_GET['payment_id']), MYSQLI_ASSOC);

		mysqli_query($mysqli_con, "DELETE FROM es_voucherentry WHERE es_voucherentryid=".$payment['voucher_id']);
		mysqli_query($mysqli_con, "DELETE FROM supplier_payments WHERE supplier_payment_id=".$_GET['payment_id']);

		header('Location: ?pid=7&action=supplier_payments');
		exit;
	}
	if($_GET['action'] == 'deleteitem')
	{
		mysqli_query($mysqli_con, "UPDATE es_in_item_master SET status='deleted' WHERE es_in_item_masterid=".$_GET['item_id']);
		header('Location: ?pid=7&action=additem');
	}