<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>View Marks</title>
    <meta name="description" content="" />
    <meta name="Author" content="" />
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
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

      $exam_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_finance_master.fi_ac_startdate, es_finance_master.fi_ac_enddate, es_classes.es_classname, new_semesters.name, es_exam.es_examname, es_exam_details.*, es_subject.es_subjectname FROM es_exam_details INNER JOIN es_exam_academic ON es_exam_details.academicexam_id = es_exam_academic.es_exam_academicid INNER JOIN es_finance_master ON es_finance_master.es_finance_masterid = es_exam_academic.academic_year INNER JOIN es_classes ON es_classes.es_classesid = es_exam_academic.class_id INNER JOIN new_semesters ON new_semesters.semester_id = es_exam_academic.semester_id INNER JOIN es_exam ON es_exam.es_examid = es_exam_academic.exam_id INNER JOIN es_subject ON es_subject.es_subjectid = es_exam_details.subject_id WHERE es_exam_details.es_exam_detailsid=".$_GET['exam_id']));
      ?>
        <header id="page-header">
          <h1><i class="main-icon et-documents"></i> View Examination Marks</h1>
          <ol class="breadcrumb">
            <li><a href="?pid=44">Admin</a></li>
            <li><a href="?pid=36&action=examreport">Examinations</a></li>
            <li><a href="?pid=36&action=examreport"><?php echo date_format(date_create($exam_detail['fi_ac_startdate']), 'Y')."-".date_format(date_create($exam_detail['fi_ac_enddate']), 'y'); ?></a></li>
            <li><a href="?pid=36&action=examreport"><?php echo $exam_detail['name']; ?></a></li>
            <li><a href="?pid=36&action=examreport"><?php echo $exam_detail['es_classname']; ?></a></li>
            <li><a href="?pid=36&action=exam_detail&exam_id=5"><?php echo $exam_detail['es_examname']; ?></a></li>
            <li class="active"><?php echo $exam_detail['es_subjectname']; ?></li>
          </ol>
        </header>

        <div id="content" class="dashboard" style="padding-top: 5px;">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	          <div class="panel panel-primary">
		          <div class="panel-body">
                <?php
                  $students = mysqli_query($mysqli_con, "SELECT es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_marks.* FROM es_marks INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_marks.es_marksstudentid WHERE es_marks.es_examdetailsid=".$_GET['exam_id']) or die(mysqli_error($mysqli_con));
                ?>  
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                  <div class="row">
                    <table class="table table-bordered table-condensed table-striped">
                      <thead>
                        <th width="10%">SR No.</th>
                        <th>Student Name</th>
                        <th width="15%">Obtained Marks</th>
                      </thead>
                      <tbody>
                      <?php
                        $i=1;
                        while($student = mysqli_fetch_assoc($students)) { ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td>
                            <?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?>
                          </td>
                          <td align="center">
                            <?php echo $student['es_marksobtined']; ?>
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