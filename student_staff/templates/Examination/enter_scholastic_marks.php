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
		          				$exam_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_finance_master.fi_ac_startdate, es_finance_master.fi_ac_enddate, es_classes.es_classname, new_semesters.name, student_activities.activity_name, student_activtiy_exam.* FROM student_activtiy_exam INNER JOIN es_finance_master ON es_finance_master.es_finance_masterid = student_activtiy_exam.academic_year INNER JOIN es_classes ON es_classes.es_classesid = student_activtiy_exam.class_id INNER JOIN new_semesters ON new_semesters.semester_id = student_activtiy_exam.semester_id INNER JOIN student_activities ON student_activities.activity_id = student_activtiy_exam.activity_id WHERE student_activtiy_exam.student_activtiy_examid=".$_GET['student_activtiy_examid'])) or die(mysqli_error($mysqli_con));

		          				?>

		          			<b> Academic Year : </b> <?php echo date_format(date_create($exam_detail['fi_ac_startdate']), 'Y')."-".date_format(date_create($exam_detail['fi_ac_enddate']), 'y'); ?>
                  	| <b> Semester : </b> <?php echo $exam_detail['name']; ?>
                  	| <b> Class : </b> <?php echo $exam_detail['es_classname']; ?>
                    | <b> Activity : </b> <?php echo $exam_detail['activity_name']; ?>
                  	<br><br>
		          		</div>
		          			</div>
                			<?php

                  				$students = mysqli_query($mysqli_con, "SELECT es_preadmission_details.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.middle_name, es_preadmission.pre_lastname FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE academic_year_id=".$exam_detail['academic_year']." AND pre_class=".$exam_detail['class_id']." ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name") or die(mysqli_error($mysqli_con));

                          $grades = mysqli_query($mysqli_con, "SELECT * FROM grades_setting WHERE class_id=".$exam_detail['class_id']." ORDER BY grade_id"); //fetch grade
                			?>

                			<form action="" method="post">
                  				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    				<table class="table table-bordered table-condensed">
                      <thead>
                        <th width="10%">Role No.</th>
                        <th>Student Name</th>
                        <th>Grade</th>
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
                          <td>
                            <select name="grade[]" class="form-control">
                            <?php
                            mysqli_data_seek($grades, 0);
                            while($grade = mysqli_fetch_assoc($grades))
                            {
                              echo"<option value='".$grade['grade']."'>".$grade['grade']."</option>";
                            }
                            ?>
                            </select>
                          </td>
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