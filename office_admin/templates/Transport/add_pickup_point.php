<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Add Transport Pickup Point</title>
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
          	$sel_year = "SELECT * FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
          	$res_year = getarrayassoc($sel_year);

          	$ledgers = mysqli_query($mysqli_con, "SELECT * FROM es_ledger") or die(MYSQLI_ERROR($mysqli_con));

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
								<span class="title elipsis">
									<strong>Add Transport Pickup Point</strong>
								</span>
							</div>

							<div class="panel-body">
								<form action="" name="fee_master" method="post" >
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
										<label class="col-md-2"><b>Academic Year</b></label>

										<select name="academy_year_id" id="academy_year_id" class="form-control">
						                    <?php $academic_years = mysqli_query($mysqli_con, "SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC");
						                    while($academic_year = mysqli_fetch_assoc($academic_years))
						                    {
						                      echo"<option value='".$academic_year['es_finance_masterid']."'>
						                      ".date_format(date_create($academic_year['fi_ac_startdate']), 'd/m/Y')." - 
						                      ".date_format(date_create($academic_year['fi_ac_enddate']), 'd/m/Y')."
						                      </option>";
						                    }
						                    ?>
						               	</select>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
										<label class="col-md-2"><b>Pickup point name</b></label>
										<input type="text" name="pickup_point_name" class="form-control">
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
										<label class="col-md-2"><b>Annual charge</b></label>
										<input type="number" name="annual_charge" class="form-control">
									</div>									
									
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
										<label class="col-md-2"><b>Ledger</b></label>
										<select name="ledger_id" id="ledger_id" class="form-control col-md-10" data-live-search="true" required="required">
											<?php while($ledger = mysqli_fetch_assoc($ledgers)) { ?>
												<option value="<?php echo $ledger['es_ledgerid']; ?>"> <?php echo $ledger['lg_name']; ?> </option>
											<?php } ?>
										</select>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
										<input type="submit" name="add_pickup_point" class="btn btn-primary pull-right">
									</div>

								</form>
							</div>
						</div>
  					</div>
  				</div>
  			</section>
		</div>

    	<!-- JAVASCRIPT FILES -->
    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>

		
  	</body>
</html>