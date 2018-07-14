<?php
	$card = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM fm_fee_cards WHERE card_id = ".$_GET['q']), MYSQLI_ASSOC);

	$cards_childs = mysqli_query($mysqli_con, "SELECT * FROM fm_fee_card_childs WHERE card_id = ".$_GET['q']." ORDER BY card_child_id");
?>
<div class="row">

	<input type="hidden" name="card_id" value="<?php echo $_GET['q']; ?>">


    <div class="col-md-4 form-group">
        <label><b>Bank Name</b></label>
        <input type="text" name="bank_name" class="form-control" value="<?php echo $card['bank_name']; ?>">
    </div>

    <div class="col-md-4 form-group">
        <label><b>Last Date</b></label>
        <input type="text" name="last_date" class="datepicker form-control" value="<?php echo $card['last_date']; ?>" readonly="readonly">
    </div>

	<div class="col-md-4">
	<?php
	if($card['es_preadmissionid']==0)
	{
		$students = mysqli_query($mysqli_con, "SELECT * FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE pre_class=".$card['class_id']." AND academic_year_id=".$card['financemaster_id']);

		?>
		<label><b>Student</b></label>
		<select class="form-control" name="es_preadmissionid">
		<option value=""></option>
		<?php
		while($student = mysqli_fetch_assoc($students))
		{
			echo"<option value='".$student['es_preadmissionid']."'>";
			echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname'];
			echo"</option>";
		}
		?>
		</select>
		<input type="hidden" name="card_no" value="<?php echo $card['slip_no']; ?>">
		<input type="hidden" name="ac_year" value="<?php echo $card['financemaster_id']; ?>">
		<?php
	}
	?>
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
				while($cards_child = mysqli_fetch_assoc($cards_childs))
				{
					$actual_amount = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_feemaster WHERE es_feemasterid =".$cards_child['particular_id']), MYSQLI_ASSOC);
					$paid_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT SUM(amount) FROM fm_fee_card_childs WHERE student_id = ".$cards_child['student_id']." AND particular_id = ".$cards_child['particular_id']." AND card_id !=".$cards_child['card_id']), MYSQLI_NUM);
					$paid_fees = !isset($paid_fees[0])?'0':$paid_fees;
				?>
				<tr class="fee_row">
					<td>
						<?php echo $cards_child['particulars']; ?>
						<input type="hidden" name="card_child_id[]" value="<?php echo  $cards_child['card_child_id']; ?>">
					</td>
					<td><?php echo $actual_amount['fee_amount']; ?></td>
					<td><?php echo $paid_fees[0]; ?></td>
					<td><?php echo $actual_amount['fee_amount'] - $paid_fees[0]; ?></td>
					<td>
						<input type="number" name="received_amount[]" class="received_amount form-control" max="<?php echo $actual_amount['fee_amount'] - $paid_fees[0]; ?>" min="0" required="required" value="<?php echo ($cards_child['applicable']=='YES')?$cards_child['amount']:'0'; ?>" <?php echo ($cards_child['applicable']=='YES')?'':'readonly'; ?>>
					</td>
					<td>
						<input type="number" name="concession_amount[]" class="concession form-control" <?php echo ($cards_child['applicable']=='YES')?'':'readonly'; ?>  value="<?php echo $cards_child['concession']; ?>">
					</td>
					<td>
						<input type="text" name="total_amount[]" class="total form-control" value="<?php echo ($cards_child['applicable']=='YES')?$cards_child['total_amount']:'0'; ?>" readonly>
					</td>
					<td align="center">
						<label class="switch switch-primary switch-round">
							<input type="checkbox" name="applicable[<?php echo $cards_child['card_child_id']; ?>]" class="applicable" <?php echo ($cards_child['applicable']=='YES')?'checked':''; ?>>
							<span class="switch-label" data-on="YES" data-off="NO"></span>
						</label>
						<input type="hidden" name="not_applicable[]" value="<?php echo $actual_amount['fee_amount'] - $paid_fees[0]; ?>">
					</td>
				</tr>
				<?php	
					$total_fee_amount = $total_fee_amount + $actual_amount['fee_amount'];
					$total_paid_fees = $total_paid_fees + $paid_fees[0];
					$total_outstanding = $total_outstanding + ($actual_amount['fee_amount'] - $paid_fees[0]);	
				} ?>
				<!-- TRANSPORT FEES -->
	              <?php
	              $transport_fee = get_single_row('transport_student_allocation', array('acdemic_year_id' => $card['financemaster_id'], 'student_id' => $card['es_preadmissionid']), 'transport_student_allocation_id', 'DESC');

	              $generated_transport_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(transportation_fees),0) as paid, COALESCE(SUM(transport_concession),0) as concession FROM fm_fee_cards WHERE es_preadmissionid=".$card['es_preadmissionid']." AND financemaster_id=".$card['financemaster_id']));

	              if(!empty($transport_fee))
	              {
	              ?>
	              <tr class="fee_row">
	                <td>Transportation Fees
	                <input type="hidden" name="trasportation_id" value="<?php echo $transport_fee['transport_student_allocation_id']; ?>">
	                <input type="hidden" name="transport_ledger" value="<?php echo $transport_fee['ledger_id']; ?>">
	                </td>
	                <td><?php echo $transport_fee['payble_charges']; ?></td>
	                <td><?php echo $generated_transport_fees['paid'] + $generated_transport_fees['concession'] - ($card['transportation_fees'] + $card['transport_concession']); ?></td>
	                <td><?php echo $transport_fee['payble_charges'] - ($generated_transport_fees['paid'] + $generated_transport_fees['concession'] - ($card['transportation_fees'] + $card['transport_concession'])); ?></td>
	                <td>
	                  <input type="number" name="transportation_amount" class="received_amount form-control" value="<?php echo $card['transportation_fees']; ?>">
	                </td>
	                <td>
	                  <input type="number" name="trasport_concession" class="concession form-control" value="<?php echo $card['transport_concession']; ?>" >
	                </td>
	                
	                  <td>
	                    <input type="text" name="total_transport" class="total form-control" value="<?php echo $card['transportation_fees'] - $card['transport_concession'];  ?>" readonly>
	                  </td>
	                <td></td>
	              </tr>
	              <?php
	                $total_fee_amount = $total_fee_amount + $transport_fee['payble_charges'];
	                $total_paid_fees = $total_paid_fees + ($generated_transport_fees['paid'] + $generated_transport_fees['concession'] - ($card['transportation_fees'] + $card['transport_concession']));
	                $total_outstanding = $total_outstanding + ($transport_fee['payble_charges'] - ($generated_transport_fees['paid'] + $generated_transport_fees['concession'] - ($card['transportation_fees'] + $card['transport_concession'])));
	              }
	              ?>
	              <!-- END OF TRANSPORT FEES -->
				<tr>
					<th>TOTAL</th>
					<th><?php echo $total_fee_amount; ?></th>
					<th><?php echo $total_paid_fees; ?></th>
					<th><?php echo $total_outstanding; ?></th>
					<th>
						<input type="text" name="sub_total" id="sub_total" readonly="" class="form-control" value="<?php echo $card['received_amount']; ?>">
					</th>
					<th>
						<input type="number" name="total_concession" class="form-control" id="total_concession" value="<?php echo $card['concession']; ?>">
					</th>
					<th>
						<input type="text" name="grand_total" id="grand_total" readonly class="form-control" value="<?php echo $card['grand_total']; ?>">
					</th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>
</div>