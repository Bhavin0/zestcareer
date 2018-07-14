<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Quotations</title>
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
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
                <?php
                    include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
                    include(TEMPLATES_PATH . DS . 'header.tpl.php');
                ?>
    	       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			        <div class="panel panel-primary">
				        <div class="panel-heading">
					       <span class="elipsis title"><strong>Quotation Requests</strong></span>
				        </div>

				        <div class="panel-body">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <a href="?pid=7&action=quotation_request" class="btn btn-primary pull-right">
                                    <i class="fa fa-plus"></i> Request a Quote
                                </a>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                            <?php
                                $orders = mysqli_query($mysqli_con, "SELECT es_in_quotation_requests.*, es_in_supplier_master.in_name FROM es_in_quotation_requests INNER JOIN es_in_supplier_master ON  es_in_quotation_requests.supplier_id=es_in_supplier_master.es_in_supplier_masterid ORDER BY rfq_id DESC");
                                ?>
                                <table class="table table-bordered">
                                    <thead> 
                                        <tr>
                                            <th>RFQ ID</th>
                                            <th>Date</th>
                                            <th>Supplier Name</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while($order = mysqli_fetch_assoc($orders))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $order['rfq_id']; ?></td>
                                            <td><?php echo date_format(date_create($order['quotation_date']),'d/m/Y'); ?></td>
                                            <td><?php echo $order['in_name']; ?></td>
                                            <td><?php echo $order['quotation_subject']; ?></td>
                                            <td align="center">
                                                <a href="?pid=7&action=quotation_request&quotation_id=<?php echo $order['rfq_id']; ?>" class="btn btn-warning btn-xs" title="Resend">
                                                &nbsp;<i class="fa fa-paper-plane"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
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