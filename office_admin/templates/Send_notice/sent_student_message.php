<!doctype html>
<html lang="en-US">
	<head>
	     <meta charset="utf-8" />
	     <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	     <title>Send Notice to Student</title>
	     <meta name="description" content="" />
	     <meta name="Author" content="" />
	     <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
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

			<div id="content" class="dashboard" style="padding-top: 5px;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-3">
						<div class="row">
							<a href="?pid=57&action=compose">
								<button class="btn btn-primary form-control" style="text-align: left"><i class="fa fa-plus-square"></i> Compose</button>
							</a>
							<br><br>
							<div id="panel-ui-tan-l5" class="panel panel-default">
								<div class="panel-heading">
									<span class="elipsis">
										<strong>Folders</strong>
									</span>
									<ul class="options pull-right list-inline">
										<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
									</ul>
								</div>
								<div class="panel-body">
									<ul class="side-nav list-group margin-bottom30">
										<li class="list-group-item list-toggle">   <!-- NOTE: "active" to be open on page load -->                
											<a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-2"><i class="fa fa-level-down"></i> inbox</a>
											<ul id="collapse-2" class="collapse"><!-- NOTE: "collapse in" to be open on page load -->
												<li><a href="?pid=57&action=sent_student_message"><i class="fa fa-angle-right"></i> Student</a></li>
												<li><a href="?pid=57&action=sent_staff_message"><i class="fa fa-angle-right"></i> Staff</a></li>
											</ul>
										</li>
										<li class="list-group-item list-toggle">   <!-- NOTE: "active" to be open on page load -->                
											<a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-3"><i class="fa fa-level-down"></i> Sent</a>
											<ul id="collapse-3" class="collapse"><!-- NOTE: "collapse in" to be open on page load -->
												<li><a href="?pid=57&action=sent_student_message"><i class="fa fa-angle-right"></i> Student</a></li>
												<li><a href="?pid=57&action=sent_staff_message"><i class="fa fa-angle-right"></i> Staff</a></li>
											</ul>
										</li>

										<li class="list-group-item"><a href="#"><i class="fa fa-file-text-o"></i> Draft</a></li>
										<li class="list-group-item"><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
										
									</ul>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-md-9" style="left: 9px;">
						<div class="row">
					 		<div id="ui-1" class="panel panel-default">
                      			<div class="panel panel-primary">
									<div class="panel-heading">
										<span class="title elipsis">
											<strong>Sent Mesages</strong> <!-- panel title -->
										</span>
										<div class="navbar-form navbar-right" role="search" style="margin-top: -5px;">
							                <div class="has-feedback">
							                  <input class="form-control input-sm" placeholder="Search Mail" type="text">
							                  <span class="glyphicon glyphicon-search form-control-feedback" style="color:black;top:6px;"></span>
							                </div>
						                 </div>
				        			</div>
                     
						<!-- panel content -->
									<div class="panel-body">
			                           <div class="table-responsive">
											<table class="table table-hover table-vertical-middle nomargin">
												<thead>
													<tr>
														<th></th>
														<th>Student name</th>
														<th>Class</th>
														<th>Subject</th>
														<th> Date </th>
													</tr>
												</thead>
												<tbody>
													  <?php 
			                                             $sql = "SELECT es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname,es_finance_master.fi_startdate,es_finance_master.fi_enddate,es_classes.es_classname,es_notice_messages.*   FROM es_notice_messages INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_notice_messages.to_id INNER JOIN es_finance_master ON es_finance_master.es_finance_masterid = es_notice_messages.academic_year_id INNER JOIN es_classes ON es_classes.es_classesid = es_notice_messages.class_id WHERE to_type = 'student'";
																
																$res1 = mysql_query($sql);
																while( $row = mysql_fetch_assoc($res1))
														{?>
													<tr>
														<td role="gridcell" style="text-align:center;width: 25px;" aria-describedby="jqgrid_cb"><input role="checkbox" id="jqg_jqgrid_1" class="cbox" name="jqg_jqgrid_1" type="checkbox"></td>
														<td><?php  echo $row['pre_name']." ".$row['middle_name']." ".$row['pre_lastname'];?></td>
														<td><?php echo $row['es_classname'];?></td>
														<td><a href="?pid=57&action=subject&subj_id=<?php echo $row['es_messagesid'];?>"><?php echo $row['subject'];?></a></td>
														<td><?php echo YMDtoDMY($row['notice_date']);?></td>
													</tr>
														 <?php
														}?>
												</tbody>
											</table>
										</div>
									</div>
					    		</div>
					  		</div>
				    	</div>
				  	</div>
			    </div>
		    </div>


			<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
		    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
		    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
		  <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
		        
	</body>
</html>

