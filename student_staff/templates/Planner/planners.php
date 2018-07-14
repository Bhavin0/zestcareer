<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>VIEW PLANNER</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />

        <!-- FOOTABLE TABLE -->
        <link href="<?php echo base_url('assets/plugins/footable/css/footable.core.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/footable/css/footable.standalone.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
        include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
        include(TEMPLATES_PATH . DS . 'header_new.tpl.php');
        ?>
            <section id="middle">
            <?php
                $sel_year = "SELECT * FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
                $res_year = getarrayassoc($sel_year);

                $plans = mysqli_query($mysqli_con, "SELECT `teacher_planner`.*, `es_finance_master`.`fi_ac_startdate`, `es_finance_master`.`fi_ac_enddate`, `es_classes`.`es_classname`, `isd_class_division`.`division_name`, `es_subject`.`es_subjectname` FROM `teacher_planner` INNER JOIN `es_finance_master` ON `es_finance_master`.`es_finance_masterid` = `teacher_planner`.`academic_year_id` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `teacher_planner`.`class_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `teacher_planner`.`division_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `teacher_planner`.`subject_id` WHERE `teacher_id` = ".$_SESSION['eschools']['user_id']." ORDER BY academic_year_id DESC, teacher_plannerid ASC") or die(MYSQLI_ERROR($mysqli_con));

            ?>
                <header id="page-header">
                    <ol class="breadcrumb">
                        <li>
                            <b> Academic Year : </b>
                            <?php if($res_year['fi_ac_startdate']!=""){ echo displaydate($res_year['fi_ac_startdate']);?> to <?php echo displaydate($res_year['fi_ac_enddate']); } else { echo "---"; }?>
                        </li>
                    </ol>
                </header>


                <div id="content" class="padding-20">
                    <div id="panel-1" class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="title elipsis">
                                <strong>Your Planner</strong> <!-- panel title -->
                            </span>

                            <!-- right options -->
                            <ul class="options pull-right list-inline">
                                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                            </ul>
                            <!-- /right options -->

                        </div>

                        <!-- panel content -->
                        <div class="panel-body">
                            <label class="pull-right">
                                <a href="?pid=64&amp;action=add_plan" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Add Plan
                                </a>
                            </label>

                            <label><!-- PER PAGE SELECTOR . you can move it to panel-heading -->
                                <select class="form-control pointer" id="change-page-size">
                                    <option value="2">2 / page</option>
                                    <option value="3">3 / page</option>
                                    <option value="5">5 / page</option>
                                    <option value="10" selected="selected">10 / page</option>
                                    <option value="15">15 / page</option>
                                    <option value="20">20 / page</option>
                                </select>
                            </label><!-- /PER PAGE SELECTOR -->

                            <table class="fooTableInit">
                                <thead>
                                  <tr>
                                    <th data-hide = "s300">SR.</th>
                                    <th data-hide = "s300">ACADEMIC YEAR</th>
                                    <th class="foo-cell">CLASS</th>
                                    <th data-hide = "s300">SUBJECT</th>
                                    <th data-hide = "s300">REMARKS</th>
                                    <th data-hide = "s300">ACTION</th>
                                  </tr>
                                </thead>

                                <tbody>
                                <?php $i = 1; while($plan = mysqli_fetch_assoc($plans)) { ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo YMDtoDMY($plan['fi_ac_startdate'])."-".YMDtoDMY($plan['fi_ac_enddate']); ?></td>
                                        <td><?php echo $plan['es_classname']; ?>- <?php echo $plan['division_name']; ?></td>
                                         <td><?php echo $plan['es_subjectname']; ?></td>
                                        
                                       <td><?php echo $plan['planner_remarks']; ?></td>
                                        
                                        <td>
                                            <a href="?pid=63&action=view_plan_detail&plan_id=<?php echo $plan['teacher_plannerid']; ?>" class="btn btn-info btn-xs">&nbsp;<i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <td colspan="6" class="text-center">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                  </tr>
                                </tfoot>

                            </table>


                        </div>
                        <!-- /panel content -->

                        <!-- panel footer -->
                        <div class="panel-footer">



                        </div>
                        <!-- /panel footer -->

                    </div>
                    <!-- /PANEL -->

                </div>
            </section>
            <!-- /MIDDLE -->

        </div>



    
        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript">var plugin_path = "<?php echo base_url('assets/plugins/'); ?>";</script>
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>

        <!-- PAGE LEVEL SCRIPTS -->
        <script type="text/javascript">
            loadScript(plugin_path + "footable/dist/footable.min.js", function(){
                loadScript(plugin_path + "footable/dist/footable.sort.min.js", function(){
                    loadScript(plugin_path + "footable/dist/footable.paginate.min.js", function(){ /** remove if pagination not needed **/

                        // footable
                        var $ftable = jQuery('.fooTableInit');


                        /** 01. FOOTABLE INIT
                        ******************************************* **/
                        $ftable.footable({
                            breakpoints: {
                                s300: 300,
                                s600: 600
                            }
                        });


                        /** 01. PER PAGE SWITCH
                        ******************************************* **/
                        jQuery('#change-page-size').change(function (e) {
                            e.preventDefault();
                            var pageSize = jQuery(this).val();
                            $ftable.data('page-size', pageSize);
                            $ftable.trigger('footable_initialized');
                        });

                        jQuery('#change-nav-size').change(function (e) {
                            e.preventDefault();
                            var navSize = jQuery(this).val();
                            $ftable.data('limit-navigation', navSize);
                            $ftable.trigger('footable_initialized');
                        });


                        /** 02. BOOTSTRAP 3.x PAGINATION FIX
                        ******************************************* **/
                        jQuery("div.pagination").each(function() {
                            jQuery("div.pagination ul").addClass('pagination');
                            jQuery("div.pagination").removeClass('pagination');
                        });

                    });
                });
            });
        </script>

    </body>
</html>