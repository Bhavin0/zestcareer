<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Enter Result Detail</title>
    <meta name="description" content="" />
    <meta name="Author" content="" />
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css">
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
			            <span class="elipsis title"><strong>Result Detail</strong></span>
		            </div>

		            <div class="panel-body">
		            	<form action="" method="post">
                    <?php
                    $detail_array = mysqli_query($mysqli_con, "SELECT * FROM results WHERE student_id=".$_GET['student_id']." AND ac_year=".$_GET['ac_year']) or die(mysqli_error($mysqli_con));
                    if(mysqli_num_rows($detail_array) > 0)
                    {
                      $detail = mysqli_fetch_array($detail_array, MYSQLI_ASSOC);
                    }
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                      <label><b>Remarks</b></label>
                      <input type="text" name="remarks" class="form-control" value="<?php echo $detail['remarks']; ?>">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                      <label><b>Promoted to Class</b></label>
                      <input type="text" name="next_class" class="form-control" value="<?php echo $detail['next_class']; ?>">
                    </div>
								    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									    <input type="submit" name="enter_detail" value="SUBMIT" class="btn btn-primary pull-right">
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
      <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
      <script type="text/javascript">
          $('#dd-12').addClass('active');
          $('#dd-11-4').addClass('active');
      </script>

    </body>
</html>