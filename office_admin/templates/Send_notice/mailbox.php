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
							<button class="btn btn-primary form-control" style="text-align: left"><i class="fa fa-plus-square"></i> Compose</button></a>
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
												<li><a href=""><i class="fa fa-angle-right"></i> Student</a></li>
												<li><a href=""><i class="fa fa-angle-right"></i> Staff</a></li>
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
								<strong>Inbox</strong> <!-- panel title -->
							</span>

							<div class="navbar-form navbar-right" role="search" style="margin-top: -5px;">
				                <div class="has-feedback">
				                  <input class="form-control input-sm" placeholder="Search Mail" type="text">
				                  <span class="glyphicon glyphicon-search form-control-feedback" style="color:black;top:6px;"></span>
				                </div>
				              </div>
				              <!-- <form class="navbar-form navbar-right" role="search">
									<div class="form-group">
										<input class="form-control" placeholder="Search" type="text">
									</div>
									<button class="btn btn-primary" type="submit">
										Submit
									</button>
								</form> -->
						</div>
                     
						<!-- panel content -->
						<div class="panel-body">

							<div class="table-responsive">
								<table class="table table-hover table-vertical-middle nomargin">
									<thead>
										<tr>
											<!-- <th class="width-30">Img</th>
											<th>Column name</th>
											<th>Ratings</th>
											<th>Progress</th>
											<th>Share</th>
											<th>Column name</th> -->
										</tr>
									</thead>
									<tbody>
										<tr>
											<td role="gridcell" style="text-align:center;width: 25px;" aria-describedby="jqgrid_cb"><input role="checkbox" id="jqg_jqgrid_1" class="cbox" name="jqg_jqgrid_1" type="checkbox"></td>
											
											<td class="mailbox-star"><a href="#"><i class="fa text-yellow fa-star-o"></i></a></td>
											<td>Alexander Pierce</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td><span class="label label-success">Approved </span></td>
										</tr>
										<tr>
											<td role="gridcell" style="text-align:center;width: 25px;" aria-describedby="jqgrid_cb"><input role="checkbox" id="jqg_jqgrid_1" class="cbox" name="jqg_jqgrid_1" type="checkbox"></td>
											
											<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
											<td>Alexander Pierce</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td><span class="label label-info">Pending </span></td>
										</tr>
										<tr>
											<td role="gridcell" style="text-align:center;width: 25px;" aria-describedby="jqgrid_cb"><input role="checkbox" id="jqg_jqgrid_1" class="cbox" name="jqg_jqgrid_1" type="checkbox"></td>
											
											<td class="mailbox-star"><a href="#"><i class="fa text-yellow fa-star-o"></i></a></td>
											<td>Alexander Pierce</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td><span class="label label-warning">Suspended </span></td>
										</tr>
										<tr>
											<td role="gridcell" style="text-align:center;width: 25px;" aria-describedby="jqgrid_cb"><input role="checkbox" id="jqg_jqgrid_1" class="cbox" name="jqg_jqgrid_1" type="checkbox"></td>
											
											<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
											<td>Alexander Pierce</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td><span class="label label-danger">Blocked </span></td>
										</tr>
										<tr>
											<td role="gridcell" style="text-align:center;width: 25px;" aria-describedby="jqgrid_cb"><input role="checkbox" id="jqg_jqgrid_1" class="cbox" name="jqg_jqgrid_1" type="checkbox"></td>
											
											<td class="mailbox-star"><a href="#"><i class="fa text-yellow fa-star-o"></i></a></td>
											<td>Alexander Pierce</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td><span class="label label-primary">N/A </span></td>
										</tr>
										<tr>
											<td role="gridcell" style="text-align:center;width: 25px;" aria-describedby="jqgrid_cb"><input role="checkbox" id="jqg_jqgrid_1" class="cbox" name="jqg_jqgrid_1" type="checkbox"></td>
											
											<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
											<td>Alexander Pierce</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												<a href="#" class="btn btn-default btn-xs"><i class="fa fa-edit white"></i> Edit </a>
												<a href="#" class="btn btn-default btn-xs"><i class="fa fa-times white"></i> Delete </a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>


						</div>
					</div>
						<!-- /panel content -->

						<div class="panel-footer">
                          <div class="btn-group">

			                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
			                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
			                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
			                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
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

