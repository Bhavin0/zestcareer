
<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Student Attendancesheets</title>
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
                           <span class="title elipsis"><strong>Student Attendancesheets</strong></span>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-filter"></i> FILTER</button>

                                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Filter Attendancesheets</h4>
                                            </div>

                                            <form action="?pid=140&action=student_attendancesheets" method="get">
                                                <input type="hidden" value="140" name="pid">
                                                <input type="hidden" name="action" value="student_attendancesheets">
                                                <div class="modal-body">

                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label><b>From</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" readonly="" name="from_date" value="<?php echo date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label><b>To</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" readonly="" name="to_date" value="<?php echo date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label><b>Standard</b></label>
                                                        <select name="standard_id" class="form-control selectpicker" data-live-search="true"   onchange="fetchdivision(this.value)">
                                                            <option value="0">All Standard</option>
                                                        <?php
                                                            $sql1 = "SELECT * FROM es_classes";
                                                            $res1 = mysql_query($sql1);
                                                            while( $row = mysql_fetch_assoc($res1))
                                                            {
                                                                echo"<option value='".$row['es_classesid']."'> ".$row['es_classname']." </option>";
                                                            }
                                                        ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label><b>Select Division</b></label>
                                                        <select class="form-control" id="divisions" name="division">
                                                            <option value="0" >ALL DIVISION</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">SEARCH</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Class (Division)</th>
                                            <th>Present</th>
                                            <th>Absent</th>
                                            <th>Submitted By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT `student_attendance`.*, `es_classes`.`es_classname`, `isd_class_division`.`division_name`,`es_staff`.`st_firstname`,`es_staff`.`st_lastname` FROM `student_attendance` INNER JOIN `es_classes` ON `es_classes`.es_classesid = `student_attendance`.`standard_id` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `student_attendance`.`division_id` INNER JOIN es_staff ON `es_staff`.`es_staffid` = `student_attendance`.`teacher_id` ";
                                        if(!isset($_GET['from_date']) && !isset($_GET['to_date']))
                                        {
                                            $query .= " WHERE student_attendance.attendance_date >= '".date('Y-m-d')."' AND student_attendance.attendance_date <= '".date('Y-m-d')."'";
                                        }
                                        else
                                        {
                                            $query .= " WHERE student_attendance.attendance_date >= '".$_GET['from_date']."' AND student_attendance.attendance_date <= '".$_GET['to_date']."'";
                                        }

                                        if(isset($_GET['standard_id']) && $_GET['standard_id'] != '0')
                                        {
                                            $query .= " AND student_attendance.standard_id = '".$_GET['standard_id']."'";
                                        }

                                        if(isset($_GET['division']) && $_GET['division'] != '0')
                                        {
                                            $query .= " AND student_attendance.division_id = '".$_GET['division']."'";
                                        }

                                        $query .= " ORDER BY student_attendance.attendance_date, es_classes.es_orderby, isd_class_division.division_name,
                                            division_id";


                                        $tests = mysql_query($query) or die(mysql_error($mysqli_con));
                                        //print_r($tests);exit;
                                        while ($test = mysql_fetch_assoc($tests)) {
                                        $present_stud = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM attendancesheet WHERE attendance='P' AND attendance_id=".$test['attendance_id']));

                                        $absent_stud = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM attendancesheet WHERE attendance='A' AND attendance_id=".$test['attendance_id']));
                                        ?>
                                        <tr>
                                            <td><?php echo $test['attendance_id']; ?></td>
                                            <td><?php echo date_format(date_create($test['attendance_date']), 'd/m/Y'); ?></td>
                                            <td><?php echo $test['es_classname']; ?> - <?php echo $test['division_name']; ?></td>
                                            <td><?php echo $present_stud[0]; ?></td>
                                            <td><?php echo $absent_stud[0]; ?></td>
                                            <td><?php echo $test['st_firstname']." ".$test['st_lastname']; ?></td>
                                            <td align="center">
                                                <a href="?pid=140&action=stud_attend_report&attendance_id=<?php echo $test['attendance_id']; ?>" class="btn btn-info btn-xs">&nbsp;<i class="fa fa-table"></i></a>

                                                <a href="?pid=140&action=attendancesheet_edit&attendance_id=<?php echo $test['attendance_id']; ?>" class="btn btn-warning btn-xs">&nbsp;<i class="fa fa-pencil-square-o"></i></a>
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
        function fetchdivision(str)
            {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            var divisions = document.getElementById('divisions');
            divisions.innerHTML = "<option value='0'>All Division</option>";
            divisions.innerHTML = divisions.innerHTML + this.responseText;
            }
        };
        xmlhttp.open("GET","ajax.php?action=divisions&q="+str,true);
        xmlhttp.send();
        }
        </script>   
    </body>
</html>