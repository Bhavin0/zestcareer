<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Add Purchase Order</title>
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
					           <span class="elipsis title"><strong>Add Purchase Order</strong></span>
				            </div>

				            <div class="panel-body">
                                <form name="inv_orders" action="" method="post" >

                                <?php
                                    if(isset($_GET['order_id'])) {
                                        $order = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_in_orders WHERE es_in_ordersid =".$_GET['order_id']), MYSQLI_ASSOC);
                                        $ord_items = mysqli_query($mysqli_con, "SELECT * FROM es_in_orders_items WHERE es_order_id=".$_GET['order_id']);
                                    }
                                ?>
                                    <div class="row">
                                        <h4>&nbsp;Order Details</h4>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                        <label><b>Order No</b></label>
                                        <span class="form-control"><?php echo $maxorderno[0] + 1; ?></span>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                        <label><b>Order Date</b></label>
                                        <input class="datepicker form-control" name="order_date" readonly value="<?php echo date('Y-m-d'); ?>">
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                        <label><b>Supplier</b></label>
                                        <select name="in_suplier_name" id="in_suplier_name" class="form-control">
                                            <option selected="" disabled="">--SELECT SUPPLIER--</option>
                                            <?php
                                            while($supplier = mysqli_fetch_assoc($suppliers)) {
                                                if(isset($_GET['order_id']) && $order['in_suplier_id']==$supplier['es_in_supplier_masterid'])
                                                { $selected = 'selected'; } else { $selected = ''; }
                                            ?>
                                            <option value="<?php echo $supplier['es_in_supplier_masterid']; ?>" <?php echo $selected; ?>>
                                            <?php echo $supplier['in_name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <h4>&nbsp;Purchase Order List</h4>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table class="table table-bordered">
                                            <thead> 
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Item Code (Item Name)</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($_GET['order_id']) && mysqli_num_rows($ord_items)>0)
                                                {
                                                while($ord_item = mysqli_fetch_assoc($ord_items))
                                                { ?>
                                                <tr>
                                                    <td width="30%">
                                                        <select class="category form-control" name="item_category[]">
                                                            <option selected="" disabled="">--SELECT CATEGORY--</option>
                                                            <?php
                                                            for($i = 0; $i < count($category_json); $i++)
                                                            {
                                                                $selected = ($ord_item['item_category']==$category_json[$i]['es_in_categoryid'])?'selected':'';
                                                                echo"<option value='".$category_json[$i]['es_in_categoryid']."' ".$selected.">".$category_json[$i]['in_category_name']."</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td width="35%">
                                                        <?php $sub_items = mysqli_query($mysqli_con, "SELECT * FROM es_in_item_master WHERE in_category_id =".$ord_item['item_category']); ?>
                                                        <select class="items form-control" name="item_id[]">
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
                                                    <td width="20%">
                                                        <input type="number" name="item_qty[]" class="form-control" value="<?php echo $ord_item['ordered_qty']; ?>">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="add btn btn-info btn-sm">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </td>
                                                </tr>      
                                            <?php }
                                                }
                                                else
                                                { ?>
                                                <tr>
                                                    <td width="30%">
                                                        <select class="category form-control" name="item_category[]">
                                                            <option selected="" disabled="">--SELECT CATEGORY--</option>
                                                            <?php
                                                            for($i = 0; $i < count($category_json); $i++)
                                                            {
                                                                echo"<option value='".$category_json[$i]['es_in_categoryid']."'>".$category_json[$i]['in_category_name']."</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td width="35%">
                                                        <select class="items form-control" name="item_id[]">
                                                            <option selected="" disabled="">--SELECT ITEM--</option>
                                                        </select>
                                                    </td>
                                                    <td width="20%">
                                                        <input type="number" name="item_qty[]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="add btn btn-info btn-sm">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>    
                                        </table>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                        <button name="purchaseorder" type="submit" class="btn btn-primary pull-right" value="1">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
        <script>
            function addrow() {
            $("<tr>"+
                "<td>"+
                    "<select class='category form-control' name='item_category[]'>"+
                        "<option selected disabled value>--SELECT CATEGORY--</option>"+
                        "<?php for($i = 0; $i < count($category_json); $i++){ echo'<option value='.$category_json[$i]['es_in_categoryid'].'>'.$category_json[$i]['in_category_name'].'</option>'; } ?>"+
                    "</select>"+
                "</td>"+
                "<td>"+
                    "<select class='items form-control' name='item_id[]'>"+
                        "<option selected disabled>--SELECT ITEM--</option>"+
                    "</select>"+
                "</td>"+
                "<td>"+
                    "<input type='number' name='item_qty[]' class='form-control'>"+
                "</td>"+
                "<td>"+
                    "<button type='button' class='add btn btn-info btn-sm'><i class='fa fa-plus'></i></button>"+
                    "<button type='button' class='remove btn btn-danger btn-sm'><i class='fa fa-minus'></i></button>"+
                "</td>"+
            "</tr>").insertAfter($(this).closest('tr'));
    
            };

            $(document).on('click', '.add', addrow);

            function remove_row() {
            $(this).closest('tr').remove();
            }

            $(document).on('click', '.remove', remove_row);

            $(document).ready(function() {
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
        });
        </script>
    </body>
</html>