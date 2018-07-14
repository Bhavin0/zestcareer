<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Trasfer Certificate</title>
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
									<strong>Transfer Certificate</strong>
								</span>
							</div>

							<div class="panel-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                  <?php 
                  $certies = mysqli_query($mysqli_con, "SELECT * FROM es_transferstudent ORDER BY id DESC"); 
                  ?>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th width="10%">SR No.</th>
                        <th width="10%">Date.</th>
                        <th width="10%">GRN No.</th>
                        <th width="50%">Student Name</th>
                        <th width="20%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while($certi = mysqli_fetch_assoc($certies)) { ?>
                      <tr>
                        <td><?php echo $certi['id']; ?></td>
                        <td><?php echo date_format(date_create($certi['date']), 'd/m/Y'); ?></td>
                        <td><?php echo $certi['grno']; ?></td>
                        <td><?php echo $certi['name_of_student']; ?></td>
                        <td>
                          <a href="?pid=23&action=print_tc&tc_id=<?php echo $certi['id']; ?>" class="btn btn-warning btn-xs" target="_blank">
                            &nbsp;<i class="fa fa-print"></i>
                          </a>
                          <a href="?pid=23&action=edit_tc&tc_id=<?php echo $certi['id']; ?>" class="btn btn-info btn-xs" target="_blank">
                            &nbsp;<i class="fa fa-pencil-square-o"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>  
                    </tbody>
                  </table>
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