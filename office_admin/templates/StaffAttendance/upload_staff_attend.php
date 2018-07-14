<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Upload Staff Attendance</title>
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
                  <strong>Upload Attendance</strong>
                </span>
              </div>

              <div class="panel-body">
                <form action="?pid=27&action=process" method="post" enctype="multipart/form-data">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                    <label><b>From Date</b></label>
                    <input type="text" name="from_date" class="form-control datepicker">
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                    <label><b>To Date</b></label>
                    <input type="text" name="to_date" class="form-control datepicker">
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <div class="fancy-file-upload fancy-file-primary">
                      <i class="fa fa-upload"></i>
                      <input type="file" class="form-control" name="temp" onchange="jQuery(this).next('input').val(this.value);" accept=".txt" />
                      <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                      <span class="button">Choose File</span>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <button type="submit" class="btn btn-primary pull-right" name="upload_attendance" value="1">
                      SUBMIT
                    </button>
                  </div>
                </form>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                  <ul>
                    <li>Select From and To Date of the Attendance, be careful while selecting the date, all the previously inserted data will be overwrite of respective dates.  </li>
                    <li>Upload biometric Attendance machine's unmodified .txt file only.</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
  </body>
</html>