<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Examinations</title>
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
			            <span class="elipsis title"><strong>Examinations</strong></span>
		            </div>

		            <div class="panel-body">
		            	<form action="?pid=36&action=createxam_2" method="post">
								    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
									    <label><b>Academic Year</b></label>
									    <select name="pre_year" class="form-control selectpicker" id="ac_year" required="required" data-live-search="true">
									    <?php foreach($school_details_res as $each_record) { ?>
										    <option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==$pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record['fi_enddate']); ?>	</option>
									    <?php } ?>
									    </select>
								    </div>

								    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
									   <label><b>Select Section</b></label>
									   <?php $sql = mysql_query("SELECT * FROM es_groups"); ?>
									   <select class="form-control selectpicker" onchange="fetchclass(this.value)" name="section" required="required" data-live-search="true">
										    <option selected disabled >--SELECT SECTION--</option>
										    <?php while($row = mysql_fetch_assoc($sql)){ ?>
										    <option value="<?php echo $row['es_groupsid']; ?>"> <?php echo $row['es_groupname']; ?> </option>
									   <?php } ?>
									   </select>
								    </div>

								    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									   <label><b>Select Class</b></label>
									   <select class="form-control selectpicker" id="classes" onchange="fetchstudents(this.value)" name="class" required="required" data-live-search="true">
										    <option selected disabled >--SELECT CLASS--</option>
									   </select>
								    </div>

								    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									    <label><b>Select Semester</b></label>
										  <select class="form-control selectpicker" id="semesters" name="semesters[]" data-live-search="true" multiple="">
									    </select>
								    </div>

								    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
									    <label><b>Exam Type</b></label>
										  <select class="form-control selectpicker" id="exam_type" name="exam_type[]" required="required" data-live-search="true" multiple="">
										    <?php
										    $exams = mysqli_query($mysqli_con, "SELECT * FROM es_exam ORDER BY es_examordby");
										    while ($exam = mysqli_fetch_assoc($exams))
										    {
											    echo"<option value='".$exam['es_examid']."'>";
											    echo $exam['es_examname'];
											    echo"</option>";
										    }
										    ?>
									    </select>
								    </div>

								    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									    <input type="submit" name="create_exam" value="SUBMIT" class="btn btn-primary pull-right">
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

        <!-- Fetch Class -->
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
          classes.innerHTML = this.responseText;
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
          semesters.innerHTML = this.responseText;
          $('.selectpicker').selectpicker('refresh');
            }
        };
        xmlhttp.open("GET","ajax.php?action=semesters&q="+str+"&ac_year="+ac_year,true);
        xmlhttp.send();
    }
      </script>
      <!--End of Fetch Class-->

      <script type="text/javascript">
          $('#dd-12').addClass('active');
          $('#dd-11-4').addClass('active');
      </script>

    </body>
</html>