<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Create Examinations</title>
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
			          <span class="elipsis title"><strong>Create Examinations</strong></span>
		          </div>
		          <div class="panel-body">
		            <form action="?pid=36&action=createxam_2" method="post">
                  <input type="hidden" name="pre_year" value="<?php echo $_POST['pre_year']; ?>">
                  <input type="hidden" name="section" value="<?php echo $_POST['section']; ?>">
                  <input type="hidden" name="class" value="<?php echo $_POST['class']; ?>">
                  <?php for($i=0; $i<count($_POST['semesters']); $i++) { ?>
                  <input type="hidden" name="semesters[]" value="<?php echo $_POST['semesters'][$i]; ?>">
                  <?php } ?>
                  <?php for($i=0; $i<count($_POST['exam_type']); $i++) { ?>
                  <input type="hidden" name="exam_type[]" value="<?php echo $_POST['exam_type'][$i]; ?>">
                  <?php } ?>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Total Marks</th>
                        <th>Passing Marks</th>
                        <th>Examiner</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $staffs = mysqli_query($mysqli_con, "SELECT * FROM es_staff ORDER BY st_firstname");
                      $i = 1;
                      $subjects = mysqli_query($mysqli_con, "SELECT * FROM es_subject WHERE es_subjectshortname=".$_POST['class']);
                      while ($subject = mysqli_fetch_assoc($subjects)) { ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $subject['es_subjectname']; ?>
                          <input type="hidden" name="subjectid[]" value="<?php echo $subject['es_subjectid']; ?>">
                        </td>
                        <td>
                          <input type="text" name="exam_date[]" class="datepicker form-control" value="<?php echo date('Y-m-d'); ?>" required="required">
                        </td>
                        <td>
                          <select class="form-control" name="duration[]" required="required">
                            <option value="00:15">00:30</option>
                            <option value="00:15">00:45</option>
                            <option value="00:15">01:00</option>
                            <option value="00:15">01:15</option>
                            <option value="00:15">01:30</option>
                            <option value="00:15">01:45</option>
                            <option value="00:15">02:00</option>
                            <option value="00:15">02:15</option>
                            <option value="00:15">02:30</option>
                            <option value="00:15">02:45</option>
                            <option value="00:15">03:00</option>
                          </select>
                        </td>
                        <td>
                          <input type="number" class="form-control" name="total_marks[]" required="" value="100">
                        </td>
                        <td>
                          <input type="number" class="form-control" name="passing_marks[]" required="" value="35">
                        </td>
                        <td>
                          <select class="form-control" name="examiner[]" required="">
                          <?php
                          mysqli_data_seek($staffs,0);
                          while($staff = mysqli_fetch_assoc($staffs))
                          {
                            echo "<option value='".$staff['es_staffid']."'>";
                            echo $staff['st_firstname']." ".$staff['st_lastname'];
                            echo "</option>";
                          }
                          ?>
                          </select>
                        </td>
                      </tr>
                     <?php } ?>
                    </tbody>
                  </table>

								  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									  <input type="submit" name="create_exam_2" value="SUBMIT" class="btn btn-primary pull-right">
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