<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Dashboard</title>
    <meta name="description" content="" />
    <meta name="Author" content="" />

    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <!-- WEB FONTS -->
    <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

    <!-- CORE CSS -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    
    <!-- THEME CSS -->
    <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
  </head>
  <body>
  <?php
    include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
    include(TEMPLATES_PATH . DS . 'header.php');
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
          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <span class="title elipsis">
                    <strong>My Profile</strong>
                </span>
              </div>

              <div class="panel-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered">
                    <tr>
                      <td width="20%"><b>Student ID : </b></td>
                      <td><?php echo $studentdetails['es_preadmissionid']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Student Name : </b></td>
                      <td><?php echo $studentdetails['pre_name']." ".$studentdetails['middle_name']." ".$studentdetails['pre_lastname']; ?>
                    </tr>
                    <tr>
                      <td><b>Date of Birth : </b></td>
                      <td><?php echo date_format(date_create($studentdetails['pre_dateofbirth']), 'd F Y'); ?>
                    </tr>
                    <tr>
                      <td><b>Father Fullname</b></td>
                      <td><?php echo $studentdetails['pre_fathername']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Mother Fullname</b></td>
                      <td><?php echo $studentdetails['pre_mothername']; ?></td>
                    </tr>
                    <tr>
                      <td><b>GR No.</b></td>
                      <td><?php echo $studentdetails['grno']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Current Class</b></td>
                      <?php
                        $current_class = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_classes.es_classname, es_preadmission_details.scat_id FROM es_preadmission_details INNER JOIN es_classes ON es_classes.es_classesid = es_preadmission_details.pre_class WHERE academic_year_id=".$res_year['es_finance_masterid']." AND es_preadmissionid=".$studentdetails['es_preadmissionid']), MYSQLI_ASSOC) or die(mysqli_error($mysqli_con));
                      ?>
                      <td><?php echo $current_class['es_classname']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Roll No.</b></td>
                      <td><?php echo $current_class['scat_id']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Email</b></td>
                      <td><?php echo $studentdetails['pre_emailid']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>


         <!--  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <?php include(TEMPLATES_PATH . DS . 'rightmenu.php'); ?>
          </div> -->
        </div>
      </section>
    </div>

    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
  </body>
</html>
  