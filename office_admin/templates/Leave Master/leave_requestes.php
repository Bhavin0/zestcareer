<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Leave Requests</title>
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
                                <strong>Leave Requests</strong>
                            </div>
                            <?php
                                $sql = mysql_query("SELECT es_leave_request.*, es_staff.st_firstname, es_staff.st_lastname, es_leavemaster.lev_type, es_leavemaster.es_leavemasterid, es_leavemaster.lev_leavescount FROM es_leave_request INNER JOIN es_staff ON es_staff.es_staffid = es_leave_request.es_staffid LEFT JOIN es_leavemaster ON es_leave_request.leave_type = es_leavemaster.es_leavemasterid ORDER BY es_leave_request_id DESC");
                            ?>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">Req.ID</th>
                                <th width="11%">From - To</th>
                                <th>Leaves</th>
                                <th>Requester</th>
                                <th>Priority</th>
                                <th>Reason</th>
                                <th width="15%">Type (Left Days)</th>
                                <th>Leave Duration</th>
                                <th>Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = mysql_fetch_assoc($sql)) {
                                if($row['status'] == 'Pending') { $class = 'warning'; }
                                elseif ($row['status'] == 'Rejected') { $class = 'danger'; }
                                else { $class = 'success'; }

                            $used_leaves = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM es_attend_staff WHERE (at_staff_id='".$row['es_staffid']."') AND (at_staff_attend='A') AND (at_staff_remarks='Paid') AND (leave_type='".$row['es_leavemasterid']."')"), MYSQLI_NUM) or die(mysqli_error($mysqli_con));

                            ?>
                            <tr class="<?php echo $class; ?>">
                                <td align="center"><?php echo $row['es_leave_request_id']; ?></td>
                                <td><?php echo date_format(date_create($row['leave_fromdate']), 'd/m/Y'); ?> - <?php echo date_format(date_create($row['leave_todate']), 'd/m/Y'); ?></td>
                                <td>
                                    <?php
                                        $date = date_diff(date_create($row['leave_fromdate']), date_create($row['leave_todate']));
                                        echo $date->format("%a") + 1;
                                    ?> Days
                                </td>
                                <td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
                                <td><?php echo $row['priority']; ?></td>
                                <td><?php echo $row['reason']; ?></td>
                                <td><?php echo $row['lev_type']; ?>
                                    <?php if(($row['status'] == 'Pending' || $row['status'] == 'Rejected') && ($row['leave_todate'] >= date('Y-m-d'))) { ?>
                                    <br>(<?php echo $row['lev_leavescount'] - $used_leaves[0]; ?> Left)
                                    <?php } ?>
                                </td>
                                <td><?php echo $row['leave_duration']; ?></td>
                                <td><?php echo $row['status'];?></td>
                                <td>
                                    <?php if(($row['leave_todate'] >= date('Y-m-d')) && ($row['status'] == 'Pending' || $row['status'] == 'Rejected')) { ?>
                                    <a href="?pid=137&action=leave_requestes&status=Approved&request_id=<?php echo $row['es_leave_request_id']; ?>" class="btn btn-success btn-xs" title="Approve">
                                        &nbsp;<i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                    <?php } ?>
                                    <?php if(($row['leave_todate'] >= date('Y-m-d')) && ($row['status'] == 'Pending' || $row['status'] == 'Approved')) { ?>
                                    <a href="?pid=137&action=leave_requestes&status=Rejected&request_id=<?php echo $row['es_leave_request_id']; ?>" title="Reject" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to reject this request?')">
                                        &nbsp;<i class="fa fa-trash-o"></i>
                                    </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- col-LG-12 -->
  </div>
  </section>
</div>



  
    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
        <script>
        $(function () {
            $(".table").DataTable({
                ordering: false
            })
        });
        </script>
  </body>
</html>