<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Supplier Payment Detail</title>
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
                                <span class="title elipsis"><strong>Supplier Payment Detail</strong></span>
                            </div>

                            <div class="panel-body">
                            <?php
                                $payment = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT supplier_payments.*, es_in_supplier_master.in_name FROM supplier_payments INNER JOIN es_in_supplier_master ON es_in_supplier_master.es_in_supplier_masterid = supplier_payments.supplier_id WHERE supplier_payments.supplier_payment_id = ".$_GET['payment_id']), MYSQLI_ASSOC);

                                $grns = mysqli_query($mysqli_con, "SELECT supplier_payment_child.*, es_in_goods_receipt_note.bill_no , es_in_goods_receipt_note.grn_date FROM supplier_payment_child INNER JOIN es_in_goods_receipt_note ON es_in_goods_receipt_note.grn_id = supplier_payment_child.grn_id WHERE supplier_payment_child.supplier_payment_id =".$_GET['payment_id']);
                            ?>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Payment Date : </b></label> <?php echo date_format(date_create($payment['payment_date']), 'd/m/Y'); ?>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Paid to : </b></label> <?php echo $payment['in_name']; ?>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead> 
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>GRN ID</th>
                                            <th>Bill No.</th>
                                            <th>GRN Date</th>
                                            <th>Paid Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    while($grn = mysqli_fetch_assoc($grns))
                                    { ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $grn['grn_id']; ?></td>
                                            <td><?php echo $grn['bill_no']; ?></td>
                                            <td><?php echo date_format(date_create($grn['grn_date']), 'd/m/Y'); ?></td>
                                            <td><?php echo $grn['paid_amount']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">Total</th>
                                            <th><?php echo $payment['paid_amount']; ?></th>
                                        </tr>
                                    </tfoot>    
                                </table>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <b>Payment Mode : </b><?php echo $payment['payment_mode']; ?>
                            </div>

                            <?php if($payment['payment_mode']=='Cheque') { ?>
                            <div class="payment cheque col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                <b>Cheque No. : </b><?php echo $payment['cheque_no']; ?>
                            </div>

                            <div class="payment cheque col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                <b>Cheque Date : </b><?php echo $payment['cheque_date']; ?>
                            </div>

                            <div class="payment cheque col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                <b>A/C Payee Name : </b><?php echo $payment['ac_payee_name']; ?>
                            </div>
                            <?php } ?>

                            <?php if($payment['payment_mode']=='Cheque' || $payment['payment_mode']=='Online Payment') { ?>
                            <div class="payment cheque online col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                <b>School Bank Name : </b><?php echo $payment['bank_name']; ?>
                            </div>

                            <div class="payment cheque online col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                <b>School Bank Account No. : </b><?php echo $payment['bank_account_no']; ?>
                            </div>
                            <?php } ?>

                            <?php if($payment['payment_mode']=='Online Payment') { ?>
                            <div class="payment online col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">   
                                <b>Type : </b><?php echo $payment['online_type']; ?>
                            </div>

                            <div class="payment online col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">   
                                <b>Transection ID : </b><?php echo $payment['transection_id']; ?>
                            </div>

                            <div class="payment online col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                <b>Beneficiary Code : </b><?php echo $payment['beneficiary_code']; ?>
                            </div>
                            <?php } ?>

                            <?php if($payment['payment_mode']=='Bank Deposit' || $payment['payment_mode']=='DD Payment') { ?>
                            <div class="payment bank dd col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">  
                                <b>Supplier Bank Name : </b><?php echo $payment['supplier_bank']; ?>
                            </div>

                            <div class="payment bank dd col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">  
                                <b>Supplier Account No. : </b><?php echo $payment['suppllier_account_no']; ?>
                            </div>

                             <div class="payment bank dd col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">  
                                <b>Supplier Account Name : </b><?php echo $payment['supplier_account_name']; ?>
                            </div>
                            <?php } ?>

                            <?php if($payment['payment_mode']=='Bank Deposit') { ?>
                            <div class="payment bank col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group"> 
                                <b>Deposite Slip No. : </b><?php echo $payment['deposit_slip_no']; ?>
                            </div>
                            <?php } ?>

                            <?php if($payment['payment_mode']=='DD Payment') { ?>
                            <div class="payment dd col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">   
                                <b>DD No. : </b><?php echo $payment['dd_no']; ?>
                            </div>
                            <?php } ?>

                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <b>Remarks : </b><br>
                                <p style="text-align: justify;">
                                <?php echo nl2br($payment['remarks']); ?>
                                </p>
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
  </body>
</html>