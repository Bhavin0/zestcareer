<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Voucher Entries</title>
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
			            	<span class="elipsis title"><strong>Voucher Entries</strong></span>
		            	</div>

		            	<div class="panel-body">
							<div class="col-md-3 col-sm-6">
								<div class="box warning">
									<div class="box-title">
										<h4><a href="?pid=24&action=voucher_entries&voucher_type=Contra">Contra Vouchers</a></h4>
										<small class="block"><?php echo $contra[0]; ?> New vouchers today</small>
										<i class="fa fa-balance-scale"></i>
									</div>
									<div class="box-body text-center">
										<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
											331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
										</span>
									</div>
								</div>
							</div>

							<div class="col-md-3 col-sm-6">
								<div class="box danger">
									<div class="box-title">
										<h4><a href="?pid=24&action=voucher_entries&voucher_type=Payment">Payment Vouchers</a></h4>
										<small class="block"><?php echo $payment[0]; ?> New vouchers today</small>
										<i class="fa fa-sign-out"></i>
									</div>
									<div class="box-body text-center">
										<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
											331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
										</span>
									</div>
								</div>
							</div>

							<div class="col-md-3 col-sm-6">
								<div class="box success">
									<div class="box-title">
										<h4><a href="?pid=24&action=voucher_entries&voucher_type=Receipt">Receipt Vouchers</a></h4>
										<small class="block"><?php echo $receipt[0]; ?> New vouchers today</small>
										<i class="fa fa-sign-in"></i>
									</div>
									<div class="box-body text-center">
										<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
											331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
										</span>
									</div>
								</div>
							</div>

							<div class="col-md-3 col-sm-6">
								<div class="box info">
									<div class="box-title">
										<h4><a href="?pid=24&action=voucher_entries&voucher_type=Journal">Journal Vouchers</a></h4>
										<small class="block"><?php echo $journal[0]; ?> New vouchers today</small>
										<i class="fa fa-book"></i>
									</div>
									<div class="box-body text-center">
										<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
											331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
										</span>
									</div>
								</div>
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