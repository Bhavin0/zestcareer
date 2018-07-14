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
                    <strong>Change Password</strong>
                </span>
              </div>

              <div class="panel-body">

  <form action="" method="post" name="password_change">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3">
          <?php  if (isset($message_text)){ ?>
            <div class="alert alert-<?php echo $alert_class; ?>">
              <?php echo $message_text; ?>
            </div>
          <?php } ?>
            <div class="form-group">
              <label><b>Old Password</b></label>
              <input type="password" name="st_old_password" id="st_old_password" class="form-control input-sm" required>
            </div>

            <div class="form-group">
              <label><b>New Password</b></label>
              <input type="password" name="st_new_password" id="st_new_password" class="form-control" required>
            </div>

            <div class="form-group">
              <label><b>Rewrite Password</b></label>
              <input type="password" name="st_rew_password" id="st_rew_password" class="form-control" required>
            </div>

            <div class="form-group">
              <input name="change_password" type="submit" class="btn btn-info pull-right" value="Submit">
            </div>
      </div>
      </form>


             </div>
            </div>
          </div>


          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <?php include(TEMPLATES_PATH . DS . 'rightmenu.php'); ?>
          </div>
        </div>
      </section>
    </div>

    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
  </body>
</html>
  