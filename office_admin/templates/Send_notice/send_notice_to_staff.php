<!doctype html>
<html lang="en-US">
	<head>
	     <meta charset="utf-8" />
	     <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	     <title>Send Notice to Student</title>
	     <meta name="description" content="" />
	     <meta name="Author" content="" />
	     <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
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
         	include(TEMPLATES_PATH . DS . 'header.tpl.php');
    	?>

			<div id="content" class="dashboard" style="padding-top: 5px;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>Send Notice to Students</strong>
							</span>
						</div>
						<div class="panel-body">
							<form method="post" action="">
										    <input type="hidden" name="data[from_type]" value="admin">
											<input type="hidden" name="data[to_type]" value="staff">

											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group">
											<label><b>Staff</b><font color="#FF0000"><b>*</b></font></label>
												<select class="form-control selectpicker" data-live-search="true" name="data[to_id]">
													<option value="0">All Teachers</option>
													<?php
														$teachers = get_all_results('es_staff', 'st_firstname', 'asc', array('staff_status' => 'active'));
														foreach($teachers as $teacher)
														{
							    							echo"<option value='".$teacher['es_staffid']."'> ".$teacher['st_firstname']." ".$teacher['st_lastname']." </option>";
							    						}
							    					?>
												</select>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group">
			                    			<label><b>Date:</b><font color="#FF0000"><b>*</b></font></label>
			                    			<input type="text" name="data[notice_date]" class="form-control datepicker  masked" required>
		                  				  </div>
		                  				
										  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
		                    				<label><b>Subject:</b><font color="#FF0000"><b>*</b></font></label>
			                    			<input type="text" name="data[subject]"  class="form-control" required>
		                  				  </div>

		                  				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
											<label><b>Notice:</b><font color="#FF0000"><b>*</b></font></label>
											<textarea col="100" row="50" name="data[message]"  class="form-control" required="required"></textarea>
											<span class="text-danger"><br></span>
										  </div>
											<button type="submit" name="send_to_staff_notice" class="btn btn-primary pull-right" value="send_to_staff_notice" id="submit_btn">SEND MESSAGE</button>
										</form>
				  			
			</div>
						</div>
					</div>
					<!-- PANEL END-->
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
    	semesters.innerHTML = "<option value='NULL'>ALL SEMESTER</option>";
		semesters.innerHTML = semesters.innerHTML + this.responseText;
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

	</body>
</html>

