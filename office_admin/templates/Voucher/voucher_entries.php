<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title><?php echo $_GET['voucher_type']; ?> Vouchers</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
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
			            	<span class="elipsis title"><strong><?php echo $_GET['voucher_type']; ?> Vouchers</strong></span>
		            	</div>

		            	<div class="panel-body">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
								<?php 
									$vouchers = mysqli_query($mysqli_con, "SELECT * FROM es_voucherentry WHERE es_vouchertype='".$_GET['voucher_type']."'");
								?>
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="15%">Voucher No.</th>
											<th width="10%">Date</th>
											<th width="15%">Ledger</th>
											<th>Particular</th>
											<th>Payment Mode</th>
											<th>Amount Received</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while($voucher = mysqli_fetch_assoc($vouchers))
										{
										?>
										<tr>
											<td><?php echo $voucher['es_voucherno']; ?></td>
											<td><?php echo date_format(date_create($voucher['es_voucherdate']), 'd/m/Y'); ?></td>
											<td><?php echo $voucher['es_ledger']; ?></td>
											<td><?php echo $voucher['opposite_partyname']; ?>
												<?php if($voucher['es_narration']!='') { echo "<br>(".$voucher['es_narration'].")"; } ?>
											</td>
											<td><?php echo $voucher['es_paymentmode']; ?></td>
											<td><?php echo $voucher['es_amount_in']; ?></td>
										</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
                		</div>
              		</div>
            	</div>
          	</div>
        	</section>
      	</div>
      	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
      	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
      	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
  	</body>
</html>