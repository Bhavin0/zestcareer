<!doctype html>
<html lang="en-US">
  	<head>
    	<meta charset="utf-8" />
    	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    	<title>Enter Activity Marks</title>
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
          		<!-- PANEL START -->
	          		<div class="panel panel-primary">
		          		<div class="panel-heading">
			          		<span class="elipsis title"><strong>Enter Activity Marks</strong></span>
		          		</div>

		          		<div class="panel-body">
		          			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		          				<div class=" well">
		          				<?php
		          				$semester_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_finance_master.*, new_semesters.* FROM new_semesters INNER JOIN es_finance_master ON es_finance_master.es_finance_masterid = new_semesters.academic_year_id WHERE new_semesters.semester_id=".$_GET['semester_id'])); //fetches detail of semester

                      $class_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_classesid=".$_GET['class_id'])); //fetches detail of semester

		          				?>

		          				<b> Academic Year : </b> <?php echo date_format(date_create($semester_detail['fi_ac_startdate']), 'Y')."-".date_format(date_create($semester_detail['fi_ac_enddate']), 'y'); ?>
                  				| <b> Semester : </b> <?php echo $semester_detail['name']; ?>
                  				| <b> Class : </b> <?php echo $class_detail['es_classname']; ?>
                  				<br><br>
		          				</div>
		          			</div>
                			<?php
                  				$students = mysqli_query($mysqli_con, "SELECT es_preadmission_details.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.middle_name, es_preadmission.pre_lastname FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE academic_year_id=".$semester_detail['academic_year_id']." AND pre_class=".$_GET['class_id']." ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name") or die(mysqli_error($mysqli_con)); //fetches list of students

                  				$activities = mysqli_query($mysqli_con, "SELECT student_activtiy_exam.*, student_activities.activity_name FROM student_activtiy_exam INNER JOIN student_activities ON student_activtiy_exam.activity_id = student_activities.activity_id WHERE student_activtiy_exam.semester_id=".$_GET['semester_id']." AND student_activtiy_exam.class_id=".$_GET['class_id']); //fetches subjects

                          $grades = mysqli_query($mysqli_con, "SELECT * FROM grades_setting WHERE class_id=".$_GET['class_id']." ORDER BY grade_id"); //fetch grade
                			?>

                			<form action="" method="post">
                  				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                    				<table class="table table-bordered table-condensed">
                      					<thead>
                        					<th>Roll No.</th>
                        					<th>Student Name</th>
                        					<?php while($activity = mysqli_fetch_assoc($activities)) { ?>
                        					<th>
                        						<?php echo $activity['activity_name']; ?>
                        						<input type="hidden" name="student_activtiy_examid[]" value="<?php echo $activity['student_activtiy_examid']; ?>">
                        					</th>
                        					<?php } ?>
                      					</thead>
                      					<tbody>
                      					<?php
                        					$i=1; 
                        					while($student = mysqli_fetch_assoc($students)) { ?>
                        					<tr>
                          						<td><?php echo $student['scat_id']; ?></td>
                          						<td>
                            						<?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?>
                            						<input type="hidden" name="studentid[]" value="<?php echo $student['es_preadmissionid']; ?>">
                          						</td>
                          						<?php
                          						mysqli_data_seek($activities, 0);
                          						while($activity = mysqli_fetch_assoc($activities)) {
                          							if($subject['status'] == 'Submitted')
                          							{
                          								$stud_grade = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT grade FROM student_activity_grades WHERE es_examdetailsid=".$activity['student_activtiy_examid']." AND student_id=".$student['es_preadmissionid']), MYSQLI_ASSOC);
                          							}
                          							else
                          							{
                          								unset($stud_grade);
                          							}
                          						?>
                          						<td width="10%">				
                                        <select name="grade[<?php echo $activity['student_activtiy_examid']; ?>][]" class="form-control" required="">
                                        <option value="" selected="" disabled="">--SELECT--</option>
                                        <?php mysqli_data_seek($grades, 0);
                                        while($grade = mysqli_fetch_assoc($grades))
                                        {
                                          echo"<option value='".$grade['grade']."'>".$grade['grade']."</option>";
                                        }
                                        ?>
                                        </select>
                          						</td>
                          						<?php } ?>
                        					</tr>
                        				<?php } ?>
                      					</tbody>
                    				</table>
                  				</div>
                  				<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    				<input type="submit" name="submit" value="submit" class="btn btn-primary pull-right">
                  				</div>
                			</form>
              			</div>
            		</div>
          		</div>
        	</div>
      		</section>
    	</div>

    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    	<script type="text/javascript">
      $('#dd-12').addClass('active');
      $('#dd-11-4').addClass('active');
    	</script>
  	</body>
</html>