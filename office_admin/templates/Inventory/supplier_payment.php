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
    </head>
        <?php
        include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
        include(TEMPLATES_PATH . DS . 'header_new.tpl.php');
        ?>
            <section id="middle">
            <?php
                $sel_year = "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
                $res_year = getarrayassoc($sel_year);

            ?>
                <header id="page-header">
                    <ol class="breadcrumb">
                        <li>
                            <b> Academic Year : </b>
                            <?php if($res_year['fi_ac_startdate']!=""){ echo displaydate($res_year['fi_ac_startdate']);?> to <?php echo displaydate($res_year['fi_ac_enddate']); } else { echo "---"; }?>
                        </li>
                    </ol>
                </header>

                <div id="content" class="dashboard" style="padding-top: 5px;">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<span class="title elipsis">
									<strong>Supplier Payment</strong>
								</span>
							</div>

							<div class="panel-body">
							<?php if(!isset($_GET['supplier_id'])) { ?>
							<form method="get" action="">
								<input type="hidden" name="pid" value="7">
								<input type="hidden" name="action" value="supplier_payment">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Select Supplier</b></label>
									<select class="form-control" name="supplier_id" required="required">
                                        <option selected="" disabled="">--SELECT SUPPLIER--</option>
                                        <?php
                                        while($supplier = mysqli_fetch_assoc($suppliers)) { ?>
                                            <option value="<?php echo $supplier['es_in_supplier_masterid']; ?>">
                                        		<?php echo $supplier['in_name']; ?>
                                            </option>
                                    	<?php } ?>
									</select>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<input type="submit" class="btn btn-primary pull-right"/>
								</div>
							</form>

							<?php } if(isset($_GET['supplier_id'])) { ?>

							<form action="" method="post">

							<?php
								$supplier_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_in_supplier_master WHERE es_in_supplier_masterid=".$_GET['supplier_id']), MYSQLI_ASSOC);
								$grns = mysqli_query($mysqli_con, "SELECT * FROM es_in_goods_receipt_note WHERE supplier_id=".$_GET['supplier_id']);
								?>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<b>Supplier Detail</b><br>
									<input type="hidden" name="supplier_id" value="<?php echo $_GET['supplier_id']; ?>">
									<input type="hidden" name="supplier_name" value="<?php echo $supplier_detail['in_name']; ?>">
									<?php echo $supplier_detail['in_name']; ?><br>
									<?php echo $supplier_detail['in_address']; ?><br />
  									<?php echo $supplier_detail['in_city']; ?>, <?php echo $supplier['in_state']; ?>,
  									<?php echo $supplier_detail['in_country']; ?>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<b>Contact Detail</b><br>
									Email: <?php echo $supplier_detail['in_email']; ?><br />
									Office No : <?php echo $supplier_detail['in_office_no']; ?><br/>
									Mobile No : <?php echo $supplier_detail['in_mobile_no']; ?><br/>
									Fax : <?php echo $supplier_detail['in_fax']; ?>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<b>Banking Detail</b><br>
									Account Name : <?php echo $supplier_detail['bank_account_name']; ?><br>
									Account No. : <?php echo $supplier_detail['bank_account_no']; ?><br>
									Bank Name: <?php echo $supplier_detail['bank_name']; ?><br>
									Branch : <?php echo $supplier_detail['bank_branch']; ?><br>
									Beneficiary Code : <?php echo $supplier_detail['beneficary_code']; ?>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Payment Date</b></label>
									<input type="text" name="payment_date" class="datepicker form-control" value="<?php echo date('Y-m-d'); ?>">
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>GRN ID</th>
												<th>GRN Date</th>
												<th>Bill No.</th>
												<th>Outstanding</th>
												<th>Paid Amount</th>
											</tr>
											<?php
											while($grn = mysqli_fetch_assoc($grns)) { ?>
											<tr>
												<td><?php echo $grn['grn_id']; ?>
													<input type="hidden" name="grn_id[]" value="<?php echo $grn['grn_id']; ?>">
												</td>
												<td><?php echo date_format(date_create($grn['grn_date']), 'd/m/Y'); ?></td>
												<td><?php echo $grn['bill_no']; ?></td>
												<td><?php echo $grn['total_amount'] - $grn['paid_amount']; ?></td>
												<td>
													<input type="number" name="paid_amount[]" value="<?php echo $grn['total_amount'] - $grn['paid_amount']; ?>" class="paid_amount form-control" max=<?php echo $grn['total_amount'] - $grn['paid_amount']; ?>>
												</td>
											</tr>
											<?php } ?>
											<tr>
												<th>TOTAL</th>
												<th><?php echo $total_fee_amount; ?></th>
												<th><?php echo $total_paid_fees; ?></th>
												<th><?php echo $total_outstanding; ?></th>
												<th>
													<input type="text" name="total" id="total" readonly="" class="form-control" value="<?php echo $received_amount; ?>">
												</th>
												<th></th>
											</tr>
										</thead>
									</table>
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Payment Mode</b></label>
									<select class="form-control" name="payment_mode" id="payment_mode">
										<option value="Cash">Cash</option>
										<option value="Cheque">Cheque</option>
										<option value="Online Payment">Online Payment</option>
										<option value="Bank Deposite">Bank Deposite</option>
										<option value="DD Payment">DD Payment</option>
									</select>
								</div>

								<div class="payment cheque col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Cheque No.</b></label>
									<input type="text" name="cheque_no" class="form-control">
								</div>

								<div class="payment cheque col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Cheque Date</b></label>
									<input type="text" name="cheque_date" class="datepicker form-control" value="<?php echo date('Y-m-d'); ?>">
								</div>

								<div class="payment cheque col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>A/C Payee Name</b></label>
									<input type="text" name="ac_payee" class="form-control" value="<?php echo $supplier_detail['bank_account_name']; ?>">
								</div>

								<div class="payment cheque online col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>School Bank Name</b></label>
									<input type="text" name="school_bank" class="form-control">
								</div>

								<div class="payment cheque online col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>School Bank Account No.</b></label>
									<input type="text" name="school_account" class="form-control">
								</div>

								<div class="payment online col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">	
									<label><b>Type</b></label>
									<select class="form-control" name="online_type">
										<option value="">--SELECT PAYMENT TYPE--</option>
										<option value="NEFT">NEFT</option>
										<option value="RTGS">RTGS</option>
									</select>
								</div>

								<div class="payment online col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">	
									<label><b>Transection ID</b></label>
									<input type="text" name="transection_id" class="form-control">
								</div>

								<div class="payment online col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Beneficiary Code</b></label>
									<input type="text" name="baneficiary_code" class="form-control" value="<?php echo $supplier_detail['beneficary_code']; ?>">
								</div>

								<div class="payment bank dd col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">	
									<label><b>Supplier Bank Name</b></label>
									<input type="text" name="supplier_bank" class="form-control" value="<?php echo $supplier_detail['bank_name']; ?>">
								</div>

								<div class="payment bank dd col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">	
									<label><b>Supplier Account No.</b></label>
									<input type="text" name="supplier_account_no" class="form-control" value="<?php echo $supplier_detail['bank_account_no']; ?>">
								</div>

								<div class="payment bank dd col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">	
									<label><b>Supplier Account Name</b></label>
									<input type="text" name="supplier_account_name" class="form-control" value="<?php echo $supplier_detail['bank_account_name']; ?>">
								</div>

								<div class="payment bank col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">	
									<label><b>Deposite Slip No.</b></label>
									<input type="text" name="deposite_slip_no" class="form-control">
								</div>

								<div class="payment dd col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">	
									<label><b>DD No.</b></label>
									<input type="text" name="dd_no" class="form-control">
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<label><b>Remarks</b></label>
									<textarea class="form-control" name="remarks"></textarea>
								</div>

								<div class="col-md-12 form-group">
									<input type="submit" name="payment" value="PAY" class="btn btn-primary pull-right">
								</div>
							</form>
							<?php } ?>
							</div>
						</div>
					</div>
				</div>
  			</section>
		</div>
    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script> 
		<script>
		calculation();
		function calculation()
		{
			var totalamount = 0;
    		$(".paid_amount").each(function() {
    		totalamount += parseFloat(this.value, 10);
    		});
    		$('#total').val(totalamount);
		}
		$(document).on('keyup', '.paid_amount', calculation);
		</script>
		<script>
		$('.payment').hide();
		$(document).on('change', '#payment_mode', function(){
		if(this.value == 'Cash')
		{
			$('.payment').hide();
		}
		if(this.value == 'Cheque')
		{
			$('.payment').hide();
			$('.cheque').show();
		}
		if(this.value == 'Online Payment')
		{
			$('.payment').hide();
			$('.online').show();
		}
		if(this.value == 'Bank Deposite')
		{
			$('.payment').hide();
			$('.bank').show();
		}
		if(this.value == 'DD Payment')
		{
			$('.payment').hide();
			$('.dd').show();
		}
		})
		</script>
  	</body>
</html>