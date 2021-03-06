<!doctype html>
<html lang="en-US">
  	<head>
    	<meta charset="utf-8" />
    	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    	<title>View Attendancesheet</title>
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
                <?php $attendancesheet = mysqli_query($mysqli_con, "SELECT attendancesheet.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission_details.scat_id FROM attendancesheet INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = attendancesheet.studentid INNER JOIN es_preadmission_details ON es_preadmission_details.es_preadmissionid = attendancesheet.studentid INNER JOIN student_attendance ON student_attendance.attendance_id = attendancesheet.attendance_id  WHERE es_preadmission_details.academic_year_id = student_attendance.academic_year_id AND attendancesheet.attendance_id=".$_GET['attendance_id']." ORDER BY es_preadmission_details.scat_id") or die(mysqli_error($mysqli_con)); ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" align="center">
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
                          <td><?php echo $row['pre_name']." ".$row['middle_name']." ".$row['pre_lastname']; ?></td>
                          <td align="center"><?php echo $row['attendance']; ?></td>
                          <td><?php echo $row['remarks']; ?></td>
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
  	</body>
</html>