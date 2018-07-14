<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>EDIT STAFF PLANNER</title>
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
            <?php
            $plan = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT `teacher_planner`.* FROM `teacher_planner` WHERE teacher_plannerid=".$_GET['plan_id']), MYSQLI_ASSOC) or die(MYSQLI_ERROR($mysqli_con));

            $tasks = mysqli_query($mysqli_con, "SELECT * FROM `teacher_planner_descriptions` WHERE teacher_planner_id=".$_GET['plan_id']);

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
	                           <span class="title elipsis"><strong>Edit Staff planner</strong></span>
	                        </div>
	                        <div class="panel-body">
	                        	<form action="" method="post" enctype="multipart/form-data">
	                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
	                                    <label><b>Academic Year</b></label>
	                                    <select class="form-control selectpicker" id="ac_year" required="required" name="data[academic_year_id]">
	                                    <?php
	                                    $academic_years = mysqli_query($mysqli_con, "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC");
	                                    while($academic_year = mysqli_fetch_assoc($academic_years))
	                                    {
	                                    	$selected = ($academic_year['es_finance_masterid']==$plan['academic_year_id'])?'selected':'';
	                                        echo "<option value='".$academic_year['es_finance_masterid']."' ".$selected.">";
	                                        echo date_format(date_create($academic_year['fi_ac_startdate']), 'd/m/Y')." - ".date_format(date_create($academic_year['fi_ac_enddate']), 'd/m/Y');
	                                        echo "</option>";
	                                    }
	                                    ?>
	                                    </select>
	                                </div>

	                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
	                                    <label><b>Class</b></label>
	                                    <select class="form-control selectpicker" id="class_id" required="required" name="data[class_id]">
	                                        <option selected="" disabled="">SELECT CLASS</option>
	                                        <?php
	                                        $classes = mysqli_query($mysqli_con, "SELECT * FROM es_classes ORDER BY es_orderby");
	                                        while($class = mysqli_fetch_assoc($classes))
	                                        {
	                                        	$selected = ($class['es_classesid']==$plan['class_id'])?'selected':'';
		                                        echo "<option value='".$class['es_classesid']."' ".$selected.">";
		                                        echo $class['es_classname'];
		                                        echo "</option>";
	                                        }
	                                        ?>
	                                    </select>
	                                </div>

	                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
	                                    <label><b>Division</b></label>
	                                    <select class="form-control selectpicker" id="division_id" required="required" name="data[division_id]">
	                                        <option selected="" disabled="">SELECT DIVISION</option>

	                                        <?php
	                                        $divisions = get_all_results('isd_class_division', $order_by = '', $order ='', array('class_id' => $plan['class_id']));
	                                        foreach($divisions as $division)
	                                        {
	                                        	$selected = ($division['class_division_id']==$plan['division_id'])?'selected':'';
		                                        echo "<option value='".$division['class_division_id']."' ".$selected.">";
		                                        echo $division['division_name'];
		                                        echo "</option>";
	                                        }
	                                        ?>
	                                    </select>
	                                </div>

	                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
	                                    <label><b>Subject</b></label>
	                                    <select class="form-control selectpicker" id="subjet_id" required="required" name="data[subject_id]">
	                                        <option selected="" disabled="">SELECT SUBJECT</option>
	                                        <?php
	                                        $subjects = get_all_results('es_subject', $order_by = '', $order ='', array('es_subjectid' => $plan['subject_id']));
	                                        foreach($subjects as $subject)
	                                        {
	                                        	$selected = ($subject['es_subjectid']==$plan['subject_id'])?'selected':'';
		                                        echo "<option value='".$subject['es_subjectid']."' ".$selected.">";
		                                        echo $subject['es_subjectname'];
		                                        echo "</option>";
	                                        }
	                                        ?>
	                                    </select>
	                                </div>

	                               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
                                    <label><b>Teacher</b></label>
                                    <select class="form-control selectpicker" data-live-search="true" required="required" name="data[teacher_id]" >
                                        <option selected="" disabled=""> --SELECT TEACHER--</option>
                                        <?php
                                       $teachers = mysqli_query($mysqli_con, "SELECT * FROM `es_staff` ORDER BY st_firstname,st_lastname");
                                        while($teacher = mysqli_fetch_assoc($teachers))
                                        {
                                        	$selected = ($plan['teacher_id'] == $teacher['es_staffid'])?'selected':'';
	                                        echo "<option value='".$teacher['es_staffid']."' ".$selected.">";
	                                        echo strtoupper($teacher['st_firstname']." ".$teacher['st_lastname']);
	                                        echo "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="15%">From</th>
												<th width="15%">To</th>
												<th>Tasks</th>
												<th width="11%">Action</th>
											</tr>
										</thead>
										<tbody id="top-div">
											<?php while($task = mysqli_fetch_assoc($tasks)) { ?>
											<tr>
												<td>
													<input name="from_date[]" type="text" class="form-control datepicker masked from_date" value="<?php echo $task['from_date']; ?>" required="required" />
												</td>
												<td>
													<input name="to_date[]" type="text" class="form-control datepicker masked to_date" value="<?php echo $task['to_date']; ?>" required="required" />
												</td>
												
												<td>
													<input name="plan_description[]" type="text" class="form-control" required="required" value="<?php echo $task['plan_description']; ?>" />
													<input type="hidden" name="task_status[]" value="<?php echo $task['task_status']; ?>">
													<input type="hidden" name="task_completion_date[]" value="<?php echo ($task['task_completion_date'] != null)?$task['task_completion_date']:'NULL'; ?>">
												</td>
												<td>
													<button type="button" class="btn btn-success btn-sm add_row">
														<i class="fa fa-plus"></i>
													</button>
													<button type="button" class="btn btn-danger btn-sm remove_row">
														<i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
										<label><b>REMARKS</b></label>
										<textarea name="data[planner_remarks]" class="form-control"></textarea>
									</div>

	                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
	                                	<button type="submit" class="btn btn-primary pull-right" name="edit_plan" value="submit">
	                                		ADD PLAN
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
    		
		$(document).on('click', '.add_row', function(){
			var next_date = $(this).closest('tr').find('.to_date').val();
			$('<tr>'+
				'<td>'+
					'<input name="from_date[]" type="text" class="form-control datepicker masked from_date" value="'+next_date+'" required="required" />'+
				'</td>'+
				'<td>'+
					'<input name="to_date[]" type="text" class="form-control datepicker masked to_date" value="'+next_date+'" required="required" />'+
				'</td>'+						
				'<td>'+
					'<input name="plan_description[]" type="text" class="form-control" required="required" />'+
					'<input type="hidden" name="task_status[]" value="pending">'+
					'<input type="hidden" name="task_completion_date[]" value="null">'+
				'</td>'+
				'<td>'+
				'<button type="button" class="btn btn-success btn-sm add_row">'+
					'<i class="fa fa-plus"></i>'+
				'</button>'+
				'<button type="button" class="btn btn-danger btn-sm remove_row">'+
					'<i class="fa fa-trash"></i>'+
				'</button>'+
				'</td>'+
			'</tr>').insertAfter($(this).closest('tr'));
			$('.masked').mask('9999-99-99', {reverse: true, "placeholder" : "XXXX-XX-XX"});
		});

		$(document).on('click', '.remove_row', function(){
			$(this).closest('tr').remove();
		});
		</script>

    <script>
      $(document).ready(function() {
        $(document).on("focus", ".datepicker", function(){
          $(this).datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
          });
        });
      });
    </script>
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