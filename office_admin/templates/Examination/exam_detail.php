<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Examinations</title>
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

        $exam_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_finance_master.fi_ac_startdate, es_finance_master.fi_ac_enddate, es_classes.es_classname, new_semesters.name, es_exam.es_examname FROM es_exam_academic INNER JOIN es_finance_master ON es_finance_master.es_finance_masterid = es_exam_academic.academic_year INNER JOIN es_classes ON es_classes.es_classesid = es_exam_academic.class_id INNER JOIN new_semesters ON new_semesters.semester_id = es_exam_academic.semester_id INNER JOIN es_exam ON es_exam.es_examid = es_exam_academic.exam_id WHERE es_exam_academic.es_exam_academicid=".$_GET['exam_id']), MYSQLI_ASSOC) or die(mysqli_error($mysqli_con));
      ?>
        <header id="page-header">
          <h1><i class="main-icon et-documents"></i> Examinations</h1>
          <ol class="breadcrumb">
            <li><a href="?pid=44">Admin</a></li>
            <li><a href="?pid=36&action=examreport">Examinations</a></li>
            <li><a href="?pid=36&action=examreport"><?php echo date_format(date_create($exam_detail['fi_ac_startdate']), 'Y')."-".date_format(date_create($exam_detail['fi_ac_enddate']), 'y'); ?></a></li>
            <li><a href="?pid=36&action=examreport"><?php echo $exam_detail['name']; ?></a></li>
            <li><a href="?pid=36&action=examreport"><?php echo $exam_detail['es_classname']; ?></a></li>
            <li class="active"><?php echo $exam_detail['es_examname']; ?></li>
          </ol>
        </header>
        <div id="content" class="dashboard" style="padding-top: 5px;">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <!-- PANEL START -->
            <div class="panel panel-primary">

              <div class="panel-body">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                  <div class="row">
                  <table class="table table-bordered">
                    <thead>
                      <tr> 
                        <th width="10%">S.No.</th>
                        <th>Date</th>
                        <th>Subject</th>
                        <th>Duration</th>
                        <th width="15%">Total Marks</th>
                        <th width="15%">Passing Marks</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=1;
                      $exams = mysqli_query($mysqli_con, "SELECT es_exam_details.*, es_subject.es_subjectname FROM es_exam_details INNER JOIN es_subject ON es_subject.es_subjectid = es_exam_details.subject_id WHERE es_exam_details.academicexam_id = ".$_GET['exam_id']) or die(mysqli_error($mysqli_con));
                      while($exam = mysqli_fetch_assoc($exams))
                      {
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo date_format(date_create($exam['exam_date']), 'd/m/Y'); ?></td>
                        <td><?php echo $exam['es_subjectname']; ?></td>
                        <td><?php echo $exam['exam_duration']; ?></td>
                        <td><?php echo $exam['total_marks']; ?></td>
                        <td><?php echo $exam['pass_marks']; ?></td>
                        <td><?php echo $exam['status']; ?></td>
                        <td>
                          <?php if($exam['status']=='Pending') { ?>
                          <a href="?pid=36&action=enter_marks&exam_id=<?php echo $exam['es_exam_detailsid']; ?>" class="btn btn-info btn-xs" title="Enter Marks">
                            &nbsp;<i class="fa fa-pencil"></i>
                          </a>
                          <?php } else { ?>
                          <a href="?pid=36&action=enter_marks&exam_id=<?php echo $exam['es_exam_detailsid']; ?>" class="btn btn-info btn-xs" title="Edit Marks">
                            &nbsp;<i class="fa fa-pencil-square-o"></i>
                          </a>

                          <a href="?pid=36&action=view_marks&exam_id=<?php echo $exam['es_exam_detailsid']; ?>" class="btn btn-warning btn-xs" title="View Marks">
                            &nbsp;<i class="fa fa-eye"></i>
                          </a>
                          <?php } ?>
                          
                          <?php if($exam['status']=='Submitted') { ?>
                          <a href="?pid=36&action=enter_marks&exam_id=<?php echo $exam['es_exam_detailsid']; ?>" class="btn btn-success btn-xs" title="Finalise Marks">
                            &nbsp;<i class="fa fa-check-circle"></i>
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