<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Edit Student Violation</title>
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

                <?php
                    $report = mysqli_query($mysqli_con, "SELECT `student_violation`.*, `es_groups`.`es_groupsid` FROM  `student_violation` INNER JOIN `es_classes` ON `es_classes`.es_classesid = `student_violation`.`es_classesid` INNER JOIN `es_groups` ON `es_classes`.es_groupid = `es_groups`.`es_groupsid`  WHERE `student_violationid` = ".$_GET['student_violationid']);
                    $report_detail = mysqli_fetch_array($report);
                ?>

                <div id="content" class="dashboard" style="padding-top: 5px;">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                           <span class="title elipsis"><strong>Edit Student Violation</strong></span>
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
                                        $selected = ($report_detail['academic_year_id'] == $academic_year['es_finance_masterid'])?'selected':'';
                                        echo "<option value='".$academic_year['es_finance_masterid']."' ".$selected.">";
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
                                            $selected = ($report_detail['es_groupsid']==$section['es_groupsid'])?'selected':'';
                                        echo "<option value='".$section['es_groupsid']."' ".$selected.">";
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
                                        <?php
                                        $classes = get_all_results('es_classes', 'es_orderby', 'ASC', array('es_groupid' => $report_detail['es_groupsid']));
                                        foreach($classes as $class)
                                        {
                                            $selected = ($report_detail['es_classesid']==$class['es_classesid'])?'selected':'';
                                        echo "<option value='".$class['es_classesid']."' ".$selected.">";
                                        echo $class['es_classname'];
                                        echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Division</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="division_id" required="required" name="data[division_id]">
                                        <option selected="" disabled=""> --SELECT DIVISION--</option>
                                        <?php
                                        $divisions = get_all_results('isd_class_division', 'division_name', 'ASC', array('class_id' => $report_detail['es_classesid']));
                                        foreach($divisions as $division)
                                        {
                                            $selected = ($report_detail['division_id']==$division['class_division_id'])?'selected':'';
                                        echo "<option value='".$division['class_division_id']."' ".$selected.">";
                                        echo $division['division_name'];
                                        echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Student</b></label>
                                    <select class="form-control selectpicker" id="es_preadmissionid" required="required" name="data[es_preadmissionid]" data-live-search="true">
                                        <option selected="" disabled=""> --SELECT STUDENT--</option>
                                        <?php
                                        $students = mysqli_query($mysqli_con, "SELECT es_preadmission_details.*,es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission.pre_status FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE (es_preadmission_details.division_id=".$report_detail['division_id']." AND academic_year_id=".$report_detail['academic_year_id']." AND es_preadmission.pre_status='active') OR es_preadmission.es_preadmissionid = ".$report_detail['es_preadmissionid']."  ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name");

                                        while($student = mysqli_fetch_assoc($students))
                                        {
                                            $selected = ($report_detail['es_preadmissionid']==$student['es_preadmissionid'])?'selected':'';
                                            echo "<option value='".$student['es_preadmissionid']."' ".$selected.">";
                                            echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname'];
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Violation Date</b></label>
                                    <input type="text" name="data[violation_date]" value="<?php echo $report_detail['violation_date']; ?>" class="form-control datepicker" readonly>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Violation Time</b></label>
                                    <input type="text" name="data[violation_time]" class="form-control" value="<?php echo $report_detail['violation_time']; ?>" required="required">
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Violation Type</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" name="data[violation_type]" required="required">
                                    	<option <?php echo ($report_detail['violation_type']=='')?'selected':'DRESS-CODE VIOLATION'; ?> value="DRESS-CODE VIOLATION">DRESS-CODE VIOLATION</option>
                                    	<option <?php echo ($report_detail['violation_type']=='')?'selected':'TARDINESS VIOLATION'; ?> value="TARDINESS VIOLATION">TARDINESS VIOLATION</option>
                                    	<option <?php echo ($report_detail['violation_type']=='')?'selected':'ABSENTEE VIOLATION'; ?> value="ABSENTEE VIOLATION">ABSENTEE VIOLATION</option>
                                    	<option <?php echo ($report_detail['violation_type']=='')?'selected':'BAD BEHAVIOR VIOLATION'; ?> value="BAD BEHAVIOR VIOLATION">BAD BEHAVIOR VIOLATION</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                    <label><b>Violation Level</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" name="data[violation_level]" required="required">
                                    	<option <?php echo ($report_detail['violation_level']=='')?'selected':'LEVEL 1'; ?> value="LEVEL 1">LEVEL 1 (LOW)</option>
                                    	<option <?php echo ($report_detail['violation_level']=='')?'selected':'LEVEL 2'; ?> value="LEVEL 2">LEVEL 2</option>
                                    	<option <?php echo ($report_detail['violation_level']=='')?'selected':'LEVEL 3'; ?> value="LEVEL 3">LEVEL 3 (HIGH)</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label><b>Violation Remarks</b></label>
                                    <textarea name="data[violation_remarks]" class="form-control" required="required"><?php echo $report_detail['violation_remarks']; ?></textarea>
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

                                <input type="hidden" name="old_attachment" value="<?php echo $report_detail['violation_file']; ?>">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="submit" name="update" class="btn btn-primary pull-right" value="UPDATE INCEDENT">
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