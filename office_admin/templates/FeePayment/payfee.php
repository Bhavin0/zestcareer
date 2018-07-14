<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php if (isset($arr_pages[$pid]['title'])) echo $arr_pages[$pid]['title']; ?></title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
       	<?php
         	include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
         	include(TEMPLATES_PATH . DS . 'header.tpl.php');
    	?>

    				<!-- PANEL START -->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<span class="title elipsis">
									<strong>Pay Fee </strong>
								</span>
							</div>

							<div class="panel-body">
							<?php if($_POST['getstudetails'] != 'Go') { ?>

							<form method="post" action="" name="fetchstudent">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Academic Year</b></label>
									<select name="pre_year" class="form-control selectpicker" data-live-search="true"  id="ac_year" > 
									
									<?php  
									foreach($school_details_res as $each_record) { ?>
										<option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==$pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record['fi_enddate']); ?>	</option>
									<?php } ?>
									</select>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Select Section</b></label>
									<?php $sql = mysql_query("SELECT * FROM es_groups"); ?>
									<select class="form-control selectpicker" data-live-search="true"  onchange="fetchclass(this.value)" name="section">
										<option selected disabled >--SELECT SECTION--</option>
										<?php while($row = mysql_fetch_assoc($sql)){ ?>
										<option value="<?php echo $row['es_groupsid']; ?>"> <?php echo $row['es_groupname']; ?></option>
									<?php } ?>
									</select>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Select Class</b></label>
									<select class="form-control selectpicker" data-live-search="true" id="classes" onchange="fetchdivision(this.value)" name="class">
										<option selected disabled >--SELECT CLASS--</option>
									</select>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Select Division</b></label>
									<select class="form-control selectpicker" data-live-search="true"  id="divisions" name="division" onchange="fetchstudents(this.value)">
										<option selected disabled >--SELECT DIVISION--</option>
									</select>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Select Semester</b></label>
									<select class="form-control selectpicker" data-live-search="true"  id="semesters" name="semesters">
										<option selected disabled >--SELECT SEMESTER--</option>
									</select>
								</div>


								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Select Student</b></label>
									<select class="form-control selectpicker" data-live-search="true"  id="students" name="studentid">
									<option selected disabled >--SELECT STUDENT--</option>
									<?php if(isset($studetails['es_preadmissionid'])) {
									echo "<option value='".$studetails['es_preadmissionid']."'>".$studetails['es_preadmissionid']."</option>";
										} ?>
									</select>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<input type="submit" name="getstudetails" value="Go" class="btn btn-primary pull-right"/>
								</div>
							</form>

							<?php } ?>

							<?php if($_POST['getstudetails'] == 'Go') { ?>

							<form action="" method="post">

							<?php
							$query = "SELECT es_feemaster.*, new_semesters.name FROM es_feemaster INNER JOIN new_semesters ON es_feemaster.semester_id = new_semesters.semester_id WHERE academy_year_id = ".$_POST['pre_year']." AND fee_class = ".$_POST['class'];

								if($_POST['semesters'] != 'NULL')
								{
									$query .= " AND es_feemaster.semester_id = ".$_POST['semesters'];
								}

								$query .= " ORDER BY es_feemaster.semester_id";

							$sql = mysql_query($query);
							?>

							<input type="hidden" name="es_preadmissionid" value="<?php echo $_POST['studentid']; ?>">
							<input type="hidden" name="semster_id" value="<?php echo $_POST['semesters']; ?>">
							<input type="hidden" name="payer_name" value="<?php echo $student_detail['pre_name']." ".$student_detail['middle_name']." ".$student_detail['pre_lastname']; ?>">
							<input type="hidden" name="financemaster_id" value="<?php echo $_POST['pre_year']; ?>">
							<input type="hidden" name="class_id" value="<?php echo $_POST['class']; ?>">
							<input type="hidden" name="paid_on" value="<?php echo date('Y-m-d'); ?>">
							<input type="hidden" name="es_vouchertype" value="Receipt">
							<input type="hidden" name="es_vouchermode" value="Fees Received">
							<input type="hidden" name="ledger" value="School Fees">
							<input type="hidden" name="ve_fromfinance" value="<?php echo $academicyear['fi_ac_startdate']; ?>">
							<input type="hidden" name="ve_tofinance" value="<?php echo $academicyear['fi_ac_enddate']; ?>">
							<input type="hidden" name="section_id" value="<?php echo $_POST['section']; ?>">
							<?php
							$receipt_no = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) AS number FROM es_feepaid WHERE financemaster_id=".$_POST['pre_year']), MYSQLI_ASSOC);
							$receipt_number = $receipt_no['number'] + 1;
							?> 
							<ul>
								<li><b>Academic Year : </b> <?php echo $academicyear['fi_ac_startdate']." - ".$academicyear['fi_ac_enddate']; ?></li>
								<li><b> Student Name : </b> <?php echo $student_detail['pre_name']." ".$student_detail['middle_name']." ".$student_detail['pre_lastname']; ?></li>
								<li><b> Class : </b> <?php echo $classname['es_classname']; ?></li>
								<li><b>Semester :</b> <?php echo $semesters['name']; ?> </li>
							</ul>

							<div class="col-md-4 form-group">
								<label><b>Receipt No.</b></label>
								<input type="text" name="receipt_no" class="form-control" value="" placeholder="Leave it blank for autogenrated receipt no.">
							</div>

							<div class="col-md-4 form-group">
								<label><b>Receipt Date</b></label>
								<input type="text" name="receipt_date" class="datepicker form-control" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
							</div>

							<div class="col-md-4 form-group">
								<label><b>Payment Mode</b></label>
								<select class="form-control" name="payment_mode" onchange="hello(this.value)">
									<option value="Cash"> Cash </option>
									<option value="Cheque"> Cheque </option>
									<option value="Bank Deposit"> Bank Deposit </option>
									<option value="DD"> DD </option>
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
									$received_amount = 0;
									while($inner_row = mysql_fetch_assoc($sql))
									{
										$paid_fees = mysql_fetch_array(mysql_query("SELECT SUM(amount) FROM es_feepaid_new_details WHERE student_id = ".$_POST['studentid']." AND particular_id = ".$inner_row['es_feemasterid']));

										$paid_fees = !isset($paid_fees)?'0':$paid_fees;
										if($inner_row['fee_amount'] - $paid_fees[0] > 0)
										{
										?>
										<tr class="fee_row">
											<td>
												<input type="hidden" name="particularid[]" value="<?php echo $inner_row['es_feemasterid']; ?>">
												<input type="hidden" name="particulartname[]" value="<?php echo $inner_row['fee_particular']; ?>">
												<input type="hidden" name="ledger_id[]" value="<?php echo $inner_row['ledger_id']; ?>">
												<?php
													echo $inner_row['fee_particular'];
													if($_POST['semesters'] == 'NULL')
													{
														echo " - ".$inner_row['name'];
													}
												?>

											</td>
											<td><?php echo $inner_row['fee_amount']; ?></td>
											<td><?php echo $paid_fees[0]; ?></td>
											<td><?php echo $inner_row['fee_amount'] - $paid_fees[0]; ?></td>
											<td><input type="number" name="received_amount[]" class="received_amount form-control" max="<?php echo $inner_row['fee_amount'] - $paid_fees[0]; ?>" min="0" required="required" value="<?php echo ($inner_row['optional']=='NO')?$inner_row['fee_amount'] - $paid_fees[0]:'0'; ?>" <?php echo ($inner_row['optional']=='NO')?'':'readonly'; ?>></td>
											<td>
												<input type="number" name="concession_amount[]" class="concession form-control" value="0" <?php echo ($inner_row['optional']=='NO')?'':'readonly'; ?>>
											</td>
											<td>
												<input type="text" name="total_amount[]" class="total form-control" value="0" readonly>
											</td>
											<td align="center">
												<label class="switch switch-primary switch-round">
													<input type="checkbox" name="applicable[<?php echo $inner_row['es_feemasterid']; ?>]" class="applicable" <?php echo ($inner_row['optional']=='NO')?'checked':''; ?>>
													<span class="switch-label" data-on="YES" data-off="NO"></span>
												</label>
												<input type="hidden" name="not_applicable[]" value="<?php echo $inner_row['fee_amount'] - $paid_fees[0]; ?>">
											</td>
										</tr>
										<?php
										if($inner_row['optional']=='NO')
										{
											$received_amount = $received_amount + ($inner_row['fee_amount'] - $paid_fees[0]);
										}
										
										$total_fee_amount = $total_fee_amount + $inner_row['fee_amount'];
										$total_paid_fees = $total_paid_fees + $paid_fees[0];
										$total_outstanding = $total_outstanding + ($inner_row['fee_amount'] - $paid_fees[0]);
										}
									}
									?>

									<!-- TRANSPORT FEES -->
									<?php
									$transport_fee = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM `transport_student_allocation` WHERE acdemic_year_id='".$_POST['pre_year']."' AND student_id ='".$_POST['studentid']."'"), MYSQLI_ASSOC);
									if(!empty($transport_fee))
									{
									?>
									<tr class="fee_row">
										<td>Transportation Fees
										<input type="hidden" name="trasportation_id" value="<?php echo $transport_fee['transport_student_allocation_id']; ?>">
										<input type="hidden" name="transport_ledger" value="<?php echo $transport_fee['ledger_id']; ?>">
										</td>
										<td><?php echo $transport_fee['payble_charges']; ?></td>
										<td><?php echo $transport_fee['received_amount']; ?></td>
										<td><?php echo $transport_fee['payble_charges'] - $transport_fee['received_amount']; ?></td>
										<td>
											<input type="number" name="transportation_amount" class="received_amount form-control" value="<?php echo $transport_fee['payble_charges'] - $transport_fee['received_amount']; ?>" max="<?php echo $transport_fee['payble_charges'] - $transport_fee['received_amount']; ?>">
										</td>
										<td>
											<input type="number" name="trasport_concession" class="concession form-control" value="0" >
										</td>
										
											<td>
												<input type="text" name="total_transport" class="total form-control" value="0" readonly>
											</td>
										<td></td>
									</tr>
									<?php
										
										$total_fee_amount = $total_fee_amount + $transport_fee['payble_charges'];
										$total_paid_fees = $total_paid_fees + $transport_fee['received_amount'];
										$total_outstanding = $total_outstanding + ($transport_fee['payble_charges'] - $transport_fee['received_amount']);
										$received_amount = $received_amount + ($transport_fee['payble_charges'] - $transport_fee['received_amount']);
									}
									?>
									<!-- END OF TRANSPORT FEES -->

									<tr>
										<td>Fine</td>
										<td></td>
										<td></td>
										<td></td>
										<td>
											<input type="number" name="fine_amount" class="received_amount form-control" value="0" id="fine_amount">
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
											<input type="text" name="sub_total" id="sub_total" readonly="" class="form-control">
										</th>
										<th>
										<input type="number" name="total_concession" class="form-control" value="0" id="total_concession">
										</th>
										<th><input type="text" name="grand_total" id="grand_total" readonly class="form-control"></th>
										<th></th>
									</tr>
								</thead>
							</table>
							</div>

							<div class="payment_mode cheque_mode" style="display: none;">
								<div class="col-md-6 form-group">
									<label><b>Bank</b></label>
									<input type="text" name="student_bank_name" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									<label><b>Cheque Date</b></label>
									<input type="text" name="student_account_no" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									<label><b>Account Name</b></label>
									<input type="text" name="payee_name" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									<label><b>Cheque No.</b></label>
									<input type="text" name="cheque_no" class="form-control">
								</div>
							</div>

							<div class="payment_mode bank_mode" style="display: none;">

								<div class="col-md-6 form-group">
									<label><b> School Bank Name</b></label>
									<input type="text" name="school_bank_name" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									<label><b>School Bank Acccount No.</b></label>
									<input type="text" name="school_account_no" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									<label><b>Depositor Name</b></label>
									<input type="text" name="dipositor_name" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									<label><b>Deposit Slip No. / (Transection ID, if paid online)</b></label>
									<input type="text" name="slip_no" class="form-control">
								</div>
							</div>

							<div class="payment_mode dd_mode" style="display: none;">

								<div class="col-md-6 form-group">
									<label><b>DD No.</b></label>
									<input type="text" name="dd_no" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									<label><b>DD Depositor Name</b></label>
									<input type="text" name="dd_depositor" class="form-control">
								</div>
							</div>

							<div class="col-md-12 form-group">
								<label><b>Remarks</b></label>
								<textarea class="form-control" name="remarks"></textarea>
							</div>

							<div class="col-md-12 form-group">
								<input type="submit" name="pay_fee" value="PAY" class="btn btn-primary pull-right">
							</div>

							</form>

							<?php } ?>

							</div>
						</div>
					</div>
					<!-- PANEL END-->
				</div>
  			</section>
		</div>
    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>

<script>
	function hello(str)
	{

		$('.payment_mode').hide();
		if(str == 'Bank Deposit') { $('.bank_mode').show(); }
		if(str == 'Cheque') { $('.cheque_mode').show(); }
		if(str == 'DD') { $('.dd_mode').show(); }
	}
</script>
<script>
$(".applicable").change(function() {
	if($(this).is(':checked'))
	{
		$(this).closest('tr').find('.received_amount').attr('readonly', false);
		$(this).closest('tr').find('.concession').attr('readonly', false);
	}
	else
	{
		$(this).closest('tr').find('.received_amount').val(0);
		$(this).closest('tr').find('.received_amount').attr('readonly', true);
		$(this).closest('tr').find('.concession').val(0);
		$(this).closest('tr').find('.concession').attr('readonly', true);
	}
	calculation();
});
</script>

<script>
function calculation()
{
	var received_amount = 0; 
	var concession = 0;
	$(".fee_row").each(function() {
  	 received_amount = $(this).find('.received_amount').val();
  	 concession = $(this).find('.concession').val();
  	 total = parseInt(received_amount) - parseInt(concession);
  	 $(this).find('.total').val(total);
    });


    var sub_total = 0;
    $(".received_amount").each(function() {
    sub_total += parseInt(this.value);
    });

    var total_concession = 0;
    $(".concession").each(function() {
    total_concession += parseInt(this.value);
    });

    $('#total_concession').val(total_concession);
    $('#sub_total').val(sub_total);
    $('#grand_total').val(sub_total - total_concession);

}
$(document).on('keyup', '.received_amount', calculation);
$(document).on('keyup', '.concession', calculation);
$(document).on('keyup', '#fine_amount', calculation);
calculation();
</script>





<?php if($_POST['getstudetails'] != 'Go') { ?>
<script>
function fetchclass(str) {
	var ac_year = $('#ac_year').val();
    if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
    } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	var classes = document.getElementById('classes');
    	classes.innerHTML = "<option selected='selected'>--SELECT CLASS--</option>";
		classes.innerHTML = classes.innerHTML + this.responseText;
		$('.selectpicker').selectpicker('refresh');
        }
    };
    xmlhttp.open("GET","ajax.php?action=classes&q="+str,true);
    xmlhttp.send();

    /* Fetch Semesters */
    if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
    } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	var semesters = document.getElementById('semesters');
    	semesters.innerHTML = "<option value='NULL'>ALL SEMESTER</option>";
		semesters.innerHTML = semesters.innerHTML + this.responseText;
        }
    };
    xmlhttp.open("GET","ajax.php?action=semesters&q="+str+"&ac_year="+ac_year,true);
    xmlhttp.send();
}
</script>
<script type="text/javascript">
	function fetchdivision(str)
	{
		if (window.XMLHttpRequest) {
    		xmlhttp = new XMLHttpRequest();
    	} else {
    		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    	}
    		xmlhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
    		var divisions = document.getElementById('divisions');
    		divisions.innerHTML = "<option selected disabled> --SELECT DIVISION-- </option>";
			divisions.innerHTML = divisions.innerHTML + this.responseText;
			$('.selectpicker').selectpicker('refresh');
        	}
    	};
    	xmlhttp.open("GET","ajax.php?action=divisions&q="+str,true);
    	xmlhttp.send();
	}
</script>
<script>
	function fetchstudents(str)
	{
		//FETCH STUDENTS
		var ac_year = $('#ac_year').val();
    	if (window.XMLHttpRequest) {
    	xmlhttp = new XMLHttpRequest();
    	} else {
    	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    	}
    	xmlhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    		var students = document.getElementById('students');
			students.innerHTML = this.responseText;
			$('.selectpicker').selectpicker('refresh');
        	}
    	};
    	xmlhttp.open("GET","ajax.php?action=students&q="+str+"&ac_year="+ac_year,true);
    	xmlhttp.send();
	}
</script>
<?php } ?>
        <script type="text/javascript">
          $('#dd-11').addClass('active');
          $('#dd-11-3').addClass('active');
        </script>
  	</body>
</html>