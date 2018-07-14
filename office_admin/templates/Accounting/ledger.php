<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Ledger Entries</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
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
              <!-- PANEL START -->
	            <div class="panel panel-primary">
		            <div class="panel-heading">
			            <span class="elipsis title"><strong>Ledger Entries</strong></span>
		            </div>

		            <div class="panel-body">
						<form action="?pid=25&action=ledger" method="post" name="ledger">

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
							<label><b>Ledger Type</b></label>
							<select name="es_particulars" class="form-control">
								<?php $ledgerlistarr =ledger_finance();
								foreach($ledgerlistarr as $eachledger) { ?>
								<option value="<?php echo $eachledger['es_ledgerid']; ?>" <?php if($es_particulars==$eachledger['es_ledgerid']) { echo "selected='selected'"; } ?>><?php echo $eachledger['lg_name']; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
							<label><b>FROM</b></label> 
							<input type="text" class="datepicker form-control" name="from" value="<?php echo (isset($_POST['from']))?$_POST['from']:date('Y-m-d'); ?>">	
						</div>

						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
							<label><b>TO</b></label> 
							<input type="text" class="datepicker form-control" name="to" value="<?php echo (isset($_POST['to']))?$_POST['to']:date('Y-m-d'); ?>">	
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
							<input name="ledgersummerysub" type="submit" class="btn btn-primary pull-right" value="Search">
						</div>
						</form>

						<?php if ($ledgersummerysub=='Search' ) {
							$ledgers = mysqli_query($mysqli_con, "SELECT SUM(`ledger_entries`.`amount_in`) AS amount_in,  `es_voucherentry`.`es_voucherdate`, `es_voucherentry`.`opposite_partyname`, `es_voucherentry`.`es_voucherno`, `es_voucherentry`.`es_narration`,  `es_voucherentry`.`es_paymentmode` FROM `ledger_entries` INNER JOIN `es_voucherentry` ON `es_voucherentry`.es_voucherentryid = `ledger_entries`.es_voucher_id WHERE (`ledger_entries`.es_ledger_id =".$_POST['es_particulars'].") AND (`es_voucherentry`.es_voucherdate BETWEEN '".$_POST['from']."' AND '".$_POST['to']."') GROUP BY `ledger_entries`.`es_voucher_id`");
						?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
							<a href="?pid=25&action=ledger_print&ledger_id=<?php echo $_POST['es_particulars']; ?>&from=<?php echo $_POST['from']; ?>&to=<?php echo $_POST['to']; ?>" class="btn btn-warning pull-right">
								<i class="fa fa-file-pdf-o"></i> PRINT
							</a>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
							<table class="table table-bordered table-striped">
								<thead>	
									<tr>
									<th>Sr No.</th>
									<th>Date</th>
									<th>Student Name</th>
									<th>Voucher</th>
									<th>Payment Detail</th>
									<th>Amount</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$srno = 1;
								$cash = 0;
								$cheque = 0;
								while($ledger = mysqli_fetch_assoc($ledgers)) {
									if(($ledger['amount_out'] + $ledger['amount_in']) > 0) {
									?>
									<tr>
										<td><?php echo $srno++; ?></td>
										<td><?php echo date_format(date_create($ledger['es_voucherdate']), 'd/m/Y'); ?></td>
										<td><?php echo $ledger['opposite_partyname']; ?></td>
										<td><?php echo $ledger['es_voucherno']; ?></td>
										<td><?php echo $ledger['es_paymentmode']; ?>
										<?php if($ledger['es_narration']!='') { echo "<br>".$ledger['es_narration']; } ?></td>
										<td><?php echo $ledger['amount_in']; ?></td>
									</tr>
								<?php if($ledger['es_paymentmode']=='Cheque') { $cheque = $cheque + $ledger['amount_in']; } 
								else { $cash = $cash + $ledger['amount_in']; }

								} } ?>
								</tbody> 
								<tfoot>
									<tr>
										<td colspan="5" align="right"><b>CASH BALANCE...</b></td>
										<td><?php echo $cash; ?></td>
									</tr>
									<tr>
										<td colspan="5" align="right"><b>CHEQUE BALANCE...</b></td>
										<td><?php echo $cheque; ?></td>
									</tr>
									<tr>
										<td colspan="5" align="right"><b>TOTAL BALANCE...</b></td>
										<td><?php echo $cash + $cheque; ?></td>
									</tr>
								</tfoot>
		  					</table>
		  				</div>
		  				<?php } ?>
              </div>
            </div>
          </div>
        </section>
      </div>

      	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
      	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
      	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>     	
		<script type="text/javascript">
  			$('#dd-17').addClass('active');
  			$('#dd-17-5').addClass('active');
  			$('#dd-17-5-2').addClass('active');
		</script>
    </body>
</html>		