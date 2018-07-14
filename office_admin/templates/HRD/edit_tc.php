<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Trasfer Certificate</title>
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
						<div class="panel panel-primary">

							<div class="panel-heading">
								<span class="title elipsis">
									<strong>Edit Transfer Certificate</strong>
								</span>
							</div>

							<div class="panel-body"> 
                <?php 
                $certificate = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_transferstudent WHERE id =".$_GET['tc_id']), MYSQLI_ASSOC);
                ?>
                <form action="" method="post">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Date</b></label>
                  <input type="text" name="date" class="form-control datepicker" value="<?php echo $certificate['date']; ?>" readonly>
							  </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>GR No.</b></label>
                  <input type="text" name="grno" class="form-control" value="<?php echo $certificate['grno']; ?>">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                  <label><b>Name of Student</b></label>
                  <input type="text" name="name_of_student" class="form-control" value="<?php echo $certificate['name_of_student']; ?>">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                  <label><b>Mother's Name</b></label>
                  <input type="text" name="mother_name" class="form-control" value="<?php echo $certificate['mother_name']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Religion</b></label>
                  <input type="text" name="religion" class="form-control" value="<?php echo $certificate['religion']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Place of Birth</b></label>
                  <input type="text" name="place_of_birth" class="form-control" value="<?php echo $certificate['place_of_birth']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Date of Birth</b></label>
                  <input type="text" name="date_of_birth" class="form-control datepicker" value="<?php echo $certificate['date_of_birth']; ?>" readonly>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Date of Birth In Words</b></label>
                  <input type="text" name="date_of_birth_in_words" class="form-control" value="<?php echo $certificate['date_of_birth_in_words']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Last School Attended</b></label>
                  <input type="text" name="last_school" class="form-control" value="<?php echo $certificate['last_school']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Date of Admission</b></label>
                  <input type="text" name="date_of_admission" class="form-control datepicker" value="<?php echo $certificate['date_of_admission']; ?>" readonly>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Progress</b></label>
                  <input type="text" name="progress" class="form-control" value="<?php echo $certificate['progress']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Conduct</b></label>
                  <input type="text" name="conduct" class="form-control" value="<?php echo $certificate['conduct']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Date of Leaving</b></label>
                  <input type="text" name="date_of_leaving" class="form-control datepicker" value="<?php echo $certificate['date_of_leaving']; ?>" readonly>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Last standard studying</b></label>
                  <input type="text" name="last_standard" class="form-control" value="<?php echo $certificate['last_standard']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Last standard Join</b></label>
                  <input type="text" name="last_standard_join" class="form-control datepicker" value="<?php echo $certificate['last_standard_join']; ?>" readonly>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>Reason of Leaving School</b></label>
                  <input type="text" name="reason" class="form-control" value="<?php echo $certificate['reason']; ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                  <label><b>No. of Days present in STD.</b></label>
                  <input type="text" name="no_of_present_days" class="form-control" value="<?php echo $certificate['no_of_present_days']; ?>">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                  <label><b>Remarks</b></label>
                  <textarea name="remarks" class="form-control"><?php echo $certificate['remarks']; ?></textarea>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group"> 
                  <button class="btn btn-primary pull-right" type="submit" name="update_certi" value="update">
                    UPDATE
                  </button>
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
  </body>
</html>