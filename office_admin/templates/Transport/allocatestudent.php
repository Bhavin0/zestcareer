<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Allote Student To Pick-Up Point</title>
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
          <div class="panel panel-primary">
            <div class="panel-heading">
              <span class="elipsis title"><strong>ALLOTE STUDENT TO PICK-UP POINT</strong></span>
            </div>

            <div class="panel-body">
              <form action="" method="post">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                  <label><b>Academic Year</b></label>
                  <select name="data[acdemic_year_id]" class="form-control selectpicker" data-live-search="true" id="ac_year" required="">
                  <option selected disabled >--SELECT ACADEMIC YEAR--</option>
                  <?php  
                  $ac_years = mysqli_query($mysqli_con, "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC");
                  while($ac_year = mysqli_fetch_assoc($ac_years)) { ?>
                    <option value="<?php echo $ac_year['es_finance_masterid']; ?>">
                      <?php echo displaydate($ac_year['fi_startdate'])." To ".displaydate($ac_year['fi_enddate']); ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Section</b></label>
                  <?php $sql = mysql_query("SELECT * FROM es_groups"); ?>
                  <select class="form-control selectpicker" data-live-search="true" onchange="fetchclass(this.value)" name="section" id="section_id" required="">
                    <option selected disabled >--SELECT SECTION--</option>
                    <?php while($row = mysql_fetch_assoc($sql)){ ?>
                    <option value="<?php echo $row['es_groupsid']; ?>"> <?php echo $row['es_groupname']; ?> </option>
                  <?php } ?>
                  </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Class</b></label>
                  <select class="form-control selectpicker" data-live-search="true" id="classes" onchange="fetchdivision(this.value)" name="class" required="">
                    <option selected disabled >--SELECT CLASS--</option>
                  </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Division</b></label>
                  <select class="form-control selectpicker" data-live-search="true" id="divisions" name="division" onchange="fetchstudents(this.value)" required="">
                    <option selected disabled >--SELECT DIVISION--</option>
                  </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Student</b></label>
                  <select class="form-control selectpicker" data-live-search="true" id="students" name="data[student_id]" required="">
                  <option selected disabled >--SELECT STUDENT--</option>
                  <?php if(isset($studetails['es_preadmissionid'])) {
                  echo "<option value='".$studetails['es_preadmissionid']."'>".$studetails['es_preadmissionid']."</option>";
                    } ?>
                  </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                  <label><b>Pick-Up Point</b></label>
                  <select class="form-control selectpicker" data-live-search="true" name="data[pickup_point_id]" required="required" required="" id="pickup_points">
                    <option selected disabled >--SELECT PICKUP POINT--</option>
                  </select>
                </div>

                <input type="submit" name="allocatestudent" value="allocate" class="btn btn-primary pull-right">
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

    <script>
    $(document).on('change', '#ac_year', function(){
      $('#section_id').html('<option selected disabled >--SELECT SECTION--</option><?php mysql_data_seek($sql, 0); while($row = mysql_fetch_assoc($sql)){ ?><option value="<?php echo $row['es_groupsid']; ?>"> <?php echo $row['es_groupname']; ?> </option><?php } ?>');
      $('#classes').html('<option selected disabled >--SELECT CLASS--</option>');
      $('#divisions').html('<option selected disabled >--SELECT DIVISION--</option>');
      $('#students').html('<option selected disabled >--SELECT STUDENT--</option>');
      $('#pickup_points').html('<option selected disabled >LOADING PICKUP POINTS</option>');
      $('.selectpicker').selectpicker('refresh');

      var ac_year = $(this).val();
      var pickup_point_url = "ajax.php?action=pickup_points&q="+ac_year;
      $.get(pickup_point_url, function( data ) {
        data = "<option selected disabled>SELECT PICKUP-POINT</option>" + data;
          $('#pickup_points').html(data);
          $('.selectpicker').selectpicker('refresh');
      });

    });

    $(document).on('change', '#section_id', function(){
      var ac_year = $('#ac_year').val();
      var str = $(this).val();

      $('#divisions').html('<option selected disabled >--SELECT DIVISION--</option>');
      $('#students').html('<option selected disabled >--SELECT STUDENT--</option>');

      var class_url = "ajax.php?action=classes&q="+str;
      $.get(class_url, function( data ) {
        data = "<option selected='selected'>--SELECT CLASS--</option>" + data;
          $('#classes').html(data);
          $('.selectpicker').selectpicker('refresh');
      });

      var sem_url = "ajax.php?action=semesters&q="+str+"&ac_year="+ac_year;
      $.get(sem_url, function( data ) {
        data = "<option value='NULL'>ALL SEMESTER</option>" + data;
          $('#semesters').html(data);
          $('.selectpicker').selectpicker('refresh');
      });

    });

    $(document).on('change', '#classes', function(){
      $('#students').html('<option selected disabled >--SELECT STUDENT--</option>');
      var str = $(this).val();
      var url = "ajax.php?action=divisions&q="+str;
      $.get(url, function( data ) {
        data = "<option selected disabled> --SELECT DIVISION-- </option>" + data;
          $('#divisions').html(data);
          $('.selectpicker').selectpicker('refresh');
      });
    });

    $(document).on('change', '#divisions', function(){
      var ac_year = $('#ac_year').val();
      var str = $(this).val();
      var url = "ajax.php?action=transport_students&q="+str+"&ac_year="+ac_year;
      $.get(url, function( data ) {
          $('#students').html(data);
          $('.selectpicker').selectpicker('refresh');
      });
    });
    </script>
  </body>
</html>