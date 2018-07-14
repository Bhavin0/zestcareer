<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Edit Material</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    
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

                            <?php 
                            $material_qry = mysqli_query($mysqli_con, "SELECT `es_studymaterial`.*, `es_classes`.`es_classname`, `es_subject`.`es_subjectname` FROM `es_studymaterial` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_studymaterial`.`sm_class_id` INNER JOIN `es_subject` ON `es_subject`.`es_subjectid` = `es_studymaterial`.`sm_subject_id` WHERE `es_studymaterial`.`status`='active' AND `es_studymaterial`.`es_studymaterialid`=".$_GET['studymaterialid']) or die(MYSQLI_ERROR($mysqli_con));
                                $material = mysqli_fetch_array($material_qry);

                             $subjects = get_all_results('es_subject', '', '', $where = array('es_subjectshortname' => $material['sm_class_id']));

                             
                            ?>
                        </li>
                    </ol>
                </header>

                <div id="content" class="dashboard" style="padding-top: 5px;">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     	<div class="panel panel-primary">
	                        <div class="panel-heading">
	                           <span class="title elipsis"><strong>Edit material</strong></span>
	                        </div>
	                        <div class="panel-body">
	                        	<form action="" method="post" enctype="multipart/form-data">
	                                

	                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
	                                    <label><b>Class</b></label>
	                                    <select class="form-control selectpicker" id="class_id" required="required" name="data[sm_class_id]">
	                                        <option selected="" disabled=""> --SELECT CLASS--</option>
	                                        <?php
	                                        $classes = mysqli_query($mysqli_con, "SELECT * FROM es_classes ORDER BY es_orderby");
	                                        while($class = mysqli_fetch_assoc($classes))
	                                        {
	                                        $selected = ($class['es_classesid']==$material['sm_class_id'])?'selected':'';
	                                        echo "<option value='".$class['es_classesid']."' ".$selected.">";
	                                        echo $class['es_classname'];
	                                        echo "</option>";
	                                        }
	                                        ?>
	                                    </select>
	                                </div>

	                                

	                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
	                                    <label><b>Subject</b></label>
	                                    <select class="form-control selectpicker" id="subjet_id" required="required" name="data[sm_subject_id]">
	                                        <option selected="" disabled=""> --SELECT SUBJECT--</option>
	                                        <?php foreach($subjects as $subject) {
	                                        $selected = ($material['sm_subject_id'] == $subject['es_subjectid'])?'selected':'';
	                                        ?>
	                                        <option value="<?php echo $subject['es_subjectid']; ?>" <?php echo $selected; ?>>
	                                        	<?php echo $subject['es_subjectname']; ?>
	                                        </option>
	                                        <?php
	                                        } ?>
	                                    </select>
	                                </div>

	                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
	                                	<label><b>Material Title</b></label>
	                                	<input type="text" name="data[sm_name]" class="form-control" required="required" value="<?php echo $material['sm_name']; ?>">
	                                </div>

	                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
	                                    <label><b>Assignment Date</b></label>
	                                    <input type="text" name="data[sm_createdon]" value="<?php echo $material['sm_createdon']; ?>" class="form-control datepicker masked" required="required">
	                                </div>

	                                

	                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
	                                	<label><b>Material Description</b></label>
	                                	<textarea class="summernote form-control" name=data[sm_description] data-height="200" data-lang="en-US"><?php echo $material['sm_description']; ?></textarea>
	                                </div>

	                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
	                                	<label><b>Attachment (Optional)</b></label>
	                                	<div class="fancy-file-upload">
											<i class="fa fa-upload"></i>
											<input type="file" class="form-control" name="attachment" onchange="jQuery(this).next('input').val(this.value);" />
											<input type="text" class="form-control" placeholder="no file selected" readonly="" />
											<span class="button">Choose File</span>
										</div>
	                                </div>

	                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
	                                	<button type="submit" class="btn btn-primary pull-right" name="edit_material" value="submit">
	                                		ADD MATERIAL
	                                	</button>
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
    		$(document).on('change', '#class_id', function(){
    			var class_id = $(this).val();

    			$('#subjet_id').html('<option selected disabled>LOADING SUBJECTS</option>');
    			$('#division_id').html('<option selected disabled>LOADING DIVISIONS</option>');
    			$('.selectpicker').selectpicker('refresh');
    			$.get("ajax.php?action=subjects&q="+class_id, function(data){
    				data = '<option selected disabled>SELECT SUBJECT</option>' + data;
        			$('#subjet_id').html(data);
        			$('.selectpicker').selectpicker('refresh');
    			});

    			$.get("ajax.php?action=divisions&q="+class_id, function(data){
    				data = '<option selected disabled>SELECT DIVISION</option>' + data;
        			$('#division_id').html(data);
        			$('.selectpicker').selectpicker('refresh');
    			});
    		});
    	</script>
    </body>
</html>