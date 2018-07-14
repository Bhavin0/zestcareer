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
					           <span class="elipsis title"><strong>Purchase Order</strong></span>
				            </div>

				            <div class="panel-body">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <a href="?pid=7&action=add_order" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus"></i> Add Order
                                    </a>
                                </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                            <?php
                            $orders = mysqli_query($mysqli_con, "SELECT es_in_orders.*, es_in_supplier_master.in_name FROM es_in_orders INNER JOIN es_in_supplier_master ON  es_in_orders.in_suplier_id=es_in_supplier_master.es_in_supplier_masterid ORDER BY es_in_ordersid DESC");
                            ?>
                                <table class="table table-bordered">
                                    <thead> 
                                        <tr>
                                            <th width="10%">Order ID</th>
                                            <th width="12%">Order Date</th>
                                            <th width="42%">Supplier Name</th>
                                            <th width="10%">Status</th>
                                            <th width="25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while($order = mysqli_fetch_assoc($orders))
                                    {
                                    ?>
                                    <tr class="<?php echo ($order['in_ord_status']=='Pending')?'warning':'success'; ?>">
                                        <td align="center"><?php echo $order['es_in_ordersid']; ?></td>
                                        <td><?php echo date_format(date_create($order['order_date']),'d/m/Y'); ?></td>
                                        <td><?php echo $order['in_name']; ?></td>
                                        <td><?php echo $order['in_ord_status']; ?></td>
                                        <td align="center">
                                            <a href="?pid=7&action=purchase_orders_detail&order_id=<?php echo $order['es_in_ordersid']; ?>" class="btn btn-primary btn-xs" title="View Order" style="background-color: #286090 !important; border-color: #204d74;">
                                                &nbsp;<i class="fa fa-eye"></i>
                                            </a>
                                            <a href="?pid=7&action=edit_order&order_id=<?php echo $order['es_in_ordersid']; ?>" class="btn btn-warning btn-xs" title="Edit Order">
                                                &nbsp;<i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            <a href="?pid=7&action=make_grn&order_id=<?php echo $order['es_in_ordersid']; ?>" class="btn btn-success btn-xs" title="Make Goods Receipt Note">
                                                &nbsp;<i class="fa fa-cart-plus"></i>
                                            </a>
                                            <a href="?pid=7&action=add_order&order_id=<?php echo $order['es_in_ordersid']; ?>" class="btn btn-info btn-xs" title="Copy Order">
                                                &nbsp;<i class="fa fa-clone"></i>
                                            </a>
                                            <a href="?pid=7&action=delete_order&order_id=<?php echo $order['es_in_ordersid']; ?>" class="btn btn-danger btn-xs" title="Delete Order" onclick="return confirm('Are you sure you want to delete this order?')">
                                                &nbsp;<i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
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