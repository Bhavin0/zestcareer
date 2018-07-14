
<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>View MESSAGE</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />

		<!-- FOOTABLE TABLE -->
		<link href="<?php echo base_url('assets/plugins/footable/css/footable.core.min.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/plugins/footable/css/footable.standalone.css'); ?>" rel="stylesheet" type="text/css" />
		
	</head>
	
	<body>
		<?php
        include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
        include(TEMPLATES_PATH . DS . 'header_new.tpl.php');
        ?>
		<section id="middle">
			<header id="page-header">
                <ol class="breadcrumb">
                    <li>
                        <b> Academic Year : </b>
                        <?php if($res_year['fi_ac_startdate']!=""){ echo displaydate($res_year['fi_ac_startdate']);?> to <?php echo displaydate($res_year['fi_ac_enddate']); } else { echo "---"; }?>
                    </li>
                </ol>
            </header>
			<div id="content" class="padding-20">
				<div id="panel-1" class="panel panel-primary">
					<div class="panel-heading">
						<span class="title elipsis">
							<strong>INBOX</strong> <!-- panel title -->
						</span>
						<ul class="options pull-right list-inline">
							<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
							<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
							<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
						</ul>
					</div>
					<!-- panel content -->
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-vertical-middle nomargin">
								<thead>
									<tr>
														<!-- <th></th>
														<th>Student name</th>
														<th>Class</th>
														<th>Subject</th>
														<th> Date </th> -->
													</tr>
								</thead>
								<tbody>
									 <?php 
									// print_r($_SESSION);exit;
									  $user_id = $_SESSION['eschools']['user_id'];
			                                             $sql = "SELECT es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname,es_finance_master.fi_startdate,es_finance_master.fi_enddate,es_classes.es_classname,es_notice_messages.*   FROM es_notice_messages INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_notice_messages.to_id INNER JOIN es_finance_master ON es_finance_master.es_finance_masterid = es_notice_messages.academic_year_id INNER JOIN es_classes ON es_classes.es_classesid = es_notice_messages.class_id WHERE to_id = '$user_id'";
																
																$res1 = mysql_query($sql);
																while( $row = mysql_fetch_assoc($res1))
														{?>
									<tr>
											<td role="gridcell" style="text-align:center;width: 25px;" aria-describedby="jqgrid_cb"><input role="checkbox" id="jqg_jqgrid_1" class="cbox" name="jqg_jqgrid_1" type="checkbox"></td>
											<td><a href="?pid=27&action=subject&subj_id=<?php echo $row['es_messagesid'];?>"><?php echo $row['subject'];?></a></td>
											<td><?php echo YMDtoDMY($row['notice_date']);?></td>
										</tr>
										<?php }?>
								</tbody>
							</table>
						</div>  
					</div>
					<div class="panel-footer">
						<div class="btn-group">

		                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
		                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
		                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
		                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
	               		 </div>
					</div>
						<!-- /panel footer -->
                </div>
			</div>
		</section>
			<!-- /MIDDLE -->

		



	
		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = "<?php echo base_url('assets/plugins/'); ?>";</script>
		<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>

		

	</body>
</html>