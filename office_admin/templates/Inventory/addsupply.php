<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php if (isset($arr_pages[$pid]['title'])) echo $arr_pages[$pid]['title']; ?></title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    
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
							<span class="elipsis title"><strong>Supplier</strong></span>
						</div>

						<div class="panel-body">

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#AddSupplier">
									<i class="fa fa-plus"></i> Add Supplier
								</button>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
								<table class="table table-bordered">
									<thead>	
										<tr>
											<th>S.No</th>
											<th>Supplier Name</th>
											<th>Contact</th>
											<th>Banking Detail</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php if(mysqli_num_rows($suppliers) > 0 ){ 
									$i = 1;
									while($supplier = mysqli_fetch_assoc($suppliers)) { ?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td>
												<b><?php echo $supplier['in_name']; ?></b><br>
												<?php echo $supplier['in_address']; ?><br />
  												<?php echo $supplier['in_city']; ?>, <?php echo $supplier['in_state']; ?>,
  												<?php echo $supplier['in_country']; ?></td>
											<td>
												<?php if($supplier['in_email']!=""){ ?>
												Email:<a href="mailto:<?php echo $supplier['in_email']; ?>">
												<?php echo $supplier['in_email']; ?></a><br />
												<?php } ?>
												Office No : <?php echo $supplier['in_office_no']; ?><br/> 
												<?php if($supplier['in_mobile_no']!=""){ ?>
												Mobile No : <?php echo $supplier['in_mobile_no']; ?><br/>
												<?php } ?> 
												<?php if($supplier['in_fax']!=""){ ?>
												Fax : <?php echo $supplier['in_fax']; ?>
												<?php } ?>
											</td>
											<td>
												Account Name : <?php echo $supplier['bank_account_name']; ?><br>
												Account No. : <?php echo $supplier['bank_account_no']; ?><br>
												Bank Name: <?php echo $supplier['bank_name']; ?><br>
												Branch : <?php echo $supplier['bank_branch']; ?><br>
												Beneficiary Code : <?php echo $supplier['beneficary_code']; ?>
											</td>
											<td>
												<?php if (in_array("13_11", $admin_permissions)) {?>
												<a title="Edit Supply" href="" class="btn btn-info btn-xs">
													<i class="fa fa-pencil-square-o"></i>
												</a>
												<?php } ?>
												<?php if (in_array("13_12", $admin_permissions)) {?>
												<a title="Delete Supply" href="" onclick="return confirm('<?php echo SM_CONFIRM_DELETE_MESSAGE;?>');" class="btn btn-danger btn-xs">
													<i class="fa fa-trash-o"></i>
												</a>
												<?php } ?>
												<?php if (in_array("13_21", $admin_permissions)) {?>
												<a title="View Supply" href="" class="btn btn-warning btn-xs">
													<i class="fa fa-eye"></i>
												</a>
												<?php } ?>
											</td>
										</tr>
										<?php } ?>
										<?php } else { ?>
										<tr>
											<td colspan="5">No records found</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>

							<div id="AddSupplier" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddSupplierLabel" aria-hidden="true">
            					<div class="modal-dialog modal-lg">
                					<div class="modal-content">
                    					<div class="modal-header" style="background-color:#4b5354;">
                        					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         					<h4 class="modal-title" id="AddSupplierLabel" style="color:white;">ADD SUPPLIER</h4>
                    					</div>
										<form action="" method="post" >
                    						<div class="modal-body">
												<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 form-group">
													<label><b>Supplier Name *</b></label>
													<input type="text" name="in_name" value="" class="form-control" />
												</div>

												<div class="col-lg-3 col-md-3 col-xs-12 col-sm-12 form-group">
													<label><b>Office No.</b></label>
													<input type="text" name="in_office_no" value="" class="form-control" />
												</div>

												<div class="col-lg-3 col-md-3 col-xs-12 col-sm-12 form-group">
													<label><b>Mobile No.</b></label>
													<input type="text" name="in_mobile_no" value="" class="form-control" />
												</div>

												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 form-group">
													<label><b>City</b></label>
													<input type="text" name="in_city"  value="" class="form-control" />
												</div>

												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 form-group">
													<label><b>State</b></label>
													<input type="text" name="in_state" value="" class="form-control" />
												</div>

												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 form-group">
													<label><b>Country</b></label>
													<input type="text" name="in_country" value="" class="form-control" />
												</div>

												<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 form-group">
													<label><b>Address *</b></label>
													<textarea name="in_address" cols="16" class="form-control"></textarea>
												</div>

												<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 form-group">
													<label><b>Description</b></label>
													<textarea name="in_description" cols="16" class="form-control"></textarea>
												</div>

												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 form-group">
													<label><b>Email</b></label>
													<input type="text" name="in_email" value="" class="form-control" />
												</div>

												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 form-group">
													<label><b>Beneficiary Code</b></label>
													<input type="text" name="beneficary_code" value="" class="form-control" />
												</div>

												<div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 form-group">
													<label><b>Fax</b></label>
													<input type="text" name="in_fax" value="" class="form-control" />
												</div>

												<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 form-group">
													<label><b>Account Name</b></label>
													<input type="text" name="bank_account_name" value="" class="form-control" />
												</div>

												<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 form-group">
													<label><b>Account No.</b></label>
													<input type="text" name="bank_account_no" value="" class="form-control" />
												</div>

												<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 form-group">
													<label><b>Bank Name</b></label>
													<input type="text" name="bank_name" value="" class="form-control" />
												</div>

												<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 form-group">
													<label><b>Branch</b></label>
													<input type="text" name="bank_branch" value="" class="form-control" />
												</div>

											</div>

            								<div class="modal-footer">
                								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                								<button name="supplysubmit" type="submit" class="btn btn-primary" value="Submit">SUBMIT</button>
            								</div>
										</form>
									</div>
								</div>
							</div>
    					</div> <!-- col-LG-12 -->
  					</div>
  				</section>
			</div>
    	<!-- JAVASCRIPT FILES -->
    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
  	</body>
</html>