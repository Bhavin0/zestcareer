<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Teacher Performance</title>
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
                           <span class="title elipsis"><strong>Teacher Performance</strong></span>
                        </div>
                            <div class="panel-body">
                              <form action="?pid=138&action=performance" method="post">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                    <label><b>Teacher</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" required="required" name="teacher_id">
                                        <option selected="" disabled=""> --SELECT TEACHER--</option>
                                        <?php
                                       $teachers = mysqli_query($mysqli_con, "SELECT * FROM `es_staff` ORDER BY st_firstname,st_lastname");
                                        while($teacher = mysqli_fetch_assoc($teachers))
                                        {
                                        echo "<option value='".$teacher['es_staffid']."'>";
                                        echo strtoupper($teacher['st_firstname']." ".$teacher['st_lastname']);
                                        echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label><b>From Date</b></label>
                                    <input type="text" name="from_date" value="<?php echo date('Y-m-d', strtotime('-1 month', time())); ?>" class="form-control datepicker" readonly>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label><b>To Date</b></label>
                                    <input type="text" name="to_date" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker" readonly>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="submit" name="view_report" class="btn btn-primary pull-right" value="View Report">
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
    </body>
</html>