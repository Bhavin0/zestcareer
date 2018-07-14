<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Activities</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
        <!-- THEME CSS -->
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
								<span class="elipsis title"><strong>Activities</strong></span>
							</div>
							<div class="panel-body">

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#AddActivity">
										<i class="fa fa-plus"></i> Add Activity
									</button>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="10%">ID</th>
												<th>Activity Name</th>
												<th width="20%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$activities = mysqli_query($mysqli_con, "SELECT * FROM student_activities ORDER BY order_by");
										while($activity = mysqli_fetch_assoc($activities)) { ?>
											<tr>
												<td><?php echo $activity['activity_id']; ?></td>
												<td><?php echo $activity['activity_name']; ?></td>
												<td>
													<button type="button" class="edit btn btn-info btn-xs" data-toggle="modal" data-target="#EditItem" value="<?php echo $item['es_in_item_masterid']; ?>">
													&nbsp;<i class="fa fa-pencil-square-o"></i>
													</button>

													<a title="Delete Item" href="?pid=7&action=deleteitem&item_id=<?php echo $item['es_in_item_masterid']; ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-xs">
													&nbsp;<i class="fa fa-trash-o"></i>
													</a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>

								<div id="AddActivity" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddActivity" aria-hidden="true">
            						<div class="modal-dialog modal-lg">
                						<div class="modal-content">
                    						<div class="modal-header" style="background-color:#4b5354;">
                        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         						<h4 class="modal-title" id="AddItemLabel" style="color:white;">ADD ACTIVITY</h4>
                    						</div>

											<form action ="" method = "post"/>
                    							<div class="modal-body"> 
													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
														<label><b>Activity Name</b></label>
														<input class="form-control" type="text" name="in_item_code">
													</div>

													<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 form-group">
														<label><b>Order</b></label>
														<input type="text" name="in_item_name" value="" class="form-control" />
													</div>
												</div>

            									<div class="modal-footer">
                									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                									<button name="itemSubmit" type="submit" class="btn btn-primary" value="Submit">SUBMIT</button>
            									</div>
											</form>
										</div>
									</div>
								</div>
							</div>
    					</div> <!-- col-LG-12 -->
  					</div>
  				</section>
			</div>
		</div>
    	<!-- JAVASCRIPT FILES -->
    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
        <script>
        $(function () {
            $(".table").DataTable({
                ordering: false
            })
        });
        </script>
  	</body>
</html>