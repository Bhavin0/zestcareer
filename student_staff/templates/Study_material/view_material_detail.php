<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>View Material Detail</title>
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
                           <span class="title elipsis"><strong>View Material Detail</strong></span>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <?php
                                $material_qry = mysqli_query($mysqli_con, "SELECT `es_studymaterial`.*, `es_classes`.`es_classname`, `es_subject`.`es_subjectname` FROM `es_studymaterial` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_studymaterial`.`sm_class_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_studymaterial`.`sm_subject_id` WHERE `es_studymaterial`.`status`='active' AND `es_studymaterial`.`es_studymaterialid`=".$_GET['studymaterialid']) or die(MYSQLI_ERROR($mysqli_con));
                                $material = mysqli_fetch_array($material_qry);

                                ?>
                                <h4> Detail </h4>
                                <table  class="table table-bordered">
                                    <tr>
                                        <th>Material ID : </th><td><?php echo $material['es_studymaterialid']; ?></td>
                                        <th>Material DT. : </th><td><?php echo YMDtoDMY($material['sm_createdon']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Class : </th><td><?php echo $material['es_classname'];?></td>
                                        <th>Subject : </th><td><?php echo $material['es_subjectname']; ?></td>
                                        <th>Created BY : </th>
                                        <td>
                                        <?php
                                        if($material['person_type'] == 'admin')
                                        {
                                            $created_by = get_single_row('es_admins', array('es_adminsid' => $material['created_by']));
                                            echo $created_by['admin_fname']." ".$created_by['admin_lname'];
                                        }
                                        else
                                        {
                                            $created_by = get_single_row('es_staff', array('es_staffid' => $material['created_by']));
                                            echo $created_by['st_firstname']." ".$created_by['st_lastname'];
                                        }
                                        ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="table-responsive">

                                <h4> Material </h4>
                                <table  class="table table-bordered">
                                    <tr>
                                        <th>TITLE : </th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $material['sm_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>DESCRIPTON : </th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $material['sm_description']; ?></td>
                                    </tr>
                                    <?php if($material['sm_attachment'] != '') { ?>
                                    <tr>
                                        <th>DOWNLOAD ATTACHMENT : </th>
                                    </tr>
                                    <tr>
                                        <td><a href="<?php echo base_url('uploads/study_materials/'.$material['es_studymaterialid'].'.'.$material['sm_attachment']); ?>" target="_blank">attachment.<?php echo $material['sm_attachment']; ?></a></td>
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