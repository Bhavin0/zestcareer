<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Goods Issue Note</title>
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
                                <span class="title elipsis"><strong>Goods Issue Note</strong></span>
                            </div>

                            <div class="panel-body">
                            <?php
                                $items = mysqli_query($mysqli_con, "SELECT es_in_goods_issue_items.*, es_in_item_master.in_item_code, es_in_item_master.in_item_name, es_in_category.in_category_name FROM es_in_goods_issue_items INNER JOIN es_in_item_master ON es_in_item_master.es_in_item_masterid = es_in_goods_issue_items.item_id INNER JOIN es_in_category ON es_in_category.es_in_categoryid = es_in_goods_issue_items.item_category WHERE es_in_goods_issue_items.es_in_goods_issue_id = ".$_GET['gin_id']);

                                $req = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_in_goods_issue WHERE es_in_goods_issueid =".$_GET['gin_id']), MYSQLI_ASSOC);
                            ?>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Date : </b></label> <?php echo date_format(date_create($req['in_issue_date']), 'd/m/Y'); ?>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                <label><b>Issued to : </b></label> <?php echo $req['in_issue_to']; ?>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead> 
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Category</th>
                                            <th>Item Code</th>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    while($item = mysqli_fetch_assoc($items))
                                    { ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $item['in_category_name']; ?></td>
                                            <td><?php echo $item['in_item_code']; ?></td>
                                            <td><?php echo $item['in_item_name']; ?></td>
                                            <td><?php echo $item['qty']; ?></td>
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
  </body>
</html>