<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Class Tests</title>
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
                           <span class="title elipsis"><strong>Class Tests</strong></span>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>TestID</th>
                                            <th>Date</th>
                                            <th>Standard - DIV</th>
                                            <th>Subject</th>
                                            <th>Marks</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tests = mysql_query("SELECT `isd_class_tests`.*, `es_classes`.`es_classname`, `es_subject`.`es_subjectname`, `isd_class_division`.`division_name` FROM `isd_class_tests` INNER JOIN `es_classes` ON `es_classes`.es_classesid = `isd_class_tests`.`standard_id` INNER JOIN `es_subject` ON `es_subject`.es_subjectid = `isd_class_tests`.`subject_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `isd_class_tests`.`division_id`  WHERE `test_status` != 'DELETED' AND `teacherid` = ".$_SESSION['eschools']['user_id']);

                                        while ($test = mysql_fetch_assoc($tests)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $test['class_test_id']; ?></td>
                                            <td><?php echo $test['class_test_date']; ?></td>
                                            <td><?php echo $test['es_classname']; ?> - <?php echo $test['division_name']; ?></td>
                                            <td><?php echo $test['es_subjectname']; ?></td>
                                            <td><?php echo $test['total_marks']; ?></td>
                                            <td><?php echo $test['test_status']; ?></td>
                                            <td align="center">
                                                
                                                <?php if($test['test_status']=='PENDING') { ?>

                                                <a href="?pid=59&action=enter_marks&test_id=<?php echo $test['class_test_id']; ?>" class="btn btn-info btn-xs" data-toggle="tooltip" data-original-title="Enter Marks"> &nbsp;<i class="fa fa-inbox"></i> </a>

                                                <a href="?pid=59&action=edit_test&test_id=<?php echo $test['class_test_id']; ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-original-title="Edit Test"> &nbsp;<i class="fa fa-pencil-square-o"></i> </a>

                                                <?php } elseif($test['test_status']=='ACTIVE') { ?>

                                                <a href="?pid=59&action=edit_marks&test_id=<?php echo $test['class_test_id']; ?>" class="btn btn-info btn-xs" data-toggle="tooltip" data-original-title="Edit Marks"> &nbsp;<i class="fa fa-pencil-square-o"></i> </a>

                                                <a href="?pid=59&action=end_test&test_id=<?php echo $test['class_test_id']; ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-original-title="End Test"> &nbsp;<i class="fa fa-hourglass-end"></i> </a>

                                                <?php } elseif ($test['test_status']=='COMPLETED') { ?>
                                                    
                                                    <a href="?pid=59&action=view_marksheet&test_id=<?php echo $test['class_test_id']; ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-original-title="View Marksheet"> &nbsp;<i class="fa fa-table"></i> </a>

                                                <?php } ?>


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
    </body>
</html>