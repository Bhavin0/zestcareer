<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Admin List</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link href="<?php echo base_url('assets/fonts/googlefonts.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
  	<?php
    	include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
    	include(TEMPLATES_PATH . DS . 'header_new.tpl.php');

    	$pickup_points = mysqli_query($mysqli_con, "SELECT transport_pickup_points.*,es_finance_master.fi_startdate,es_finance_master.fi_enddate,es_ledger.lg_name FROM transport_pickup_points INNER JOIN es_finance_master ON es_finance_master.es_finance_masterid = transport_pickup_points.academic_id INNER JOIN es_ledger ON es_ledger.es_ledgerid = transport_pickup_points.ledger_id") or die(MYSQLI_ERROR($mysqli_con));
    	?>
      		<section id="middle">
        		<header id="page-header">
          			<h1><i class="fa fa-bus"></i> Pickup points List</h1>
        		</header>

        		<div id="content" class="dashboard" style="padding-top: 5px;">
        			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  						<div class="panel panel-primary">
							<div class="panel-body">
								<label class="pull-right">
			                        <a href="?pid=142&action=add_pickup_point" class="btn btn-primary">
			                            <i class="fa fa-plus"></i> Add Pickup point
			                        </a>
			                    </label>

								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
										<table  class="table table-striped table-bordered table-hover">
											<thead>
		  										<tr>
													<th>S No</th>
													<th>Name</th>
													<th>Annual Charges</th>	
													<th>Academic Year</th>
													<th>Ledger</th>
													<th>Action</th>
		  										</tr>
											</thead>
											<tbody>
		  									<?php 
		  										$i = 1;
												while($point = mysqli_fetch_assoc($pickup_points)) { ?>	
		  										<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $point['pickuppoint_name']; ?></td>
													<td><?php echo $point['annual_charges']; ?> </td>
													<td><?php echo $point['fi_startdate'].'-'.$point['fi_enddate']; ?></td>
													<td><?php echo $point['lg_name']; ?> </td>
													<td>
													<a href="?pid=142&action=edit_pickup_point&pickup_id=<?php echo $point['tr_place_id']; ?>" title="Edit" class="btn btn-warning btn-xs">
														&nbsp;<i class="fa fa-pencil-square-o"></i>
													</a>&nbsp;
            										<a href="?pid=142&action=delete_pickup_point&pickup_id=<?php echo $point['tr_place_id']; ?>" title="Delete" class="btn btn-danger btn-xs" onclick="return confirm('are you sure you want to delete this admin');">
            											&nbsp;<i class="fa fa-trash-o"></i>
            										</a></td>
		  										</tr>
		  									<?php } ?>
      										</tbody>
										</table>
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