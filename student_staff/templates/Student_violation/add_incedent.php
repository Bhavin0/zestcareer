<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Add Student Violation</title>
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
                           <span class="title elipsis"><strong>Add Student Violation</strong></span>
                        </div>
                            <div class="panel-body">
                              <form action="" method="post" enctype="multipart/form-data">

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Academic Year</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="ac_year" required="required" name="data[academic_year_id]">
                                    <?php
                                    $academic_years = mysqli_query($mysqli_con, "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC");
                                    while($academic_year = mysqli_fetch_assoc($academic_years))
                                    {
                                        echo "<option value='".$academic_year['es_finance_masterid']."'>";
                                        echo date_format(date_create($academic_year['fi_ac_startdate']), 'd/m/Y')." - ".date_format(date_create($academic_year['fi_ac_enddate']), 'd/m/Y');
                                        echo "</option>";
                                    }
                                    ?>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Section</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="section_id" required="required">
                                        <option selected="" disabled=""> --SELECT SECTION--</option>
                                        <?php
                                        $sections = get_all_results('es_groups', 'es_grouporderby', 'ASC');
                                        foreach($sections as $section)
                                        {
                                        echo "<option value='".$section['es_groupsid']."'>";
                                        echo $section['es_groupname'];
                                        echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Class</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="es_classesid" required="required" name="data[es_classesid]">
                                        <option selected="" disabled="">--SELECT CLASS--</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Division</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="division_id" required="required" name="data[division_id]">
                                        <option selected="" disabled=""> --SELECT DIVISION--</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Student</b></label>
                                    <select class="form-control selectpicker" id="es_preadmissionid" required="required" name="data[es_preadmissionid]" data-live-search="true">
                                        <option selected="" disabled=""> --SELECT STUDENT--</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Violation Date</b></label>
                                    <input type="text" name="data[violation_date]" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker" readonly>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Violation Time</b></label>
                                    <input type="text" name="data[violation_time]" class="form-control" required="required">
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Violation Type</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" name="data[violation_type]" required="required">
                                    	<option value="DRESS-CODE VIOLATION">DRESS-CODE VIOLATION</option>
                                    	<option value="TARDINESS VIOLATION">TARDINESS VIOLATION</option>
                                    	<option value="ABSENTEE VIOLATION">ABSENTEE VIOLATION</option>
                                    	<option value="BAD BEHAVIOR VIOLATION">BAD BEHAVIOR VIOLATION</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Violation Level</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" name="data[violation_level]" required="required">
                                    	<option value="LEVEL 1">LEVEL 1 (LOW)</option>
                                    	<option value="LEVEL 2">LEVEL 2</option>
                                    	<option value="LEVEL 3">LEVEL 3 (HIGH)</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label><b>Violation Remarks</b></label>
                                    <textarea name="data[violation_remarks]" class="form-control" required="required"></textarea>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                	<label><b>Attachment (if any)</b></label>
                                    <div class="fancy-file-upload fancy-file-primary">
                      					<i class="fa fa-upload"></i>
                      					<input type="file" class="form-control" name="attachment" />
                      					<input type="text" class="form-control" placeholder="no file selected" readonly="" />
                      					<span class="button">Choose File</span>
                    				</div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="submit" name="insert" class="btn btn-primary pull-right" value="ADD INCEDENT">
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
        	$(document).on('change', '#section_id', function(){
        		$('#division_id').html("<option selected='' disabled=''> --SELECT DIVISION--</option>");
        		$('#es_preadmissionid').html("<option selected='' disabled=''> --SELECT STUDENT--</option>");
        		var section_id = $('#section_id').val();
        		var url = "ajax.php?action=classes&section_id="+section_id;
        		$.get(url, function( data ) {
        			data = "<option selected='' disabled=''>--SELECT CLASS--</option>" + data;
  					$('#es_classesid').html(data);
  					$('.selectpicker').selectpicker('refresh');
				});
        	});

        	$(document).on('change', '#es_classesid', function(){
        		$('#es_preadmissionid').html("<option selected='' disabled=''> --SELECT STUDENT--</option>");
        		var es_classesid = $('#es_classesid').val();
        		var url = "ajax.php?action=divisions&q="+es_classesid;
        		$.get(url, function( data ) {
        			data = "<option selected='' disabled=''> --SELECT DIVISION--</option>" + data;
  					$('#division_id').html(data);
  					$('.selectpicker').selectpicker('refresh');
				});
        	});

        	$(document).on('change', '#division_id', function(){
        		var division_id = $('#division_id').val();
        		var ac_year = $('#ac_year').val();
        		var url = "ajax.php?action=students&q="+division_id+"&ac_year="+ac_year;
        		$.get(url, function( data ) {
  					$('#es_preadmissionid').html(data);
  					$('.selectpicker').selectpicker('refresh');
				});
        	});
        </script>
    </body>
</html>