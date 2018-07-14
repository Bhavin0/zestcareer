<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Student Fees Slip</title>
    <meta name="description" content="" />
    <meta name="Author" content="" />

    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <!-- WEB FONTS -->
    <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

    <!-- CORE CSS -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
    <!-- THEME CSS -->
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
        <!-- PANEL START -->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <span class="title elipsis">
                  <strong>Student Fees Slip</strong>
                </span>
              </div>

              <div class="panel-body">
                <form method="post" action="?pid=17&action=fee_card_generate" name="fetchstudent">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                    <label><b>Academic Year</b></label>
                    <select name="pre_year" class="form-control selectpicker" data-live-search="true" id="ac_year" required="required">
                    <?php foreach($school_details_res as $each_record) { ?>
                      <option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==$pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record['fi_enddate']); ?> </option>
                        <?php } ?>
                    </select>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                    <label><b>Select Section</b></label>
                    <?php $sql = mysql_query("SELECT * FROM es_groups"); ?>
                    <select  class="form-control selectpicker" data-live-search="true" onchange="fetchclass(this.value)" name="section" required="required">
                      <option selected disabled >--SELECT SECTION--</option>
                      <?php while($row = mysql_fetch_assoc($sql)){ ?>
                      <option value="<?php echo $row['es_groupsid']; ?>"> <?php echo $row['es_groupname']; ?> </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                    <label><b>Select Class</b></label>
                    <select  class="form-control selectpicker" data-live-search="true" id="classes" onchange="fetchdivision(this.value)" name="class" required="required">
                      <option selected disabled >--SELECT CLASS--</option>
                    </select>
                  </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                  <label><b>Select Division</b></label>
                  <select  class="form-control selectpicker" data-live-search="true" id="divisions" name="division" onchange="fetchstudents(this.value)">
                    <option selected disabled >--SELECT DIVISION--</option>
                  </select>
                </div>

                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                    <label><b>Select Semester</b></label>
                    <select  class="form-control selectpicker" data-live-search="true" id="semesters" name="semesters" required="required">
                      <option selected disabled >--SELECT SEMESTER--</option>
                    </select>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                    <label><b>Select Student</b></label>
                    <select  class="form-control selectpicker" data-live-search="true" id="students" name="studentid" required="required">
                      <option selected disabled >--SELECT STUDENT--</option>
                      <?php if(isset($studetails['es_preadmissionid'])) {
                        echo "<option value='".$studetails['es_preadmissionid']."'>".$studetails['es_preadmissionid']."</option>";
                      } ?>
                    </select>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <input type="submit" name="getstudetails" value="Go" class="btn btn-primary pull-right"/>
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

    <script>
    function fetchclass(str) {
      var ac_year = $('#ac_year').val();
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var classes = document.getElementById('classes');
        classes.innerHTML = "<option selected='selected'>--SELECT CLASS--</option>";
        classes.innerHTML = classes.innerHTML + this.responseText;
        $('.selectpicker').selectpicker('refresh');
        }
      };
      xmlhttp.open("GET","ajax.php?action=classes&q="+str,true);
      xmlhttp.send();

      /* Fetch Semesters */
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var semesters = document.getElementById('semesters');
        semesters.innerHTML = "<option selected disabled >--SELECT SEMESTER--</option>";
        semesters.innerHTML = semesters.innerHTML + this.responseText;
        $('.selectpicker').selectpicker('refresh');
        }
      };
      xmlhttp.open("GET","ajax.php?action=semesters&q="+str+"&ac_year="+ac_year,true);
      xmlhttp.send();
    }
    </script>
    <script type="text/javascript">
  function fetchdivision(str)
  {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        var divisions = document.getElementById('divisions');
        divisions.innerHTML = "<option selected disabled> --SELECT DIVISION-- </option>";
      divisions.innerHTML = divisions.innerHTML + this.responseText;
      $('.selectpicker').selectpicker('refresh');
          }
      };
      xmlhttp.open("GET","ajax.php?action=divisions&q="+str,true);
      xmlhttp.send();
  }
</script>
<script>
  function fetchstudents(str)
  {
    //FETCH STUDENTS
    var ac_year = $('#ac_year').val();
      if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
      } else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var students = document.getElementById('students');
      students.innerHTML = this.responseText;
      $('.selectpicker').selectpicker('refresh');
          }
      };
      xmlhttp.open("GET","ajax.php?action=students&q="+str+"&ac_year="+ac_year,true);
      xmlhttp.send();
  }
</script>
    <script type="text/javascript">
      $('#dd-11').addClass('active');
      $('#dd-11-5').addClass('active');
    </script>
  </body>
</html>