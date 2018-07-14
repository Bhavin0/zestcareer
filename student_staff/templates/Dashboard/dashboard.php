<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Dashboard</title>
    <meta name="description" content="" />
    <meta name="Author" content="" />

    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/fullcalendar/fullcalendar.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
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
        <header id="page-header">
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <ol class="breadcrumb">
            <li><a href="javascript:;">Staff</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </header>
      <?php
        $sel_year = "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
        $res_year = getarrayassoc($sel_year);
        ?>

        <div id="content" class="dashboard" style="padding-top: 5px;">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                Welcome to <h4><?php echo strtoupper($db->getOne("SELECT fi_schoolname FROM es_finance_master WHERE es_finance_masterid=(SELECT MAX(es_finance_masterid) FROM es_finance_master)")); ?></h4>
              </div>
            </div>

            <div class="row">
             

              <div class="col-md-3 col-sm-12">
                <div class="box success">
                  <div class="box-title">
                    <h4><a href="index.php?pid=16&action=myprofile"><?php echo $total_staff[0]; ?> MY PROFILE</a></h4>
                    <small class="block"></small>
                    <i class="fa fa-user"></i>
                  </div>
                  <div class="box-body text-center">
                    <span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
                    331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div id="panel-misc-portlet-color-r2" class="panel panel-warning">
                  <div class="panel-heading">
                    <span class="elipsis">
                      <strong>Notice Board</strong>
                    </span>
                    <ul class="options pull-right list-inline">
                      <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                    </ul>
                  </div>
                  <div class="panel-body" style="min-height: 250px;">
                    <marquee direction="up" scrolldelay="10" vspace="10px" scrollamount="2">
                      <ol>
                      <?php while($notice = mysqli_fetch_assoc($notices)) { ?>
                        <li>
                          <strong><?php echo $notice['es_title']; ?> [<?php echo date_format(date_create($notice['es_date']), 'd/m/Y'); ?>]</strong>
                          <br><?php echo $notice['es_message']; ?><br><br>
                        </li>
                        <?php } ?>
                      </ol>
                    </marquee>
                  </div>
                  <div class="panel-footer">
                    <a href="index.php?pid=33&action=noticeboard  " class="btn btn-warning btn-xs"> View All </a>
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div id="panel-misc-portlet-color-r2" class="panel panel-danger">
                  <div class="panel-heading">
                    <span class="elipsis">
                      <strong>Holidays</strong>
                    </span>
                    <ul class="options pull-right list-inline">
                      <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                    </ul>
                  </div>
                  <div class="panel-body" style="min-height: 250px;">
                    <marquee direction="up" scrolldelay="10" vspace="10px" scrollamount="2">
                      <ol>
                      <?php while($holiday = mysqli_fetch_assoc($holidays)) { ?>
                        <li>
                          <strong><?php echo $holiday['title']; ?> [<?php echo date_format(date_create($holiday['holiday_date']), 'd/m/Y'); ?>]</strong>
                        </li>
                        <?php } ?>
                      </ol>
                    </marquee>
                  </div>
                  <div class="panel-footer">
                    <a href="index.php?pid=29&action=holidayslist" class="btn btn-danger btn-xs"> View All </a>
                  </div>
                </div>
              </div>
            </div>

            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-success">
                  <div class="panel-body">
                <div id="calendar" data-modal-create="true"></div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div id="panel-misc-portlet-color-r2" class="panel panel-success">
                  <div class="panel-heading">
                    <span class="elipsis">
                      <strong>Photo Gallery</strong>
                    </span>
                    <ul class="options pull-right list-inline">
                      <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                    </ul>
                  </div>
                  <div class="panel-body" style="min-height: 250px;">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner">
                        <?php
                        $albums = mysqli_query($mysqli_con, "SELECT * FROM photo_gallery ORDER BY photo_galleryid DESC LIMIT 3"); $i = 0;
                        while($album = mysqli_fetch_assoc($albums)) { ?>
                        <div class="item <?php echo ($i==0)?'active':''; ?>">
                          <img src="<?php echo base_url('uploads/photo_gallery/'.$album['photo_galleryid'].'/album_cover.jpg'); ?>" alt="<?php echo $album['photo_gallery_name']; ?>" style="width:100%;">
                          <div class="carousel-caption">
                            <h3><a href="?pid=54&action=upload_photos&album_id=<?php echo $album['photo_galleryid']; ?>"><?php echo $album['photo_gallery_name']; ?></a></h3>
                            <p><?php echo $album['photo_gallery_description']; ?></p>
                          </div>
                        </div>
                        <?php $i++; } ?>
                      </div>

                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <a href="index.php?pid=41&action=album_list" class="btn btn-success btn-xs"> View All </a>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <?php  include(TEMPLATES_PATH . DS . 'rightmenu2.tpl.php'); ?>
          </div>
        </div>
      </section>
    </div>
    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
    <script type="text/javascript">

      /* Calendar Data */
      var date  = new Date();
      var d     = date.getDate();
      var m     = date.getMonth();
      var y     = date.getFullYear();

      var _calendarEvents = [];

      loadScript(plugin_path + "jquery/jquery.cookie.js", function(){
        loadScript(plugin_path + "jquery/jquery-ui.min.js", function(){
          loadScript(plugin_path + "jquery/jquery.ui.touch-punch.min.js", function(){
            loadScript(plugin_path + "moment.js", function(){
              loadScript(plugin_path + "bootstrap.dialog/dist/js/bootstrap-dialog.min.js", function(){
                loadScript(plugin_path + "fullcalendar/fullcalendar.js", function(){
                  loadScript(plugin_path + "fullcalendar/gcal.js", function(){

                    // Load Calendar Demo Script
                    loadScript("<?php echo base_url('assets/js/view/demo.calendar.js'); ?>");

                  });
                });
              });
            });
          });
        });
      });

    </script>
  </body>
</html>