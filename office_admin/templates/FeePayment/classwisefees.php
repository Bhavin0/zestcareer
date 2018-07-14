<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Class Wise Fees Status</title>
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
                  <span class="elipsis title"><strong>Class Wise Fees Status</strong></span>
                </div>

                <div class="panel-body">
                  <input type="hidden" name="pid" value="40">
                  <input type="hidden" name="action" value="classwisefees">
                 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                  <label><b>Academic Year</b></label>
                  <select name="pre_year" class="form-control selectpicker" data-live-search="true" id="ac_year">
                    <option selected disabled >--SELECT ACADEMIC YEAR--</option>
                  <?php  
                  foreach($school_details_res as $each_record) { ?>
                    <option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==$pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record['fi_enddate']); ?> </option>
                  <?php } ?>
                  </select>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Section</b></label>
                  <?php $sql = mysql_query("SELECT * FROM es_groups"); ?>
                  <select class="form-control selectpicker" data-live-search="true" name="section" id="section_id">
                    <option value="all">ALL SECTION</option>
                    <?php while($row = mysql_fetch_assoc($sql)){ ?>
                    <option value="<?php echo $row['es_groupsid']; ?>"> <?php echo $row['es_groupname']; ?> </option>
                  <?php } ?>
                  </select>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Class</b></label>
                  <select class="form-control selectpicker" data-live-search="true" id="class_id" name="class">
                    <option value="all">ALL CLASSES</option>
                  </select>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Division</b></label>
                  <select class="form-control selectpicker" data-live-search="true" id="division_id" name="division">
                    <option value="all">ALL DIVISION</option>
                  </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Student</b></label>
                  <select class="form-control selectpicker" data-live-search="true" id="student_id" name="student_id">
                    <option value="all">ALL STUDENTS</option>
                  </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Semester</b></label>
                  <select class="form-control selectpicker" data-live-search="true" id="semesters" name="semesters">
                    <option value="all">ALL SEMESTERS</option>
                  </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Status</b></label>
                  <select class="form-control selectpicker" data-live-search="true" id="status" name="status">
                    <option value="all">ALL FEES</option>
                    <option value="paid">PAID FEES</option>
                    <option value="unpaid">UNPAID FEES</option>
                  </select>
                </div>

                <div class="col-lg-12 col-md-4 col-sm-12 col-xs-12">
                  <button type="button" class="btn btn-warning pull-right" id="print-report"><i class="fa fa-file-pdf-o"></i> PRINT</button>
                </div>



                  <div id="detail" class="col-md-12">
                  </div>
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
        //ON ACADEMIC YEAR CHANGE
        $(document).on('change', '#ac_year', function(){
          $('#section_id').val('all');
          $('#class_id').html("<option value='all'>ALL CLASSES</option>");
          $('#division_id').html("<option value='all'>ALL DIVISION</option>");
          $('#student_id').html("<option value='all'>ALL STUDENT</option>");
          $('#semesters').html("<option value='NULL'>ALL SEMESTER</option>");
          $('.selectpicker').selectpicker('refresh');
        });

        //ON SECTION CHANGE
        $(document).on('change', '#section_id', function(){
          $('#class_id').html("<option value='all'>ALL CLASSES</option>");
          $('#division_id').html("<option value='all'>ALL DIVISION</option>");
          $('#student_id').html("<option value='all'>ALL STUDENT</option>");
          $('#semesters').html("<option value='NULL'>ALL SEMESTER</option>");
          $('.selectpicker').selectpicker('refresh');

          var ac_year = $('#ac_year').val();
          var section_id = $(this).val();

          //FETCH CLASSES
          var classes_url = "ajax.php?action=classes&q="+section_id;
          $.get(classes_url, function( data ) {
            data = "<option value='all'>ALL CLASSES</option>" + data;
            $('#class_id').html(data);
            $('.selectpicker').selectpicker('refresh');
          });

          //FETCH SEMESTER
          var semester_url = "ajax.php?action=semesters&q="+section_id+"&ac_year="+ac_year;
          $.get(semester_url, function( data ) {
            data = "<option value='NULL'>ALL SEMESTER</option>" + data;
            $('#semesters').html(data);
            $('.selectpicker').selectpicker('refresh');
          });
        });

        //ON CLASS CHANGE
        $(document).on('change', '#class_id', function(){
          $('#division_id').html("<option value='all'>ALL DIVISION</option>");
          $('#student_id').html("<option value='all'>ALL STUDENT</option>");
          $('.selectpicker').selectpicker('refresh');

          var class_id = $(this).val();
          if(class_id != 'all')
          {
              var url = "ajax.php?action=divisions&q="+class_id;
              $.get(url, function( data ) {
                data = "<option value='all'>ALL DIVISION</option>" + data;
                $('#division_id').html(data);
                $('.selectpicker').selectpicker('refresh');
              });
          }
          
        });

        //ON DIVISION CHANGE
        $(document).on('change', '#division_id', function(){
          $('#student_id').html("<option value='all'>ALL STUDENT</option>");
          $('.selectpicker').selectpicker('refresh');

          var ac_year = $('#ac_year').val();
          var division_id = $(this).val();
          if(class_id != 'all')
          {
              var url = "ajax.php?action=students&q="+division_id+"&ac_year="+ac_year;
              $.get(url, function( data ) {
                data = "<option value='all'>ALL STUDENT</option>" + data;
                $('#student_id').html(data);
                $('.selectpicker').selectpicker('refresh');
              });
          }
          
        });
      </script>

      <script>
        function fetch_data()
        {
          $('#detail').html("<div align='center'><img src='<?php echo base_url('assets/images/ajax-loader.gif'); ?>' class='img-responsive'></div>");

          var ac_year = $('#ac_year').val();
          var section_id = $('#section_id').val();
          var class_id = $('#class_id').val();
          var division_id = $('#division_id').val();
          var student_id = $('#student_id').val();
          var semester = $('#semesters').val();
          var status = $('#status').val();

          var url = "?pid=40&action=classwisefees_ajax&ac_id="+ac_year+"&section_id="+section_id+"&class_id="+class_id+"&division_id="+division_id+"&student_id="+student_id+"&semeser_id="+semester+"&status="+status;
          $.get(url, function( data ) {
            $('#detail').html(data);
          });
        }

        $(document).on('change', '#ac_year', fetch_data);
        $(document).on('change', '#section_id', fetch_data);
        $(document).on('change', '#class_id', fetch_data); 
        $(document).on('change', '#division_id', fetch_data); 
        $(document).on('change', '#student_id', fetch_data);  
        $(document).on('change', '#semesters', fetch_data);
        $(document).on('change', '#status', fetch_data);
      </script>

    <script type="text/javascript">
      $(document).on('click', '#print-report', function(){
        var ac_year = $('#ac_year').val();
          var section_id = $('#section_id').val();
          var class_id = $('#class_id').val();
          var division_id = $('#division_id').val();
          var student_id = $('#student_id').val();
          var semester = $('#semesters').val();
          var status = $('#status').val();

        var url = "<?php echo base_url('office_admin'); ?>?pid=40&action=classwisefees_print&ac_id="+ac_year+"&section_id="+section_id+"&class_id="+class_id+"&division_id="+division_id+"&student_id="+student_id+"&semeser_id="+semester+"&status="+status;

         window.open(url, '_blank')
      });
    </script>
        <script type="text/javascript">
          $('#dd-11').addClass('active');
          $('#dd-11-7').addClass('active');
        </script>
  </body>
</html>