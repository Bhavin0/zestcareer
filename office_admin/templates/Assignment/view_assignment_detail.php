<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>View Assignment Detail</title>
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
                           <span class="title elipsis"><strong>View Assignment Detail</strong></span>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <?php
                                $assignment_qry = mysqli_query($mysqli_con, "SELECT `es_assignment`.*, `es_classes`.`es_classname`, `isd_class_division`.`division_name`, `es_subject`.`es_subjectname` FROM `es_assignment` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_assignment`.`as_class_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `es_assignment`.`as_division_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_assignment`.`as_subject_id` WHERE `es_assignment`.`status`='active' AND `es_assignment`.`es_assignmentid`=".$_GET['assignment_id']) or die(MYSQLI_ERROR($mysqli_con));
                                $assignment = mysqli_fetch_array($assignment_qry);

                                ?>
                                <h4> Detail </h4>
                                <table  class="table table-bordered">
                                    <tr>
                                        <th>Assignment ID : </th><td><?php echo $assignment['es_assignmentid']; ?></td>
                                        <th>Assignmen DT. : </th><td><?php echo YMDtoDMY($assignment['as_createdon']); ?></td>
                                        <th>Submission DT. : </th><td><?php echo YMDtoDMY($assignment['as_lastdate']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Class : </th><td><?php echo $assignment['es_classname']." - ".$assignment['division_name']; ?></td>
                                        <th>Subject : </th><td><?php echo $assignment['es_subjectname']; ?></td>
                                        <th>Created BY : </th>
                                        <td>
                                        <?php
                                        if($assignment['person_type'] == 'admin')
                                        {
                                            $created_by = get_single_row('es_admins', array('es_adminsid' => $assignment['created_by']));
                                            echo $created_by['admin_fname']." ".$created_by['admin_lname'];
                                        }
                                        else
                                        {
                                            $created_by = get_single_row('es_staff', array('es_staffid' => $assignment['created_by']));
                                            echo $created_by['st_firstname']." ".$created_by['st_lastname'];
                                        }
                                        ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="table-responsive">

                                <h4> Assignment </h4>
                                <table  class="table table-bordered">
                                    <tr>
                                        <th>TITLE : </th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $assignment['as_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>DESCRIPTON : </th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $assignment['as_description']; ?></td>
                                    </tr>
                                    <?php if($assignment['as_attachment'] != '') { ?>
                                    <tr>
                                        <th>DOWNLOAD ATTACHMENT : </th>
                                    </tr>
                                    <tr>
                                        <td><a href="<?php echo base_url('uploads/assignments/'.$assignment['es_assignmentid'].'.'.$assignment['as_attachment']); ?>" target="_blank">attachment.<?php echo $assignment['as_attachment']; ?></a></td>
                                    </tr>
                                    <?php } ?>
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