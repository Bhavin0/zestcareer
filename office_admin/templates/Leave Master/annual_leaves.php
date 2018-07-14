<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>ANNUAL LEAVES</title>
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/third_party/DataTables/datatables.min.css'); ?>">
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
                           <span class="title elipsis"><strong>ANNUAL LEAVES</strong></span>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>SR.NO.</th>
                                            <th>ACADEMIC YEAR</th>
                                            <th>DEPARTMENT</th>
                                            <th>LEAVE NAME</th>
                                            <th>ALLOWED LEAVE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $leaves = mysqli_query($mysqli_con, "SELECT `es_leavemaster`.*, `es_finance_master`.`fi_ac_startdate`, `es_finance_master`.`fi_ac_enddate`, `es_departments`.`es_deptname` FROM `es_leavemaster` INNER JOIN `es_finance_master` ON `es_finance_master`.es_finance_masterid = `es_leavemaster`.`academic_year_id` INNER JOIN `es_departments` ON `es_departments`.es_departmentsid = `es_leavemaster`.`leave_department`") or die(mysqli_error($mysqli_con));
                                        $i = 1;
                                        while ($leave = mysqli_fetch_assoc($leaves)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo displaydate($leave['fi_ac_startdate'])." - ".displaydate($leave['fi_ac_enddate']); ?></td>
                                            <td><?php echo $leave['es_deptname']; ?></td>
                                            <td><?php echo $leave['leave_name']; ?></td>
                                            <td><?php echo $leave['allowed_leave']; ?></td>
                                            <td></td>
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
        <script type="text/javascript" src="<?php echo base_url('assets/third_party/DataTables/datatables.min.js'); ?>"></script>
    </body>
</html>