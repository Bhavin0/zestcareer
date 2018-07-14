<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Enter Marks</title>
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
                           <span class="title elipsis"><strong>Enter Marks</strong></span>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <?php
                                $test = mysql_query("SELECT `isd_class_tests`.*, `es_classes`.`es_classname`, `es_subject`.`es_subjectname`, `isd_class_division`.`division_name` FROM `isd_class_tests` INNER JOIN `es_classes` ON `es_classes`.es_classesid = `isd_class_tests`.`standard_id` INNER JOIN `es_subject` ON `es_subject`.es_subjectid = `isd_class_tests`.`subject_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `isd_class_tests`.`division_id`  WHERE class_test_id = ".$_GET['test_id']);
                                $test_detail = mysql_fetch_array($test);
                                ?>
                                <table  class="table table-bordered">
                                    <tr>
                                        <th>TestID : </th><td><?php echo $test_detail['class_test_id']; ?></td>
                                        <th>Date : </th><td><?php echo $test_detail['class_test_date']; ?></td>
                                        <th>Total Marks : </th><td><?php echo $test_detail['total_marks']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Standard : </th><td><?php echo $test_detail['es_classname']; ?></td>
                                        <th>Division : </th><td><?php echo $test_detail['division_name']; ?></td>
                                        <th>Subject : </th><td><?php echo $test_detail['es_subjectname']; ?></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="table-responsive">

                                <form action="" method="post"> 

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Roll No.</th>
                                            <th>Student Name</th>
                                            <th>Scored Marks</th>
                                            <th>Exclude Student</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $students = mysql_query("SELECT `es_preadmission_details`.*, CONCAT(`es_preadmission`.`pre_name`, ' ' ,`es_preadmission`.`middle_name`, ' ' ,`es_preadmission`.`pre_lastname`) AS `student_name` FROM `es_preadmission_details` INNER JOIN `es_preadmission` ON `es_preadmission`.`es_preadmissionid` = `es_preadmission_details`.`es_preadmissionid` WHERE academic_year_id = ".$test_detail['academic_year_id']." AND pre_class = ".$test_detail['standard_id']." AND division_id = ".$test_detail['division_id']." AND `es_preadmission_details`.`status` != 'transferred' AND `es_preadmission`.`pre_status`='active'  ORDER BY `es_preadmission_details`.`scat_id`, `student_name`");
                                        while ($student = mysql_fetch_assoc($students)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $student['scat_id']; ?>
                                                <input type="hidden" name="student_id[]" value="<?php echo $student['es_preadmissionid']; ?>">
                                            </td>
                                            <td><?php echo $student['student_name']; ?></td>
                                            <td><input type="number" name="scored_marks[<?php echo $student['es_preadmissionid']; ?>]" class="form-control" style="width:100px;" min="0" max="<?php echo $test_detail['total_marks']; ?>"></td>
                                            <td><input type="checkbox" name="exclude[<?php echo $student['es_preadmissionid']; ?>]"></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"><input type="submit" name="enter_marks" value="Enter Marks" class="btn btn-primary pull-right"></td>
                                        </tr>
                                    </tfoot>
                                </table>

                                </form>
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