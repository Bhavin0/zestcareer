<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Yearly Report Cards</title>
    <meta name="description" content="" />
    <meta name="Author" content="" />
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
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
          <h1><i class="main-icon et-documents"></i> Report Cards</h1>
          <ol class="breadcrumb">
            <li><a href="?pid=44">Admin</a></li>
            <li><a href="?pid=36&action=examreport">Examinations</a></li>
            <li class="active">Report Cards</li>
          </ol>
        </header>

        <div id="content" class="dashboard" style="padding-top: 5px;">
				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					  <div class="panel panel-primary">
						  <div class="panel-body">
                <div class="row">
							    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
								    <input type="hidden" name="pid" value="21">
								    <input type="hidden" name="action" value="studentlist">
								    <label><b>Academic Year</b></label>
								    <select class="form-control" id="ac_year">
									  <?php
									    $ac_years = mysqli_query($mysqli_con, "SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC");
									    while($row = mysqli_fetch_assoc($ac_years)) {
										    $selected = ($row['es_finance_masterid']==$_GET['academic_year_id'])?'selected':'';
										    echo"<option value='".$row['es_finance_masterid']."' ".$selected."> ".date_format(date_create($row['fi_ac_startdate']), 'd/m/Y')." - ".date_format(date_create($row['fi_ac_enddate']), 'd/m/Y')." </option>";
									    } ?>
								    </select>
							    </div>

							    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
								    <label><b>Classes</b></label>
								    <select class="form-control" id="class_id">
									  <?php
									    $classses = mysqli_query($mysqli_con, "SELECT * FROM es_classes ORDER BY es_orderby");
									    while($row = mysqli_fetch_assoc($classses))
									    {
                        $selected = ($row['es_classesid']==$_GET['es_classesid'])?'selected':'';
										    echo"<option value='".$row['es_classesid']."' ".$selected."> ".$row['es_classname']." </option>";
									    }
									  ?>
				  				  </select>
				  			  </div>

                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                    <label><b>Semester</b></label>
                    <select class="form-control" id="semester_id">
                    </select>
                  </div>
                </div>
                <div class="row">
				  			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" id="studentlist" align="center">
				  			  </div>
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
    <script>
      function fetch_detail()
      {
        $('#studentlist').html("<img src='<?php echo base_url('assets/images/ajax-loader.gif'); ?>' class='img-responsive'>");
        var ac_year = $('#ac_year').val();
        var class_id = $('#class_id').val();
        var sem = $('#semester_id').val();
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
          }
        };
        xmlhttp.open("GET","ajax.php?action=semesters_classwise&q="+class_id+"&ac_year="+ac_year,true);
        xmlhttp.send();

        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("studentlist").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET","?pid=36&action=yearly_report_cards_ajax&ac_year="+ac_year+"&class_id="+class_id+"&semester="+sem,true);
        xmlhttp.send();
      }

      $(document).on('change', '#ac_year', fetch_detail);
      $(document).on('change', '#class_id', fetch_detail);
      fetch_detail();
    </script>
  </body>
</html>