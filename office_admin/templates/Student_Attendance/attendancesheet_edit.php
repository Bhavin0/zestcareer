<!doctype html>
<html lang="en-US">
  	<head>
    	<meta charset="utf-8" />
    	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    	<title>Attendancesheet Edit</title>
    	<meta name="description" content="" />
    	<meta name="Author" content="" />
    	<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    	<link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
    	<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
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
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>View Attendancesheet</strong>
							</span>
						</div>
						<div class="panel-body">
                <?php
                $attendance = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM student_attendance WHERE attendance_id=".$_GET['attendance_id']));

                $attendancesheet = mysqli_query($mysqli_con, "SELECT attendancesheet.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission_details.scat_id FROM attendancesheet INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = attendancesheet.studentid INNER JOIN es_preadmission_details ON es_preadmission_details.es_preadmissionid = attendancesheet.studentid INNER JOIN student_attendance ON student_attendance.attendance_id = attendancesheet.attendance_id  WHERE es_preadmission_details.academic_year_id = student_attendance.academic_year_id AND es_preadmission_details.division_id = student_attendance.division_id AND es_preadmission_details.pre_class = student_attendance.standard_id AND attendancesheet.attendance_id=".$_GET['attendance_id']." AND `es_preadmission`.`pre_status` = 'active' ORDER BY es_preadmission.pre_name ASC") or die(mysqli_error($mysqli_con));?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" align="center">
                  <form action="" method="post" >
                    <input type="hidden" value="<?php echo $attendance['standard_id']; ?>" name="es_classesid">
                  <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th width="10%">ROLL NO.</th>
                          <th>STUDENT NAME</th>
                          <th width="10%">ATTENDANCE</th>
                          <th>REMARKS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while($row = mysqli_fetch_assoc($attendancesheet)) { ?>
                        <tr>
                          <td><?php echo $row['scat_id']; ?></td>
                          <td><?php echo $row['pre_name']." ".$row['middle_name']." ".$row['pre_lastname']; ?>
                              <input type="hidden" name="attendance_key[]" value="<?php echo $row['attendance_key']; ?>">
                              <input type="hidden" name="student_id[]" value="<?php echo $row['studentid']; ?>">
                          </td>
                          <td align="center">
                              <select name="attendance[]" class="form-control">
                                <option <?php echo ($row['attendance']=='P')?'selected':''; ?>>P</option>
                                <option <?php echo ($row['attendance']=='A')?'selected':''; ?>>A</option>
                              </select>
                          </td>
                          <td>
                              <input type="text" name="remarks[]" class="form-control" value="<?php echo $row['remarks']; ?>">
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="4">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right">
                              <i class="fa fa-floppy-o"></i> SUBMIT
                            </button>
                          </td>
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