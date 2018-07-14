<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>SMS Setup</title>
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
                <span class="title elipsis"><strong>SMS Setup</strong></span>
              </div>
              <div class="panel-body">
              <?php $sms_detail = get_single_row('smsconfig', array('configid' => 1)); ?>
                <form method="post" action="">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <label><b>API Link</b></label>
                    <textarea class="form-control" name="data[sms_api_url]"><?php echo $sms_detail['sms_api_url']; ?></textarea>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <label> <b>*</b> add <b>[phone_nos]</b>, in place of mobile no. and <b>[message]</b> in place of message.</label>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> SAVE</button>
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