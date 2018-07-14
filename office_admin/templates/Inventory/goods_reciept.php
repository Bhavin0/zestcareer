<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Goods Receipt Note (GRN)</title>
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
					           <strong>Goods Receipt Note (GRN)</strong>
				            </div>
		 		            <div class="panel-body">
                            <?php
                                $rec_items = mysqli_query($mysqli_con, "SELECT es_in_goods_receipt_note_items.*, es_in_item_master.in_item_code, es_in_item_master.in_item_name FROM es_in_goods_receipt_note_items INNER JOIN es_in_item_master ON es_in_item_master.es_in_item_masterid = es_in_goods_receipt_note_items.item_id WHERE es_in_goods_receipt_note_items.grn_id = ".$_GET['grn_id']);

                                $rec = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_in_goods_receipt_note.*, es_in_supplier_master.in_name FROM es_in_goods_receipt_note INNER JOIN es_in_supplier_master ON es_in_supplier_master.es_in_supplier_masterid = es_in_goods_receipt_note.supplier_id WHERE es_in_goods_receipt_note.grn_id =".$_GET['grn_id']), MYSQLI_ASSOC);
                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                <b>GRN ID : </b><?php echo $rec['grn_id']; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                <b>Order ID : </b><?php echo $rec['es_order_id']; ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                <b>GRN Date : </b><?php echo date_format(date_create($rec['grn_date']),'d/m/Y'); ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                <b>Bill No. : </b><?php echo $rec['bill_no']; ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <b>Supplier : </b><?php echo $rec['in_name']; ?>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead> 
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Item Code</th>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $subtotal = 0;
                                    while($item = mysqli_fetch_assoc($rec_items))
                                    { ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $item['in_item_code']; ?></td>
                                            <td><?php echo $item['in_item_name']; ?></td>
                                            <td><?php echo $item['qty']; ?></td>
                                            <td><?php echo "Rs. ".$item['price']; ?></td>
                                            <td><?php echo "Rs. ".$item['amount']; ?></td>
                                        </tr>
                                    <?php
                                    $subtotal =+ $item['amount'];
                                     } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" align="right">
                                                <b>Subtotal</b>
                                            </td>
                                            <td colspan="2">
                                                <b>Rs. <?php echo $subtotal; ?></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right">
                                                <b>Additional Amount(i.e. Tax, Vat, Charges)</b>
                                            </td>
                                            <td colspan="2">
                                                <b>Rs. <?php echo $rec['additional_amount']; ?></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right">
                                                <b>Total Payble Amount</b>
                                            </td>
                                            <td colspan="2">
                                                <b>Rs. <?php echo $rec['total_amount']; ?></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right">
                                                <b>Paid Amount</b>
                                            </td>
                                            <td colspan="2">
                                                <b>Rs. <?php echo $rec['paid_amount']; ?></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right">
                                                <b>Balance</b>
                                            </td>
                                            <td colspan="2">
                                                <b>Rs. <?php echo $rec['total_amount'] - $rec['paid_amount']; ?></b>
                                            </td>
                                        </tr>
                                    </tfoot>    
                                </table>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <b>Remarks :</b>
                                <p style="text-align: justify;">
                                    <?php echo nl2br($rec['remarks']); ?>
                                </p>
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
        $('.makegrn').click(function(){
            str = this;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    $('#grn').html(this.responseText);
                }
            };
            xmlhttp.open("GET","?pid=7&action=ajax_grn&q="+$(str).val(),true);
            xmlhttp.send();
        });
        function hello(str)
        {
            $('.payment_mode').hide();
            if(str == 'BANK') { $('.bank_mode').show(); }
            if(str == 'CHEQUE') { $('.cheque_mode').show(); }
            if(str == 'DD') { $('.dd_mode').show(); }
        }
    </script>
    <script>
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

            var tax = parseInt($('#tax').val());
            totalamount += tax;
            $('#total').val(totalamount);
        }
        $(document).on('keyup', '.price', calculate);
        $(document).on('keyup', '#tax', calculate);
    </script>
  </body>
</html>