<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Defaulter Students</title>
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
                           <span class="title elipsis"><strong>Defaulter Students</strong></span>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>STUDENT ID.</th>
                                            <th>STUDENT NAME</th>
                                            <th>MOBILE NO.</th>
                                            <th>SMS NO.</th>
                                            <th>GR NO.</th>
                                            <th>ADDRESS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $defaulters = mysqli_query($mysqli_con, "SELECT * FROM `es_preadmission` WHERE pre_status='defaulter'");

                                        while ($defaulter = mysqli_fetch_assoc($defaulters)) {
                                        ?>
                                        <tr>
                                            <td>#<?php echo $defaulter['es_preadmissionid']; ?></td>
                                            <td><?php echo $defaulter['pre_name']." ".$defaulter['middle_name']." ".$defaulter['pre_lastname']; ?></td>
                                            <td><?php echo $defaulter['pre_mobile_no']; ?></td>
                                            <td><?php echo $defaulter['pre_sms_no']; ?></td>
                                            <td><?php echo $defaulter['grno']; ?></td>
                                            <td><?php echo $defaulter['pre_cur_address']; ?></td>
                                            <td align="center">

                                                <a href="?pid=21&action=remove_defaulter&student_id=<?php echo $defaulter['es_preadmissionid']; ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-original-title="Remove From Defaulter List"> &nbsp;<i class="fa fa-trash-o"></i> </a>

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
        <script type="text/javascript" src="<?php echo base_url('assets/third_party/DataTables/datatables.min.js'); ?>"></script>
         <script type="text/javascript"> 
        function ajax_datatable()
        {
            $(document).ready(function() {
                $('.datatable-basic').DataTable( {
                    destroy: true,
                    "ordering": false,
                    "ajax": 'products'
                } );

                $('.data-table').DataTable();
            } );
        }
        ajax_datatable({
            "ordering": false
        });
    </script>
    </body>
</html>