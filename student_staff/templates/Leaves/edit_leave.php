<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Edit Leave Request</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    
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
                $sel_year = "SELECT * FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
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
                                <span class="title elipsis">
                                    <strong>Edit Leave Request</strong>
                                </span>
                            </div>

                            <div class="panel-body">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                    <?php
                                    $request = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM `es_leave_request` WHERE `es_leave_request_id` =".$_GET['edit_id']), MYSQLI_ASSOC) or die(mysqli_error($mysqli_con));
                                    ?>
                                    <form action="" method="post">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                            <label><b>Priority</b></label>
                                            <select class="form-control" name="priority">
                                                <option <?php echo ($request['priority']=='Normal')?'selected':''; ?>>
                                                    Normal</option>
                                                <option <?php echo ($request['priority']=='Urgent')?'selected':''; ?>>
                                                    Urgent</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                            <label><b>Leave Type</b></label>
                                            <select class="form-control" name="leave_type">
                                            <?php
                                               $teacher_dept = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT st_department FROM es_staff WHERE es_staffid=".$_SESSION['eschools']['user_id']));

                                                $leaves = mysqli_query($mysqli_con, "SELECT `es_leavemaster`.*, `es_finance_master`.`fi_ac_startdate`, `es_finance_master`.`fi_ac_enddate` FROM es_leavemaster INNER JOIN `es_finance_master` ON `es_finance_master`.es_finance_masterid = `es_leavemaster`.`academic_year_id` WHERE leave_department=".$teacher_dept['st_department']);

                                                while($leave = mysqli_fetch_assoc($leaves))
                                                {
                                                    $selected = ($leave['es_leavemasterid']==$request['leave_type'])?'selected':'';
                                                    echo"<option value='".$leave['es_leavemasterid']."' ".$selected.">
                                                    ".$leave['leave_name']."
                                                    </option>";
                                                }
                                            ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                            <label><b>From Date</b></label>
                                            <input type="text" name="from_date" value="<?php echo $request['leave_fromdate']; ?>" class="form-control datepicker">
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                            <label><b>To Date</b></label>
                                            <input type="text" name="to_date" value="<?php echo $request['leave_todate']; ?>" class="form-control datepicker">
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                            <label><b>Leave Duration</b></label>
                                            <select class="form-control" name="leave_duration">
                                                <option <?php echo ($request['leave_duration']=='Full Day')?'selected':''; ?>>Full Day</option>
                                                <option <?php echo ($request['leave_duration']=='First Half')?'selected':''; ?>>First Half</option>
                                                <option <?php echo ($request['leave_duration']=='Second Half')?'selected':''; ?>>Second Half</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                            <label><b>Reason</b></label>
                                            <textarea class="form-control" rows="3" name="reason" required="required" maxlength="2048"><?php echo $request['reason']; ?></textarea>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                            <button type="submit" name="request" value="request" class="btn btn-primary pull-right">Submit</button>
                                        </div>
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
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
  </body>
</html>