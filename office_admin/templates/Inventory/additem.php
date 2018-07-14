<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Product Items</title>
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
								<span class="elipsis title"><strong>Item</strong></span>
							</div>
							<div class="panel-body">

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#AddItem">
										<i class="fa fa-plus"></i> Add Item
									</button>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>ID</th>
												<th>Code</th>
												<th>Item Name</th>
												<th>Category</th>
												<th>On Hand</th>
												<th> Issued till Now</th>
												<th>Type</th>
												<th>Re-order Level</th>
												<th>Last Issued Date</th>
												<th>Last Received Date</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php if(mysqli_num_rows($items) > 0 ){
										$i = 1;
										while($item = mysqli_fetch_assoc($items))
										{ 
											if($item['in_reorder_level']>=$item['in_qty_available'] && $item['in_qty_available'] > 0)
											{ $class = 'warning'; } 
											elseif($item['in_qty_available'] <= 0)
											{ $class = 'danger'; }
											else
											{ $class = 'info'; }
											?>
											<tr class="<?php echo $class; ?>">
												<td><?php echo $item['es_in_item_masterid']; ?></td>
												<td><?php echo $item['in_item_code']; ?></td>
												<td><?php echo $item['in_item_name']; ?></td>
												<td><?php echo $item['in_category_name']; ?></td>
												<td><?php echo $item['in_qty_available']." ".$item['in_units']; ?></td>
												<td><?php echo $item['in_quantity_issued']; ?></td>
												<td><?php echo $item['in_inventory_id']; ?></td>
												<td><?php echo $item['in_reorder_level']; ?></td>
												<td><?php echo date_format(date_create($item['in_last_issued_date']), 'd/m/Y h:m:s'); ?></td>
												<td><?php echo date_format(date_create($item['in_last_recieved_date']), 'd/m/Y h:m:s'); ?></td>
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
										<?php } else { ?>
											<tr>
												<td colspan='11' align="center">No records found</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>

								<div id="AddItem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddItemLabel" aria-hidden="true">
            						<div class="modal-dialog modal-lg">
                						<div class="modal-content">
                    						<div class="modal-header" style="background-color:#4b5354;">
                        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         						<h4 class="modal-title" id="AddItemLabel" style="color:white;">ADD ITEM</h4>
                    						</div>

											<form action ="" method = "post"/>
                    							<div class="modal-body"> 
													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
														<label><b>Item Code.</b></label>
														<input class="form-control" type="text" name="in_item_code">
													</div>

													<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 form-group">
														<label><b>Item Name</b></label>
														<input type="text" name="in_item_name" value="" class="form-control" />
													</div>

													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
														<label><b>Inventory Type</b></label>
														<select name="in_inventory_id" class="form-control">
															<option value="Returnable Goods">Returnable Goods</option>
															<option value="Non-returnable Goods">Non-returnable Goods</option>
														</select>
													</div>

													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
														<label><b> Category </b></label>
														<select name="in_category_id" class="form-control">
															<option value="">Select Category</option>
															<?php
															if (count($category_json)>0){		
																for($i = 0; $i < count($category_json); $i++){ ?>                               
															<option value="<?php  echo $category_json[$i]['es_in_categoryid']; ?>">
															<?php echo $category_json[$i]['in_category_name']; ?>
															</option>
															<?php }
															} ?>										
														</select>
													</div>

													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
														<label><b> Unit </b></label>
														<input type="text" name="in_units" value="" class="form-control" />
													</div>

													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
														<label><b> Sales Price </b></label>
														<input type="number" name="cost" value="" class="form-control" min="0" />
													</div>

													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
														<label><b> Qty in hand </b></label>
														<input type="number" name="in_qty_available" value="" class="form-control" min="0" />
													</div>

													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
														<label><b> Re-order level </b></label>
														<input type="number" name="in_reorder_level" value="" class="form-control" />
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

								<div id="EditItem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddItemLabel" aria-hidden="true">
            						<div class="modal-dialog modal-lg">
                						<div class="modal-content">
                    						<div class="modal-header" style="background-color:#4b5354;">
                        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         						<h4 class="modal-title" id="AddItemLabel" style="color:white;">ADD ITEM</h4>
                    						</div>
											<form action ="" method = "post"/>
                    							<div class="modal-body" id='edit_item'> 
									
												</div>
            									<div class="modal-footer">
                									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                									<button name="itemUpdate" type="submit" class="btn btn-primary" value="Submit">SUBMIT</button>
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
        	$(document).on('click', '.edit', function(){
        		var str = this;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $('#edit_item').html(this.responseText);
                }
                };
            	xmlhttp.open("GET","?pid=7&action=edit_item&q="+$(str).val(),true);
            	xmlhttp.send();
        	});
        </script>
        <script>
        $(function () {
            $(".table").DataTable({
                ordering: false
            })
        });
        </script>
  	</body>
</html>