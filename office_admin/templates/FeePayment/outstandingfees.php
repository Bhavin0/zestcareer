<?php require_once('../includes/pagination.php'); ?>
<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Outstanding Fees</title>
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
								<span class="title elipsis"><strong>Outstanding Fees</strong></span>
							</div>

							<div class="panel-body">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<a type="button" class="btn btn-warning pull-right" href="?pid=40&action=outstandingfees_print" target="blank_">
										<i class="fa fa-file-pdf-o"></i> Print
									</a>

									<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#Filter">
										<i class="fa fa-filter"></i> Filter Results
									</button>
								</div>

								<div class="modal fade modal-primary" tabindex="-1" role="dialog" aria-labelledby="FilterLabel" aria-hidden="true" id="Filter">
									<div class="modal-dialog">
										<div class="modal-content">
											<form action="?pid=40&action=outstandingfees" method="get">
													<!-- Modal Header -->
												<div class="modal-header" style="background-color: #4b5354;">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel" style="color:#ffffff">Filter Results</h4>
												</div>
												<!-- Modal Body -->
												<div class="modal-body">
													<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
														<label><b>Academic Year</b></label>
														<select class="form-control" name="academic_year_id">
														<?php
														$sql = mysql_query("SELECT * FROM es_finance_master");
														while($row = mysql_fetch_assoc($sql))
														{
														echo"<option value='".$row['es_finance_masterid']."'> ".date_format(date_create($row['fi_ac_startdate']), 'd/m/Y')." - ".date_format(date_create($row['fi_ac_enddate']), 'd/m/Y')." </option>";
														}
														?>
														</select>
													</div>

													<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
														<label><b>Section</b></label>
														<select name="section_id" class="form-control" onchange="fetchclass(this.value)">
														<option value="ALL">ALL</option>
														<?php
														$sql1 = mysql_query("SELECT * FROM es_groups ORDER BY es_grouporderby ASC");
														while($row = mysql_fetch_assoc($sql1))
														{
    													echo"<option value='".$row['es_groupsid']."'> ".$row['es_groupname']."</option>";
							    						}
    													?>
														</select>
													</div>


													<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
														<label><b>Class</b></label>
														<select name="class_id" class="form-control" id="classes">
															<option value="ALL">ALL</option>
														</select>
													</div>

													<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
														<label><b>Semester</b></label>
														<select name="semester_id" class="form-control" id="semesters">
															<option value="ALL">ALL</option>
														</select>
													</div>
												</div>
												<!-- Modal Footer -->
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">SEARCH</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<?php

								$query = "SELECT COUNT(*) FROM es_preadmission_details WHERE pre_fromdate ='".$res_year['fi_ac_startdate']."' AND pre_todate ='".$res_year['fi_ac_enddate']."'";
								
								$students = mysqli_fetch_array(mysqli_query($mysqli_con, $query), MYSQLI_NUM);

								?>

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<i style="color:blue;">Showing result for academic year <?php echo date_format(date_create($res_year['fi_ac_startdate']), 'Y')."-".date_format(date_create($res_year['fi_ac_enddate']), 'y'); ?></i>
								</div>
								<!-- TABLE -->
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th width="10%">Student ID</th>
												<th width="30%">Student Name</th>
												<th width="10%">GR No.</th>
												<th width="10%">Class</th>
												<th width="10%">Mobile No.</th>
												<th width="10%">Payble Fees</th>
												<th width="10%">Paid</th>
												<th width="10%">Outstanding</th>
											</tr>
										</thead>
										<tbody id="outstanding">
											
										</tbody>
									</table>
								</div>

								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 col-xs-offset-4">
    								<div class="input-group">
      									<span class="input-group-btn">
       	 									<button class="btn btn-primary previous_page" type="button"><i class="fa fa-arrow-left"></i></button>
      									</span>

      									<input type="text" class="form-control" value="1" style="text-align:center;" id="page_number">

      									<span class="input-group-btn">
       	 									<button class="btn btn-primary next_page" type="button"><i class="fa fa-arrow-right"></i></button>
      									</span>
    								</div>
								</div>
							</div>
						</div>
						<!-- PANEL END-->
					</div>
				</div>
  			</section>
		</div>
    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    	<script>
    		$(document).on('click', '.next_page', function(){
    			var page_number  = $('#page_number').val();
    			var next_page = parseInt(page_number) + 1;
    			$('#page_number').val(next_page);
    			pagination();
    		})

    		$(document).on('click', '.previous_page', function(){
    			var page_number  = $('#page_number').val();
    			var next_page = parseInt(page_number) - 1;
    			$('#page_number').val(next_page);
    			pagination();
    		})
    		
    		function pagination()
    		{
    			var page_number = $('#page_number').val();
          		var data = {page_number : page_number};
          		var saveData = $.ajax({
          		type: 'POST',
          		url: "?pid=40&action=outstandingfees_pagination",
          		data: data,
          		dataType: "text",
          			success: function(resultData) {
            			$('#outstanding').html(resultData);
            		}
          		});
    		}

    		pagination();
    	</script>
  	</body>
</html>