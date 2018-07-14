<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Bonafied Certificates</title>
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
						<div class="panel panel-primary">
							<div class="panel-heading">
								<span class="title elipsis">
									<strong>Bonafied Certificate</strong>
								</span>
							</div>
							<div class="panel-body">

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="?pid=117&action=add" class="btn btn-info pull-right btn-sm"><i class="fa fa-plus"></i>Add New</a>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">

									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>CertiID</th>
                    							<th>Date</th>
                    							<th>Class</th>
												<th>Student Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$certificates = mysqli_query($mysqli_con, "SELECT es_bonafied.*, es_classes.es_classname FROM es_bonafied INNER JOIN es_classes ON es_classes.es_classesid = es_bonafied.class_id WHERE es_bonafied.status = 'Active' ORDER BY es_bonafied.id DESC");
										while($certificate = mysqli_fetch_assoc($certificates))
										{
											?>
											<tr>
												<td><?php echo $certificate['id']; ?></td>
												<td><?php echo date_format(date_create($certificate['date']), 'd/m/Y'); ?></td>
												<td><?php echo $certificate['es_classname']; ?></td>
												<td><?php echo $certificate['student_name']; ?></td>
												<td>
													<a href="?pid=117&action=print_bonafiedcertificate&id=<?php echo $certificate['id']; ?>" class="btn btn-warning btn-xs" target="_blank">
														&nbsp;<i class="fa fa-print"></i>
													</a>
												</td>
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
      	<script type="text/javascript">
      		$('#dd-7').addClass('active');
      		$('#dd-7-1').addClass('active');
      	</script>
  	</body>
</html>