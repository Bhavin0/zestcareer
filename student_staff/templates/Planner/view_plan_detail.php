<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>VIEW PLAN DETAIL</title>
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
                           <span class="title elipsis"><strong>VIEW PLAN DETAIL</strong></span>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <?php
                                $plan = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT `teacher_planner`.*, `es_finance_master`.`fi_ac_startdate`, `es_finance_master`.`fi_ac_enddate`, `es_staff`.`st_firstname`, `es_staff`.`st_lastname`, `es_classes`.`es_classname`, `isd_class_division`.`division_name`, `es_subject`.`es_subjectname` FROM `teacher_planner` INNER JOIN `es_finance_master` ON `es_finance_master`.`es_finance_masterid` = `teacher_planner`.`academic_year_id` INNER JOIN `es_staff` ON `es_staff`.`es_staffid` = `teacher_planner`.`teacher_id` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `teacher_planner`.`class_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `teacher_planner`.`division_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `teacher_planner`.`subject_id` WHERE teacher_plannerid=".$_GET['plan_id']), MYSQLI_ASSOC) or die(MYSQLI_ERROR($mysqli_con));

                                $tasks = mysqli_query($mysqli_con, "SELECT * FROM `teacher_planner_descriptions` WHERE teacher_planner_id=".$_GET['plan_id']);

                                ?>
                                <h4> DETAIL : </h4>
                                <table  class="table table-bordered">
                                    <tr>
                                        <th>ACADEMIC YEAR : </th>
                                        <td><?php echo YMDtoDMY($plan['fi_ac_startdate'])." - ".YMDtoDMY($plan['fi_ac_enddate']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>TEACHER : </th>
                                        <td><?php echo $plan['st_firstname']." ".$plan['st_lastname']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>CLASS : </th>
                                        <td><?php echo $plan['es_classname']." - ".$plan['division_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>SUBJECT : </th>
                                        <td><?php echo $plan['es_subjectname']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>REMARKS : </th>
                                        <td><?php echo nl2br($plan['planner_remarks']); ?></td>
                                    </tr>
                                   
                                </table>
                            </div>

                            <div class="table-responsive">

                                <h4> TASKS :  </h4>
                                <table  class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="10%">FROM DATE</th>
                                            <th width="10%">TO DATE</th>
                                            <th>TASKS : </th>
                                            <th width="10%">STATUS</th>
                                            <th width="15%">COMPLETION DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($task = mysqli_fetch_assoc($tasks)) { ?>
                                        <tr>
                                            <td><?php echo YMDtoDMY($task['from_date']); ?></td>
                                            <td><?php echo YMDtoDMY($task['to_date']); ?></td>
                                            <td><?php echo $task['plan_description']; ?></td>
                                            <td>
                                                <label class="switch switch-success">
                                                    <input type="checkbox" <?php echo ($task['task_status']=='completed')?'checked':''; ?> class="task_switch" value="<?php echo $task['teacher_planner_descriptionid']; ?>">
                                                    <span class="switch-label" data-on="COMPLETED" data-off="PENDING" style="width:100px;"></span>
                                                </label>
                                            </td>
                                            <td class="completion_date"><?php echo YMDtoDMY($task['task_completion_date']); ?></td>
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
        <script type="text/javascript">
            $(document).on('change', 'input.task_switch', function(){
                var tr = $(this).closest('tr');
                if($(this).is(':checked'))
                {
                    var url = "?pid=63&action=change_status&status=completed&task_id="+$(this).val();
                    $.get(url, function(data){
                        tr.find('.completion_date').html('<?php echo date('d/m/Y'); ?>');
                    });
                }
                else
                {
                    var url = "?pid=63&action=change_status&status=pending&task_id="+$(this).val();
                    $.get(url, function(data){
                        tr.find('.completion_date').html('');
                    });
                }
            });
        </script>
    </body>
</html>