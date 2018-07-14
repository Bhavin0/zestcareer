<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>STUDENT VIOLATION INCEDENTS</title>
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
                           <span class="title elipsis"><strong>STUDENT VIOLATION INCEDENTS</strong></span>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Standard</th>
                                            <th>Student</th>
                                            <th>Violation</th>
                                            <th>LEVEL</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $reports = mysql_query("SELECT `student_violation`.*, `es_classes`.`es_classname`, `es_preadmission`.`pre_name`,`es_preadmission`.`middle_name`,`es_preadmission`.`pre_lastname`, `isd_class_division`.`division_name` FROM `student_violation` INNER JOIN `es_classes` ON `es_classes`.es_classesid = `student_violation`.`es_classesid` INNER JOIN `es_preadmission` ON `es_preadmission`.es_preadmissionid = `student_violation`.`es_preadmissionid` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `student_violation`.`division_id`  WHERE `violation_submitted_by` = ".$_SESSION['eschools']['user_id']);

                                        while ($report = mysql_fetch_assoc($reports)) {
                                        ?>
                                        <tr>
                                            <td>#<?php echo $report['student_violationid']; ?></td>
                                            <td><?php echo displaydate($report['violation_date']); ?></td>
                                            <td><?php echo $report['es_classname']; ?> - <?php echo $report['division_name']; ?></td>
                                            <td><?php echo $report['pre_name']." ".$report['middle_name']." ".$report['pre_lastname']; ?></td>
                                            <td><?php echo $report['violation_type']; ?></td>
                                            <td><?php echo $report['violation_level']; ?></td>
                                            <td><?php echo $report['violation_status']; ?></td>
                                            <td align="center">

                                            	<a href="?pid=62&action=view_incedent&student_violationid=<?php echo $report['student_violationid']; ?>" class="btn btn-info btn-xs" data-toggle="tooltip" data-original-title="View Incedent"> &nbsp;<i class="fa fa-eye"></i> </a>
                                                
                                                <?php if($report['violation_status']=='PENDING') { ?>

                                                <a href="?pid=62&action=edit_incedent&student_violationid=<?php echo $report['student_violationid']; ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-original-title="Edit Incedent"> &nbsp;<i class="fa fa-pencil-square-o"></i> </a>

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