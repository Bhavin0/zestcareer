<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Alloted Student To Pick-Up Point</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
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
                    <span class="elipsis title"><strong>ALLOTED STUDENT TO PICK-UP POINT</strong></span>
                  </div>

                  <div class="panel-body">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                      <a href="?pid=75&action=allocatestudent" class="btn btn-primary pull-right">
                        ADD STUDENT
                      </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                    <label><b>Academic Year</b></label>
                    <select name="academic_year" id="academic_year" name="academic_year" class="form-control selectpicker" data-live-search="true">
                    <?php $academic_years = mysqli_query($mysqli_con, "SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC");
                      while($academic_year = mysqli_fetch_assoc($academic_years)) { ?>
                      <option value="<?php echo $academic_year['es_finance_masterid']; ?>" <?php echo ($_GET['ac_id']==$academic_year['es_finance_masterid'])?'selected':''; ?>>
                        <?php echo displaydate($academic_year['fi_ac_startdate'])." - 
                      ".displaydate($academic_year['fi_ac_enddate']); ?>
                      </option>
                    <?php } ?>
                    </select>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                    <label><b>Class</b></label>
                    <select name='es_classesid'  class="form-control selectpicker" data-live-search="true" id="class_id">
                      <option value="all">ALL CLASS</option>
                      <?php $classes = mysqli_query($mysqli_con, "SELECT * FROM es_classes ORDER BY es_orderby");
                      while($class = mysqli_fetch_assoc($classes)) { ?>
                      <option value="<?php echo $class['es_classesid']; ?>" <?php echo ($_GET['class_id']==$class['es_classesid'])?'selected':''; ?>>
                        <?php echo $class['es_classname']; ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                    <label><b>Division</b></label>
                    <select name='division_id'  class="form-control selectpicker" data-live-search="true" id="division_id">
                      <option value="all">ALL DIVISION</option>
                      <?php $divisions = mysqli_query($mysqli_con, "SELECT * FROM isd_class_division WHERE class_id='".$_GET['class_id']."'");
                      while($division = mysqli_fetch_assoc($divisions)) { ?>
                      <option value="<?php echo $division['class_division_id']; ?>" <?php echo ($_GET['division_id']==$division['class_division_id'])?'selected':''; ?>>
                        <?php echo $division['division_name']; ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" id="alloate_ajax"></div>


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

        <script>

        function fetch_certificates()
        {
            $('#alloate_ajax').html("<img src='<?php echo base_url('assets/images/ajax-loader.gif'); ?>' class='img-responsive'>");
            var ac_year = $('#academic_year').val();
            var class_id = $('#class_id').val();
            var division_id = $('#division_id').val();
            var url = "?pid=75&action=allocatedstudent_ajax&ac_year="+ac_year+"&class_id="+class_id+"&division_id="+division_id;
            $.get(url, function( data ) {
              $("#alloate_ajax").html(data);
            });
        }

        fetch_certificates();
        $(document).on('change', '#academic_year', fetch_certificates);
        $(document).on('change', '#class_id', fetch_certificates);
        $(document).on('change', '#division_id', fetch_certificates);

        $(document).on('change', '#class_id', function(){
            $('#sections').html("");
            var ac_year = $('#academic_year').val();
            var class_id = $('#class_id').val();
            var url = "ajax.php?action=divisions&q="+class_id;
            $.get(url, function( data ) {
              data = "<option selected value='all'>ALL DIVISION </option>" + data;
              $('#division_id').html(data);
              $('.selectpicker').selectpicker('refresh');
            });
        });
        </script>
    </body>
</html>