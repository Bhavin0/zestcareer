<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Class Test Marksheet</title>
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
                           <span class="title elipsis"><strong>Class Test Marksheet</strong></span>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <?php
                                $test = mysql_query("SELECT `isd_class_tests`.*, `es_classes`.`es_classname`, `es_subject`.`es_subjectname` FROM `isd_class_tests` INNER JOIN `es_classes` ON `es_classes`.es_classesid = `isd_class_tests`.`standard_id` INNER JOIN `es_subject` ON `es_subject`.es_subjectid = `isd_class_tests`.`subject_id`  WHERE class_test_id = ".$_GET['test_id']);
                                $test_detail = mysql_fetch_array($test);
                                ?>
                                <h4> TEST DETAIL </h4>
                                <table  class="table table-bordered">
                                    <tr>
                                        <th>TestID : </th><td><?php echo $test_detail['class_test_id']; ?></td>
                                        <th>Date : </th><td><?php echo $test_detail['class_test_date']; ?></td>
                                        <th>Total Marks : </th><td><?php echo $test_detail['total_marks']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Standard : </th><td colspan="2"><?php echo $test_detail['es_classname']; ?></td>
                                        <th>Subject : </th><td colspan="2"><?php echo $test_detail['es_subjectname']; ?></td>
                                    </tr>
                                </table>

                                <h4> GRADES DETAIL </h4>
                                <?php
                                    $seventy_percent_mark = ($test_detail['total_marks'] * 70) / 100;


                                    $absent_student = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM isd_class_test_marks WHERE scored_marks IS NULL AND class_test_id = ".$_GET['test_id']));
                                    $total_student = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM isd_class_test_marks WHERE class_test_id = ".$_GET['test_id']));
                                    $avg_all = mysql_fetch_array(mysql_query("SELECT AVG(scored_marks) FROM isd_class_test_marks WHERE class_test_id = ".$_GET['test_id']));

                                    $above_70 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM isd_class_test_marks WHERE scored_marks > ".$seventy_percent_mark." AND class_test_id = ".$_GET['test_id']));



                                ?>
                                <table  class="table table-bordered">
                                    <tr>
                                        <th>ABSENT STUDENTS : </th><td><?php echo $absent_student[0]; ?></td>
                                        <th>TOTAL STUDENTS : </th><td><?php echo $total_student[0]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>AVERAGE MARKS OF ALL STUDENTS : </th><td colspan="3"><?php echo ROUND($avg_all[0]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>NUMBER OF STUDENT SCORED ABOVE 70% : </th><td colspan="3"><?php echo $above_70[0]; ?></td>
                                    </tr>
                                    <tr>
                                        <th>UMBER OF STUDENT SCORED BELOW 70% : </th><td colspan="3"><?php echo $total_student[0] - $above_70[0]; ?></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="table-responsive">

                                <h4> MARKSHEET </h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Roll No.</th>
                                            <th>Student Name</th>
                                            <th>Scored Marks</th>
                                            <th>Percentage</th>
                                            <th>Rank</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $students = mysql_query("SELECT `isd_class_test_marks`.*, CONCAT(`es_preadmission`.`pre_name`, ' ' ,`es_preadmission`.`middle_name`, ' ' ,`es_preadmission`.`pre_lastname`) AS `student_name`, `es_preadmission_details`.`scat_id` FROM `isd_class_test_marks` INNER JOIN `es_preadmission` ON `es_preadmission`.`es_preadmissionid` = `isd_class_test_marks`.`student_id` INNER JOIN `es_preadmission_details` ON `es_preadmission_details`. `es_preadmissionid` = `isd_class_test_marks`.`student_id` WHERE `isd_class_test_marks`.`class_test_id` = ".$_GET['test_id']." AND `es_preadmission_details`.`academic_year_id` = ".$test_detail['academic_year_id']." AND `es_preadmission_details`.`pre_class` = ".$test_detail['standard_id']." ORDER BY `isd_class_test_marks`.`scored_marks` DESC");

                                        $prev_mark = null;
                                        $i = 1;
                                        while ($student = mysql_fetch_assoc($students)) {
                                        if($prev_mark != null && $prev_mark!=$student['scored_marks'])
                                        {
                                            $i++;
                                        }
                                        $prev_mark = $student['scored_marks'];
                                        ?>
                                        <tr>
                                            <td><?php echo $student['scat_id']; ?>
                                            </td>
                                            <td><?php echo $student['student_name']; ?></td>
                                            <td><?php echo ($student['scored_marks']==null)?'AB':$student['scored_marks']; ?></td>
                                            <td><?php echo ($student['scored_marks']*100)/$test_detail['total_marks']; ?> %</td>
                                            <td><?php echo $i; ?></td>
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