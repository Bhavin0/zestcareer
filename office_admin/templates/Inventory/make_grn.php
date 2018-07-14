<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Goods Receipt Note</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
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
                                <strong>Goods Receipt Note</strong>
                            </div>
				            <?php
					            $grn_no = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT MAX(grn_id) FROM es_in_goods_receipt_note"), MYSQLI_NUM);
		 		            ?>
		 		            <div class="panel-body">
		 		            <form action="?pid=7&action=make_grn" method="post">
		 		            	<?php
		 		            	if(isset($_GET['order_id'])){
    								$order = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_in_orders.*, es_in_supplier_master.in_name FROM es_in_orders INNER JOIN es_in_supplier_master ON es_in_supplier_master.es_in_supplier_masterid = es_in_orders.in_suplier_id WHERE es_in_orders.es_in_ordersid = ".$_GET['order_id']), MYSQLI_ASSOC);

    								$order_items = mysqli_query($mysqli_con, "SELECT * FROM es_in_orders_items WHERE es_order_id =".$_GET['order_id']);
    							}
								?>

								<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-group">
									<label><b>GRN No.</b></label>
									<span class="form-control"><?php echo ($grn_no[0]=='')?1:$grn_no[0]; ?></span>
									<input type="hidden" name="order_id" value="<?php echo isset($_GET['order_id'])?$_GET['order_id']:'NULL'; ?>">
								</div>

								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									<label><b>Supplier</b></label>
                                	<select name="in_suplier_name" id="in_suplier_name" class="form-control" <?php echo isset($_GET['order_id'])?'disabled':''; ?> required="required">
                                    	<option selected="" disabled="">--SELECT SUPPLIER--</option>
                                    	<?php while($supplier = mysqli_fetch_assoc($suppliers)) {
                                    	if(isset($_GET['order_id']) && $order['in_suplier_id']==$supplier['es_in_supplier_masterid'])
                                    		{ $selected = 'selected'; } else { $selected = ''; }
                                    	?>
                                   		<option value="<?php echo $supplier['es_in_supplier_masterid']; ?>" <?php echo $selected; ?>>
                                      		<?php echo $supplier['in_name']; ?>
                                   		</option>
                                    	<?php } ?>
                                	</select>
								</div>

								<?php
								if(isset($_GET['order_id']))
								{
									?>
									<input type="hidden" name="in_suplier_name" value="<?php echo $order['in_suplier_id']; ?>">
									<?php
								}
								?>

								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
									<label>GRN Date</label>
									<input class="datepicker form-control" name="in_rec_date" value="<?php echo date('Y-m-d'); ?>" readonly="" required="required">
								</div>

								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
									<label>Bill No.</label>
									<input type="text" name="in_rec_bill_no" class="form-control"  required="required" />
								</div>

								<div class="row">
									<h4>&nbsp;Purchase Order List</h4>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="23%">Category</th>
												<th width="23%">Item Code (Item Name)</th>
												<th width="10%">Quantity</th>
												<th width="15%">Price</th>
												<th width="15%">Amount</th>
												<th width="12%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										if(isset($_GET['order_id']) && mysqli_num_rows($order_items)>0)
										{
										while($ord_item = mysqli_fetch_assoc($order_items)) { ?>
											<tr>
                                        		<td>
                                            		<select class="category form-control" name="item_category[]" required="required">
                                                		<option selected="" disabled="">--SELECT CATEGORY--</option>
                                                		<?php for($i = 0; $i < count($category_json); $i++)
                                                		{
                                                		$selected = ($ord_item['item_category']==$category_json[$i]['es_in_categoryid'])?'selected':'';
                                                		echo"<option value='".$category_json[$i]['es_in_categoryid']."' ".$selected.">".$category_json[$i]['in_category_name']."</option>";
                                               			}
                                               			?>
                                            		</select>
                                      			</td>
                                        		<td>
                                            		<?php $sub_items = mysqli_query($mysqli_con, "SELECT * FROM es_in_item_master WHERE in_category_id =".$ord_item['item_category']); ?>
                                            		<select class="items form-control" name="item_id[]" required="">
                                               			<option selected="" disabled="">--SELECT ITEM--</option>
                                                		<?php
                                                		while($sub_item = mysqli_fetch_assoc($sub_items))
                                                		{
                                                		$selected = ($sub_item['es_in_item_masterid']==$ord_item['item_id'])?'selected':'';
                                                		echo"<option value='".$sub_item['es_in_item_masterid']."' ".$selected.">".$sub_item['in_item_name']."</option>";
                                                		}
                                                		?>
                                            		</select>
                                       			</td>
												<td>
													<input type="number" name="qty[]" class="qty form-control" value="<?php echo $ord_item['ordered_qty']; ?>" required="required">
												</td>
												<td>
													<input type="number" name="price[]" class="price form-control" value="0" required="required">
												</td>
												<td>
													<input type="text" name="amount[]" class="amount form-control" readonly="" required="required">
												</td>
                                        		<td align="center">
                                            		<button type="button" class="add btn btn-info btn-sm">
                                                		<i class="fa fa-plus"></i>
                                            		</button>
                                            		<button type='button' class='remove btn btn-danger btn-sm'>
                                               			<i class='fa fa-minus'></i>
                                            		</button>
                                        		</td>
											</tr>
											<?php } } else { ?>
											<tr>
                								<td>
                    								<select class='category form-control' name='item_category[]' required="required">
                        								<option selected disabled value>--SELECT CATEGORY--</option>
                        								<?php for($i = 0; $i < count($category_json); $i++)
                        								{
                        								echo'<option value='.$category_json[$i]['es_in_categoryid'].'>'.$category_json[$i]['in_category_name'].'</option>';
                        								} ?>
                    								</select>
                								</td>
                								<td>
                    								<select class='items form-control' name='item_id[]' required="required">
                        								<option selected disabled>--SELECT ITEM--</option>
                    								</select>
                								</td>
												<td>
													<input type='number' name='qty[]' class='qty form-control' value='0' required="required">
												</td>
												<td>
													<input type='number' name='price[]' class='price form-control' value='0' required="required">
												</td>
												<td>
													<input type='text' name='amount[]' class='amount form-control' readonly required="required">
												</td>
                								<td align='center'>
                    								<button type='button' class='add btn btn-info btn-sm'>
                    									<i class='fa fa-plus'></i>
                    								</button>
                    								<button type='button' class='remove btn btn-danger btn-sm'>
                    									<i class='fa fa-minus'></i>
                    								</button>
                								</td>
            								</tr>
											<?php } ?>
											<tr>
												<td colspan="4" align="right"><b>Additional Amount (i.e. Tax, Vat, Charges)</b></td>
												<td><input type="number" name="additional_amount" class="form-control" id="additional_amount" value="0" required="required"></td>
												<td></td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="4" align="right"><b>Total</b></td>
												<td>
													<input type="text" name="total_amount" class="form-control" id="total" readonly="">
												</td>
												<td></td>
											</tr>
										</tfoot>
									</table>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<label><b>Remarks</b></label>
									<textarea class="form-control" name="remarks"></textarea>
								</div>


								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<button type="submit" class="btn btn-primary pull-right" name="make_grn" value="1">
										SUBMIT
									</button>
								</div>
							</form>
							</div>
						</div>
    				</div>
  				</div>
  			</section>
		</div>

    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
    	<script>
    	calculate();
        function calculate(){
            var totalamount = 0;
            var qty = 0;
            var price = 0;
            $(".amount").each(function() {
                price = $(this).closest('tr').find('.price').val();
                qty = $(this).closest('tr').find('.qty').val();
                amount = parseInt(price) * parseInt(qty);
                $(this).val(amount);
                totalamount += amount;
            });

            var additional_amount = parseInt($('#additional_amount').val());
            totalamount += additional_amount;
            $('#total').val(totalamount);
        }
        $(document).on('keyup', '.price', calculate);
        $(document).on('keyup', '#additional_amount', calculate);
        $(document).on('keyup', '.qty', calculate);
    	</script>
        <script>
            function addrow() {
            $("<tr>"+
                "<td>"+
                    "<select class='category form-control' name='item_category[]' required>"+
                        "<option selected disabled value>--SELECT CATEGORY--</option>"+
                        "<?php for($i = 0; $i < count($category_json); $i++){ echo'<option value='.$category_json[$i]['es_in_categoryid'].'>'.$category_json[$i]['in_category_name'].'</option>'; } ?>"+
                    "</select>"+
                "</td>"+
                "<td>"+
                    "<select class='items form-control' name='item_id[]' required>"+
                        "<option selected disabled>--SELECT ITEM--</option>"+
                    "</select>"+
                "</td>"+
				"<td>"+
					"<input type='number' name='qty[]' class='qty form-control' value='0' required>"+
				"</td>"+
				"<td>"+
					"<input type='number' name='price[]' class='price form-control' value='0' required>"+
				"</td>"+
				"<td>"+
					"<input type='text' name='amount[]' class='amount form-control' readonly>"+
				"</td>"+
                "<td align='center'>"+
                    "<button type='button' class='add btn btn-info btn-sm'><i class='fa fa-plus'></i></button> "+
                    "<button type='button' class='remove btn btn-danger btn-sm'><i class='fa fa-minus'></i></button>"+
                "</td>"+
            "</tr>").insertAfter($(this).closest('tr'));
            calculate();
    
            };

            $(document).on('click', '.add', addrow);

            function remove_row() {
            $(this).closest('tr').remove();
            calculate();
            }

            $(document).on('click', '.remove', remove_row);
        </script>
        <script>
            $(document).on('change', '.category', function(){
                var str = this;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $(str).closest('tr').find('.items').html(this.responseText);
                }
                };
            xmlhttp.open("GET","ajax.php?action=items&q="+$(str).val(),true);
            xmlhttp.send();
            });
        </script>
  	</body>
</html>