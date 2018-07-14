<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Add New Bonafied Certificate</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
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
								<span class="title elipsis">
									<strong>Bonafied Certificate</strong>
								</span>
							</div>

							<div class="panel-body">
								<form action="" method="post">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
										<label><b>Academic Year</b></label>
										<select name="academic_year" id="academic_year" name="academic_year" class="form-control">
										<?php $academic_years = mysqli_query($mysqli_con, "SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC");
										while($academic_year = mysqli_fetch_assoc($academic_years))
										{
											echo"<option value='".$academic_year['es_finance_masterid']."'>
											".date_format(date_create($academic_year['fi_ac_startdate']), 'd/m/Y')." - 
											".date_format(date_create($academic_year['fi_ac_enddate']), 'd/m/Y')."
											</option>";
										}
										?>
										</select>
									</div>

									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
										<label><b>Class</b></label>
										<select name='es_classesid' class="form-control" id="es_classid" onchange="fetchstudents(this.value)">
											<option>--SELECT CLASS--</option>
										<?php $classes = mysqli_query($mysqli_con, "SELECT * FROM es_classes ORDER BY es_orderby");
										while($class = mysqli_fetch_assoc($classes))
										{
											echo"<option value='".$class['es_classesid']."'>
											".$class['es_classname']."
											</option>";
										}
										?>
            							</select>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Student ID<font color="#FF0000">&nbsp;*</font></b></label>
										<select name='es_studentid' class="form-control" id="student_id" onchange="student_detail(this.value)">
											<option selected="selected" disabled="disabled">--SELECT STUDENT--</option>
            							</select>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Student Name<font color="#FF0000">&nbsp;*</font></b></label>
										<input type="text" name="student_name" id="student_name" class="form-control">
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Father Name<font color="#FF0000">&nbsp;*</font></b></label>
										<input type="text" name="father_name" id="father_name" class="form-control">
									</div>

									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
										<label><b>Date Of Birth<font color="#FF0000">&nbsp;*</font></b></label>
										<input name="dob" type="text" id="dob" readonly="readonly"  class="form-control datepicker" />
									</div>

									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
										<label><b>Place of Birth<font color="#FF0000">&nbsp;*</font></b></label>
										<input type="text" name="place_of_birth" id="place_of_birth" class="form-control">
									</div>

									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
										<label><b>Caste<font color="#FF0000">&nbsp;*</font></b></label>
										<input type="text" name="caste" id="caste" class="form-control">
									</div>

									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
										<label><b>GR No.<font color="#FF0000">&nbsp;*</font></b></label>
										<input type="text" name="grno" id="grno" class="form-control">
									</div>

									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
										<label><b>Passed Standard<font color="#FF0000">&nbsp;*</font></b></label>
										<input type="text" name="passed_standard" id="passed_standard" class="form-control">
									</div>

									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
										<label><b>Trials<font color="#FF0000">&nbsp;*</font></b></label>
										<input type="text" name="trials" id="trials" class="form-control">
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Progress</b></label>
										<input type="text" name="progress" id="progress" class="form-control">
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
										<label><b>Conduct</b></label>
										<input type="text" name="conduct" id="conduct" class="form-control">
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
										<button type="submit" name="submit_from" value="submit" class="btn btn-primary pull-right">
											SUBMIT
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
      	<script>
			function fetchstudents(str)
			{
				var ac_year = $('#academic_year').val();
    			if (window.XMLHttpRequest) {
    			xmlhttp = new XMLHttpRequest();
    			} else {
    			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    			}
    			xmlhttp.onreadystatechange = function() {
    				if (this.readyState == 4 && this.status == 200) {
    					var students = document.getElementById('student_id');
    					students.innerHTML = "<option> --SELECT STUDENT-- </option>"
						students.innerHTML = students.innerHTML + this.responseText;
        			}
    			};
    			xmlhttp.open("GET","ajax.php?action=students&q="+str+"&ac_year="+ac_year,true);
    			xmlhttp.send();
			}

			function student_detail(str)
			{
    			if (window.XMLHttpRequest) {
    			xmlhttp = new XMLHttpRequest();
    			} else {
    			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    			}
    			xmlhttp.onreadystatechange = function() {
    				if (this.readyState == 4 && this.status == 200) {
    					var student = JSON.parse(this.responseText);
    					$('#student_name').val(student.pre_name+" "+student.middle_name+" "+student.pre_lastname);
    					$('#father_name').val(student.pre_fathername);
    					$('#dob').val(student.pre_dateofbirth);
    					$('#place_of_birth').val(student.pre_placeofbirth);
    					$('#caste').val(student.caste);
    					$('#grno').val(student.grno);
        			}
    			};
    			xmlhttp.open("GET","ajax.php?action=student_detail&q="+str,true);
    			xmlhttp.send();	
			}
		</script>
      	<script type="text/javascript">
      		$('#dd-7').addClass('active');
      		$('#dd-7-1').addClass('active');
      	</script>
  	</body>
</html>