<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title> Product Category</title>
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
							<span class="elipsis title"><strong>Category</strong></span>
						</div>

						<div class="panel-body">

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#AddCategory">
									<i class="fa fa-plus"></i> Add Category
								</button>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="10%">S No</th>
											<th width="35%">Category</th>
											<th width="40%">Description</th>
											<th width="15%">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php if(mysqli_num_rows($categories) > 0 ){
										$i = 1;
										for($i = 0; $i < count($category_json); $i++) {  ?>
											<tr>
												<td><?php echo $i + 1; ?></td>
												<td><?php echo $category_json[$i]['in_category_name']; ?></td>
												<td><?php echo $category_json[$i]['in_description']; ?></td>
												<td>
													<?php if (in_array("13_5", $admin_permissions)) {?>
													<button type="button" class="editcategory btn btn-info btn-xs" data-toggle="modal" data-target="#EditCategory">
														<i class="fa fa-pencil-square-o"></i>
													</button>
													<?php } ?>
													<?php if (in_array("13_6", $admin_permissions)) {?>
													<a title="Delete Category" href="?pid=7&action=editcategory&delete=<?php echo $category_json[$i]['es_in_categoryid']; ?>" onclick="return confirm('<?php echo SM_CONFIRM_DELETE_MESSAGE;?>');" class="btn btn-danger btn-xs">
													&nbsp;<i class="fa fa-trash-o"></i>
													</a>
													<?php } ?>
												</td>
											</tr>
										<?php } ?> 
										<?php } else { ?>
											<tr>
												<td>No records found</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>

								<div id="AddCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddCategoryLabel" aria-hidden="true">
            						<div class="modal-dialog">
                						<div class="modal-content">
                    						<div class="modal-header" style="background-color:#4b5354;">
                        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         						<h4 class="modal-title" id="AddCategoryLabel" style="color:white;">ADD CATEGORY</h4>
                    						</div>

                   	 						<form method="post" action="">
                    							<div class="modal-body">
				
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
														<label><b>Category Name</b></label>
														<input type="text" name="in_category_name" class="form-control" required="required" />
													</div>

													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
														<label><b>Description</b></label>
														<textarea class="form-control" name="in_description" required="required"></textarea>
													</div>
												</div>

            									<div class="modal-footer">
                									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                									<button name="categorysubmit" type="submit" class="btn btn-primary" value="Submit">SUBMIT</button>
            									</div>
											</form>
										</div>
									</div>
								</div>

								<div id="EditCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="EditCategoryLabel" aria-hidden="true">
            						<div class="modal-dialog">
                						<div class="modal-content">
                    						<div class="modal-header" style="background-color:#4b5354;">
                        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         						<h4 class="modal-title" id="EditCategoryLabel" style="color:white;">EDIT CATEGORY</h4>
                    						</div>

                   	 						<form method="post" action="?pid=7&action=editcategory">
                    							<div class="modal-body" id="editcategory">

												</div>

            									<div class="modal-footer">
                									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                									<button name="categoryupdate" type="submit" class="btn btn-primary" value="Submit">SUBMIT</button>
            									</div>
											</form>
										</div>
									</div>
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
    	<script>	
        $('.editcategory').click(function(){
            str = this;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    $('#editcategory').html(this.responseText);
                }
            };
            xmlhttp.open("GET","?pid=7&action=editcategory&q="+$(str).val(),true);
            xmlhttp.send();
        });
    	</script>
  	</body>
</html>