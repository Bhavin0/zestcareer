<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Supplier Payments</title>
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
                                <strong>Supplier Payments</strong>
                            </div>
				            <?php
					            $payments = mysqli_query($mysqli_con, "SELECT supplier_payments.*, es_in_supplier_master.in_name FROM supplier_payments INNER JOIN es_in_supplier_master ON es_in_supplier_master.es_in_supplier_masterid = supplier_payments.supplier_id ORDER BY supplier_payment_id DESC");
		 		            ?>
		 		            <div class="panel-body">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <a href="?pid=7&action=supplier_payment" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus"></i> Pay
                                    </a>
                                </div>

		 			            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
						            <table class="table table-bordered table-striped">
						                <thead>
							                <tr>
								                <th>Payment ID</th>
								                <th>Payment Date</th>
								                <th>Supplier Name</th>
                                                <th>Amount</th>
								                <th>Action</th>
							                </tr>
						                </thead>
						                <tbody>
						                <?php while ($row = mysqli_fetch_assoc($payments)) { ?>
							                <tr>
								                <td align="center"><?php echo $row['supplier_payment_id']; ?></td>
								                <td><?php echo date_format(date_create($row['payment_date']), 'd/m/Y'); ?></td>
								                <td><?php echo $row['in_name']; ?></td>
                                                <td><?php echo $row['paid_amount']; ?></td>
								                <td align="center">
                                                    <a href="?pid=7&action=supplier_payment_detail&payment_id=<?php echo $row['supplier_payment_id']; ?>" title="Reject" class="btn btn-info btn-xs">
                                                        &nbsp;<i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="?pid=7&action=edit_payment&payment_id=<?php echo $row['supplier_payment_id']; ?>" title="Edit" class="btn btn-warning btn-xs">
                                                        &nbsp;<i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                    <a href="?pid=7&action=delete_payment&payment_id=<?php echo $row['supplier_payment_id']; ?>" title="Delete" class="btn btn-danger btn-xs">
                                                        &nbsp;<i class="fa fa-trash-o" onclick="return confirm('Are you sure you want to delete this?')"></i>
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
                </div>
            </section>
        </div>

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