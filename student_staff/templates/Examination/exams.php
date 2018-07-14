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
          <!-- PANEL START -->
	          <div class="panel panel-primary">
		          <div class="panel-heading">
			          <span class="elipsis title"><strong>Examinations</strong></span>
		          </div>

		          <div class="panel-body">
                <table class="table table-bordered">
                  <thead>
                    <th width="10%">S.No.</th>
                    <th>Exam Type</th>
                    <th>Class</th>
                    <th>Semester</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                  <?php
                    $i=1;
                    $exams = mysqli_query($mysqli_con, "SELECT es_exam_academic.*, es_exam.es_examname, es_classes.es_classname, new_semesters.name FROM es_exam_academic INNER JOIN es_exam ON es_exam.es_examid = es_exam_academic.exam_id INNER JOIN es_classes ON es_classes.es_classesid = es_exam_academic.class_id INNER JOIN new_semesters ON new_semesters.semester_id = es_exam_academic.semester_id");
                    while($exam = mysqli_fetch_assoc($exams))
                    {
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $exam['es_examname']; ?></td>
                        <td><?php echo $exam['es_classname']; ?></td>
                        <td><?php echo $exam['name']; ?></td>
                        <td>
                          <a href="?pid=17&action=exam_details&exam_id=<?php echo $exam['es_exam_academicid']; ?>" class="btn btn-info btn-xs" title="View Detail">
                            &nbsp;<i class="fa fa-eye"></i>
                          </a>
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