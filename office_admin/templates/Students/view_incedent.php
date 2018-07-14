<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>VIEW STUDENT VIOLATION INCEDENT</title>
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
                           <span class="title elipsis"><strong>VIEW STUDENT VIOLATION INCEDENT</strong></span>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <?php
                               $report = mysqli_query($mysqli_con, "SELECT `student_violation`.*, `es_classes`.`es_classname`, `es_preadmission`.`pre_name`,`es_preadmission`.`middle_name`,`es_preadmission`.`pre_lastname`, `isd_class_division`.`division_name`, es_staff.st_firstname, es_staff.st_lastname FROM `student_violation` INNER JOIN `es_classes` ON `es_classes`.es_classesid = `student_violation`.`es_classesid` INNER JOIN `es_preadmission` ON `es_preadmission`.es_preadmissionid = `student_violation`.`es_preadmissionid` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `student_violation`.`division_id` LEFT JOIN es_staff ON es_staff.es_staffid = `student_violation`.violation_submitted_by  WHERE `student_violationid` = ".$_GET['student_violationid']);
                                $report_detail = mysqli_fetch_array($report);
                                ?>
                                <table  class="table table-bordered">
                                    <tr>
                                        <th>Date : </th><td><?php echo displaydate($report_detail['violation_date']); ?></td>
                                        <th>Class : </th><td><?php echo $report_detail['es_classname']; ?> - <?php echo $report_detail['division_name']; ?></td>
                                        <th>Time: </th><td><?php echo $report_detail['violation_time']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>STUDENT : </th><td colspan="5"><?php echo $report_detail['pre_name']." ".$report_detail['middle_name']." ".$report_detail['pre_lastname']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>TYPE : </th><td colspan="2"><?php echo $report_detail['violation_type']; ?></td>
                                        <th>LEVEL : </th><td colspan="2"><?php echo $report_detail['violation_level']; ?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="6">REMARKS : </th>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><?php echo nl2br($report_detail['violation_remarks']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>ATTACHMENT : </th><td colspan="5">
                                        <?php if($report_detail['violation_file']=='')
                                        {
                                            echo"NO ATTACHMENT";
                                        }
                                        else
                                        {
                                            echo'<a href="'.base_url('uploads/student_violations/'.$_GET['student_violationid'].'.'.$report_detail['violation_file']).'" target="_blank">';
                                            echo $_GET['student_violationid'].".".$report_detail['violation_file'];
                                            echo"</a>";
                                        }
                                        ?>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>SUBMITTED BY : </th><td colspan="5"><?php echo $report_detail['st_firstname']." ".$report_detail['st_lastname']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <?php if($report_detail['violation_status'] == 'PENDING') { ?>
                            <div class="col-md-12">
                                <a href="?pid=21&action=approve_incedent&student_violationid=<?php echo $_GET['student_violationid']; ?>" class="btn btn-success pull-right">APPROVE</a>
                            </div>
                            <?php } ?>

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