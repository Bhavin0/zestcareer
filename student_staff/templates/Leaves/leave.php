<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Leave Request</title>
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
                                <span class="title elipsis">
                                    <strong>Leave Requestes</strong>
                                </span>
                            </div>
                            <div class="panel-body">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>From Date</th>
                                      <th>To Date</th>
                                      <th>Leave Days</th>
                                      <th>Priority</th>
                                      <th>Reason</th>
                                      <th>Type</th>
                                      <th>Duration</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <?php 
                                  $requests = mysqli_query($mysqli_con, "SELECT es_leave_request.*, es_leavemaster.leave_name FROM es_leave_request LEFT JOIN es_leavemaster ON es_leave_request.leave_type = es_leavemaster.es_leavemasterid WHERE es_staffid =".$_SESSION['eschools']['user_id']);

                                  while($request = mysqli_fetch_assoc($requests))
                                  {
                                    ?>
                                  <tbody>
                                    <?php
                                      if($request['status'] == 'Pending') { $class='warning'; }
                                      elseif($request['status'] == 'Approved') { $class='success'; }
                                      elseif($request['status'] == 'Rejected') { $class='danger'; }
                                    ?>
                                    <tr class="<?php echo $class; ?>">
                                      <td><?php echo date_format(date_create($request['leave_fromdate']), 'd/m/Y'); ?></td>
                                      <td><?php echo date_format(date_create($request['leave_todate']), 'd/m/Y'); ?></td>
                                      <td><?php
                                          $diff=date_diff(date_create($request['leave_fromdate']), date_create($request['leave_todate']));
                                          echo $diff->format("%a") + 1;
                                          ?> Days
                                      </td>
                                      <td><?php echo $request['priority']; ?></td>
                                      <td><?php echo nl2br($request['reason']); ?></td>
                                      <td><?php echo $request['leave_name']; ?></td>
                                      <td><?php echo $request['leave_duration']; ?></td>
                                      <td><?php echo $request['status']; ?></td>
                                      <td>
                                        <?php if(($request['status']=='Pending') && $request['leave_fromdate'] > date('Y-m-d')) { ?>
                                        <a href="?pid=24&action=edit_leave&edit_id=<?php echo $request['es_leave_request_id']; ?>" class="btn btn-info btn-xs">
                                          &nbsp;<i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a href="" class="btn btn-danger btn-xs">
                                          &nbsp;<i class="fa fa-trash-o"></i>
                                        </a>
                                        <?php } ?>
                                      </td>
                                    </tr>
                                  </tbody>
                                    <?php
                                  }
                                  ?>
                                </table>
                              </div>
                            </div>
                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <span class="title elipsis">
                                    <strong>Annual Leaves</strong>

                                </span>
                            </div>
                            <div class="panel-body">
                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>SR NO.</th>
                                      <th>ACADEMIC YEAR</th>
                                      <th>LEAVE NAME</th>
                                      <th>ALLOWED LEAVE</th>
                                      <th>USED LEAVE</th>
                                      <th>BALANCE LEAVE</th>
                                    </tr>
                                  </thead>
                                  <?php 
                                  $teacher_dept = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT st_department FROM es_staff WHERE es_staffid=".$_SESSION['eschools']['user_id']));

                                  $leaves = mysqli_query($mysqli_con, "SELECT `es_leavemaster`.*, `es_finance_master`.`fi_ac_startdate`, `es_finance_master`.`fi_ac_enddate` FROM es_leavemaster INNER JOIN `es_finance_master` ON `es_finance_master`.es_finance_masterid = `es_leavemaster`.`academic_year_id` WHERE leave_department=".$teacher_dept['st_department']);

                                  $i = 1;
                                  while($leave = mysqli_fetch_assoc($leaves))
                                  {
                                    $used_leaves = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM es_attend_staff WHERE (at_staff_id='".$_SESSION['eschools']['user_id']."') AND (at_staff_attend='A') AND (at_staff_remarks='Paid') AND (leave_type='".$leave['es_leavemasterid']."')"), MYSQLI_NUM) or die(mysqli_error($mysqli_con));
                                    ?>
                                  <tbody>
                                    <tr>
                                      <td><?php echo $i++; ?></td>
                                      <td><?php echo displaydate($leave['fi_ac_startdate'])." - ".displaydate($leave['fi_ac_enddate']); ?></td>
                                      <td><?php echo $leave['leave_name']; ?></td>
                                      <td align="center"><?php echo $leave['allowed_leave']; ?></td>
                                      <td align="center"><?php echo $used_leaves[0]; ?></td>
                                      <td align="center"><?php echo $leave['allowed_leave'] - $used_leaves[0]; ?></td>
                                    </tr>
                                  </tbody>
                                    <?php
                                  }
                                  ?>
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
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
  </body>
</html>