<?php
	$receipt = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_feepaid.* FROM es_feepaid WHERE fid = ".$_GET['q']), MYSQLI_ASSOC);

	$receipt_childs = mysqli_query($mysqli_con, "SELECT * FROM es_feepaid_new_details WHERE fid = ".$_GET['q']);

	$section = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_groupid FROM es_classes WHERE es_classesid = ".$receipt['class_id']), MYSQLI_ASSOC);

	$ac_year = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT fi_ac_startdate, fi_ac_enddate FROM es_finance_master WHERE es_finance_masterid = ".$receipt['financemaster_id']), MYSQLI_ASSOC);
?>

	<input type="hidden" name="receipt_id" value="<?php echo $_GET['q']; ?>">
	<input type="hidden" name="voucherid" value="<?php echo $receipt['voucherid']; ?>">
	<input type="hidden" name="ve_fromfinance" value="<?php echo $ac_year['fi_ac_startdate']; ?>">
	<input type="hidden" name="ve_tofinance" value="<?php echo $ac_year['fi_ac_enddate']; ?>">
	<input type="hidden" name="section_id" value="<?php echo $section['es_groupid']; ?>">

	<div class="col-md-4 form-group">
		<label><b>Receipt No.</b></label>
		<input type="text" name="receipt_no" class="form-control" value="<?php echo $receipt['receipt_no']; ?>">
	</div>

	<div class="col-md-4 form-group">
		<label><b>Date</b></label>
		<input type="text" name="receipt_date" class="datepicker form-control" value="<?php echo $receipt['receipt_date']; ?>">
	</div>

	<div class="col-md-4 form-group">
		<label><b>Payment Mode</b></label>
		<select class="form-control" name="payment_mode" onchange="hello(this.value)">
			<option value="Cash" <?php if($receipt['payment_mode']=='Cash') { echo 'selected'; } ; ?>> Cash </option>
			<option value="Cheque" <?php if($receipt['payment_mode']=='Cheque') { echo 'selected'; } ; ?>> Cheque </option>
			<option value="Bank Deposit" <?php if($receipt['payment_mode']=='Bank Deposit') { echo 'selected'; } ; ?>> Bank Deposit </option>
			<option value="DD" <?php if($receipt['payment_mode']=='DD') { echo 'selected'; } ; ?>> DD </option>
		</select>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
										<th>Particular</th>
										<th>Fees Amount</th>
										<th>Paid</th>
										<th>Outstanding</th>
										<th width=15%>Received Amount</th>
										<th width=10%>Concession</th>
										<th width=15%>Total</th>
										<th>Applicable</th>
				</tr>
				<?php
					$total_fee_amount = 0;
					$total_paid_fees = 0;
					$total_outstanding = 0;
					while($receipt_child = mysqli_fetch_assoc($receipt_childs))
					{
						$actual_amount = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_feemaster WHERE es_feemasterid =".$receipt_child['particular_id']), MYSQLI_ASSOC);

						$paid_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT SUM(amount) FROM es_feepaid_new_details WHERE student_id = ".$receipt_child['student_id']." AND particular_id = ".$receipt_child['particular_id']." AND fp_det_id !=".$receipt_child['fp_det_id']), MYSQLI_NUM);

						$paid_fees = !isset($paid_fees[0])?'0':$paid_fees;
						?>
							<tr class="fee_row">
								<td>
								<input type="hidden" name="particularid[]" value="<?php echo $receipt_child['fp_det_id']; ?>">
								<input type="hidden" name="particulartname[]" value="<?php echo $actual_amount['fee_particular']; ?>">
								<input type="hidden" name="ledger_id[]" value="<?php echo $actual_amount['ledger_id']; ?>">
								<?php echo $receipt_child['particulars']; ?>
								</td>
								<td><?php echo $actual_amount['fee_amount']; ?></td>
								<td><?php echo $paid_fees[0]; ?></td>
								<td><?php echo $actual_amount['fee_amount'] - $paid_fees[0]; ?></td>
								<td><input type="number" name="received_amount[]" class="received_amount form-control" max="<?php echo $actual_amount['fee_amount'] - $paid_fees[0]; ?>" min="0" required="required" value="<?php echo ($receipt_child['applicable']=='YES')?$receipt_child['amount']:'0'; ?>" <?php echo ($receipt_child['applicable']=='YES')?'':'readonly'; ?>></td>
								<td>
									<input type="number" name="concession_amount[]" class="concession form-control" <?php echo ($receipt_child['applicable']=='YES')?'':'readonly'; ?>  value="<?php echo $receipt_child['concession']; ?>">
								</td>
								<td>
									<input type="text" name="total_amount[]" class="total form-control" value="<?php echo ($receipt_child['applicable']=='YES')?$receipt_child['total_amount']:'0'; ?>" readonly>
								</td>
								<td align="center">
								<label class="switch switch-primary switch-round">
									<input type="checkbox" name="applicable[<?php echo $receipt_child['fp_det_id']; ?>]" class="applicable" <?php echo ($receipt_child['applicable']=='YES')?'checked':''; ?>>
									<span class="switch-label" data-on="YES" data-off="NO"></span>
								</label>
								<input type="hidden" name="not_applicable[]" value="<?php echo $actual_amount['fee_amount'] - $paid_fees[0]; ?>">
								</td>
							</tr>
							<?php	
								$total_fee_amount = $total_fee_amount + $actual_amount['fee_amount'];
								$total_paid_fees = $total_paid_fees + $paid_fees[0];
								$total_outstanding = $total_outstanding + ($actual_amount['fee_amount'] - $paid_fees[0]);	
							}
							if($receipt['transportation_fees']!=0) {
								$transport_fee = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM `transport_student_allocation` WHERE acdemic_year_id='".$receipt['financemaster_id']."' AND student_id ='".$receipt['es_preadmissionid']."'"), MYSQLI_ASSOC);
							?>
							<tr class="fee_row">
								<td>Transportation Fees
									<input type="hidden" name="trasportation_id" value="<?php echo $transport_fee['transport_student_allocation_id']; ?>">
									<input type="hidden" name="transport_ledger" value="<?php echo $transport_fee['ledger_id']; ?>">
									<input type="hidden" name="transportation_previous_amount" value="<?php echo $receipt['transportation_fees']; ?>">
									<input type="hidden" name="transportation_previous_concession" value="<?php echo $receipt['transport_concession']; ?>">
									<input type="hidden" name="transportation_previous_actual" value="<?php echo $receipt['transportation_fees'] - $receipt['transport_concession']; ?>">
								</td>
								<td><?php echo $transport_fee['payble_charges']; ?></td>
								<td><?php echo $transport_fee['received_amount'] - $receipt['transportation_fees']; ?></td>
								<td><?php echo ($transport_fee['payble_charges'] - $transport_fee['received_amount']) + $receipt['transportation_fees']; ?></td>
								<td>
									<input type="number" name="transportation_amount" class="received_amount form-control" value="<?php echo $receipt['transportation_fees']; ?>" max="<?php echo ($transport_fee['payble_charges'] - $transport_fee['received_amount']) + $receipt['transportation_fees']; ?>">
								</td>
								<td>
									<input type="number" name="trasport_concession" class="concession form-control" value="<?php echo $receipt['transport_concession']; ?>" >
								</td>
								<td>
									<input type="text" name="total_transport" class="total form-control" value="<?php echo $transport_fee['received_amount'] - $receipt['transport_concession']; ?>" readonly>
								</td>
								<td></td>
							</tr>
							<?php } ?>
							<tr>
								<td>Fine</td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									<input type="number" name="fine_amount" class="received_amount form-control" value="<?php echo $receipt['fine']; ?>" id="fine_amount">
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>TOTAL</th>
								<th><?php echo $total_fee_amount; ?></th>
								<th><?php echo $total_paid_fees; ?></th>
										<th><?php echo $total_outstanding; ?></th>
										<th>
											<input type="text" name="sub_total" id="sub_total" readonly="" class="form-control" value="<?php echo $receipt['received_amount']; ?>">
										</th>
										<th>
										<input type="number" name="total_concession" class="form-control" id="total_concession" value="<?php echo $receipt['concession']; ?>">
										</th>
										<th><input type="text" name="grand_total" id="grand_total" readonly class="form-control" value="<?php echo $receipt['grand_total']; ?>"></th>
										<th></th>
									</tr>
								</thead>
							</table>
							</div>

							<div class="payment_mode cheque_mode" style="display:<?php echo ($receipt['payment_mode']!='Cheque')?'none':'block'; ?>;">
								<div class="col-md-6 form-group">
									<label><b>Bank</b></label>
									<input type="text" name="student_bank_name" class="form-control" value="<?php echo $receipt['cheque_bank_name']; ?>">
								</div>

								<div class="col-md-6 form-group">
									<label><b>Cheque Date</b></label>
									<input type="text" name="student_account_no" class="form-control" value="<?php echo $receipt['cheque_account_no']; ?>">
								</div>

								<div class="col-md-6 form-group">
									<label><b>Account Name</b></label>
									<input type="text" name="payee_name" class="form-control" value="<?php echo $receipt['cheque_account_name']; ?>">
								</div>

								<div class="col-md-6 form-group">
									<label><b>Cheque No.</b></label>
									<input type="text" name="cheque_no" class="form-control" value="<?php echo $receipt['cheque_no']; ?>">
								</div>
							</div>

							<div class="payment_mode bank_mode" style="display:<?php echo ($receipt['payment_mode']!='Bank Deposit')?'none':'block'; ?>;">

								<div class="col-md-6 form-group">
									<label><b> School Bank Name</b></label>
									<input type="text" name="school_bank_name" class="form-control" value="<?php echo $receipt['school_bank_name']; ?>">
								</div>

								<div class="col-md-6 form-group">
									<label><b>School Bank Acccount No.</b></label>
									<input type="text" name="school_account_no" class="form-control" value="<?php echo $receipt['school_bank_account_no']; ?>">
								</div>

								<div class="col-md-6 form-group">
									<label><b>Depositor Name</b></label>
									<input type="text" name="dipositor_name" class="form-control" value="<?php echo $receipt['depositor_name']; ?>">
								</div>

								<div class="col-md-6 form-group">
									<label><b>Deposit Slip No. / (Transection ID, if paid online)</b></label>
									<input type="text" name="slip_no" class="form-control" value="<?php echo $receipt['desposit_slip_no']; ?>">
								</div>
							</div>

							<div class="payment_mode dd_mode" style="display:<?php echo ($receipt['payment_mode']!='DD')?'none':'block'; ?>;">

								<div class="col-md-6 form-group">
									<label><b>DD No.</b></label>
									<input type="text" name="dd_no" class="form-control" value="<?php echo $receipt['dd_no']; ?>">
								</div>

								<div class="col-md-6 form-group">
									<label><b>DD Depositor Name</b></label>
									<input type="text" name="dd_depositor" class="form-control" value="<?php echo $receipt['dd_depositor']; ?>">
								</div>
							</div>

							<div class="col-md-12 form-group">
								<label><b>Remarks</b></label>
								<textarea class="form-control" name="remarks"><?php echo $receipt['es_remarks']; ?></textarea>
							</div>